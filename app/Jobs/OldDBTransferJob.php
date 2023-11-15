<?php

namespace App\Jobs;

use App\Http\Helper\Helper;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\BusinessService\Repositories\BranchRepository;
use Modules\BusinessService\Repositories\BusinessRepository;
use Modules\BusinessService\Repositories\BusinessUserRepository;

class OldDBTransferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $helper;
    private $userRepository;
    private $businessUserRepository;
    private $roleRepository;
    private $businessRepository;
    private $branchRepository;
    private $userRoleRepository;
    private $row;



    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        $row,
        Helper $helper = null,
        UserRepository $userRepository = null,
        BusinessUserRepository $businessUserRepository = null,
        RoleRepository $roleRepository = null,
        BusinessRepository $businessRepository = null,
        BranchRepository $branchRepository = null,
        UserRoleRepository $userRoleRepository = null

    ) {
        $this->row  = $row;
        $this->helper = $helper;
        $this->userRepository = $userRepository;
        $this->businessRepository = $businessRepository;
        $this->businessUserRepository = $businessUserRepository;
        $this->roleRepository = $roleRepository;
        $this->branchRepository = $branchRepository;
        $this->userRoleRepository = $userRoleRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $fileContents = file_get_contents($this->file);
        // $file = new \Illuminate\Http\UploadedFile($this->file, basename($this->file));
        // Recreate the UploadedFile instance within the handle method
        // $file = new UploadedFile(
        //     $this->excelFilePath,
        //     'original_filename.xlsx' 
        // );
        // sleep(1);
        $row = $this->row;
        dump('Debugging information', ['row' => $row]);
        $address_xy = $this->helper->convertStringAddressToCoordinates($row['address']);
        $address =  $address_xy ? $this->helper->getLocationFromCoordinates($address_xy->latitude, $address_xy->longitude) : null;
        // echo "<br> A D D E D: " . $row['full_name'] . " and address_xy" . json_encode($address_xy) . " and address " . json_encode($address) . "<br>";
        // echo var_dump($address), PHP_EOL;

        $db_location_ids = $this->helper->findDBLocationsWithNames(
            $address['country'],
            $address['state'],
            $address['city'],
            $address['area'],
        );
        // echo "<br><br>" . var_dump($db_location_ids), PHP_EOL;

        $user =  $this->userRepository->createUser([
            'name' => $row['full_name'],
            'email' => $row['email'] == "" ? null : $row['email'],
            'phone' => $row['phone'] == "" ? null : $row['phone'],
            'password' => Hash::make($row['password_partner']),
        ], false);

        $role_id = $this->roleRepository->getRoleByName(RoleNamesEnum::BUSINESS_ADMIN->value);
        $this->userRoleRepository->createUserRole(userId: $user->id, roleId: $role_id->id);

        $business =  $this->businessRepository->createBusiness(
            name: $row['full_name'],
            business_category_id: '984584e4-3579-sde3-a380-363ee669ad42',
            admin: $user->id,
            status: BusinessStatusEnum::APPROVED->value
        );
        $business_user = $this->businessUserRepository->createBusinessUser(
            user_id: $user->id,
            business_id: $business->id
        );

        $branch =   $this->branchRepository->createBranch(
            name: "Main branch",
            phone: $row['phone'],
            address: $row['address'],
            country_id: $db_location_ids['country_id'],
            state_id: $db_location_ids['state_id'],
            city_id: $db_location_ids['city_id'],
            area_id: $db_location_ids['area_id'] == "" ? null : $db_location_ids['area_id'],
            business_id: $business->id,
            latitude: $address_xy->latitude ?? null,
            longitude: $address_xy->longitude ?? null,
            is_main_branch: true,
            active_status: true,

        );

        if ($branch == null) {
            throw new \Exception('Branch is null.');
        }
    }
}
