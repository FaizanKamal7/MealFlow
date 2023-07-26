<?php

namespace Modules\BusinessService\Http\Controllers\Onboarding;

use App\Interfaces\CountryInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserRoleInterface;
use App\Models\Country;
// use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Modules\BusinessService\Interfaces\BranchCoverageInterface;
use Modules\BusinessService\Interfaces\BranchInterface;
use Modules\BusinessService\Interfaces\BusinessCategoryInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\BusinessUserInterface;
use Modules\BusinessService\Interfaces\OnboardingInterface;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class BusinessOnboardingController extends Controller
{

    private OnboardingInterface $onboardingRepository;
    private BranchInterface $branchRepository;
    private BusinessCategoryInterface $businessCategoryRepository;
    private UserInterface $userRepository;
    private BusinessInterface $businessRepository;
    private BusinessUserInterface $businessUserRepository;
    private BranchCoverageInterface $branchCoverageRepository;
    private UserRoleInterface $userRoleRepository;
    private CountryInterface $countryRepository;


    /**
     * @param OnboardingInterface $designationRepository
     */
    public function __construct(
        OnboardingInterface $onboardingRepository,
        BranchInterface $branchRepository,
        BusinessCategoryInterface $businessCategoryRepository,
        UserInterface $userRepository,
        BusinessInterface $businessRepository,
        BusinessUserInterface $businessUserRepository,
        BranchCoverageInterface $branchCoverageRepository,
        UserRoleInterface $userRoleRepository,
        CountryInterface $countryRepository,

    ) {
        $this->onboardingRepository = $onboardingRepository;
        $this->branchRepository = $branchRepository;
        $this->businessCategoryRepository = $businessCategoryRepository;
        $this->userRepository = $userRepository;
        $this->businessRepository = $businessRepository;
        $this->businessUserRepository = $businessUserRepository;
        $this->branchCoverageRepository = $branchCoverageRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $countries = $this->countryRepository->getAllActiveCountries();
        $business_categories = $this->businessCategoryRepository->getBusinessCategory();

        return view('businessservice::onboarding.onboarding', ['countries' => $countries, 'business_categories' => $business_categories]);
    }

    public function businessOnboarding(Request $request)
    {
        // abort_if(Gate::denies('add_designation'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            // --- Adding data in users table
            // abort_if(Gate::denies('add_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $user = $this->userRepository->createUser(
                name: $request->get("first_name") . " " . $request->get("last_name"),
                email: $request->get("contact_email"),
                password: Hash::make($request->get("password")),
                isActive: true
            );

            // --- Adding data in business table
            // abort_if(Gate::denies('add_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $business = $this->businessRepository->createBusiness(
                name: $request->get("first_name") . " " . $request->get("last_name"),
                logo: $request->get("logo"),
                card_name: $request->get("card_name"),
                card_number: $request->get("card_number"),
                card_expiry_month: $request->get("card_expiry_month"),
                card_expiry_year: $request->get("card_expiry_year"),
                card_cvv: $request->get("card_cvv"),
                business_category_id: $request->get("category"),
                admin: $user->id,
                status: "NEW_REQUEST",
            );
            echo " <br />business ID: " . $business->id;

            // // Adding ternary relation
            $this->businessUserRepository->createBusinessUser(
                business_id: $business->id,
                user_id: $user->id,
            );

            $branch = $this->branchRepository->createBranch(
                name: "Main Branch",
                address: $request->get("address"),
                phone: $request->get("phone"),
                active_status: true,
                is_main_branch: 1,
                business_id: $business->id,
            );

            //TODO: get area_id, city_id, state_id, country_id dynamicaly

            $branch_coverage = $this->branchCoverageRepository->createBranchCoverage(
                active_status: true,
                area_id: $request->get("area"),
                city_id: $request->get("city"),
                state: $request->get("state"),
                country: $request->get("country"),
                branch_id: $branch->id,
            );

            $this->signInBusinessAdminUponRegistration($request->get("contact_email"), $request->get("password"), $user->id);

            // echo "business_user ID: " . $business_user->id;

            // $this->onboardingRepository->createBusiness($name);
            return redirect()->route("business_home")->with("success", "Business added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("business_home")->with("error", "Something went wrong! Contact support");
        }
    }

    public function signInBusinessAdminUponRegistration($email,  $password, $user_id)
    {
        $credentials = ['email' => $email, 'password' => $password];
        $bzn_admin_id = '9959f101-265e-47cd-8d70-2920aa972838';
        if (Auth::attempt($credentials)) {
            $this->userRoleRepository->createUserRole(userId: $user_id, roleId: $bzn_admin_id);
        }
        Session::flash("message", "Invalid email address or password!");
        Session::flash('alert-class', 'alert-danger');
    }

    public function home()
    {
        return view('businessservice::index');
    }

    public function getStates()
    {
        $states = $this->onboardingRepository->getStatesOfCountry($_GET['country_id']);
        return response()->json($states->toArray());
    }

    public function getCities()
    {
        $states = $this->onboardingRepository->getCitiesOfState($_GET['country_id']);
        return response()->json($states->toArray());
    }

    // function getDependentCountryStateCity()
    // {
    //     if (!empty($_POST['id'])) {
    //         // Fetch state data based on the specific country
    //         $country_id = $_POST['id'];

    //         // Fetch state data based on the specific country
    //         $states = $this->onboardingRepository->getStatesOfCountry($country_id);

    //         // Generate HTML of state options list
    //         if ($states->num_rows > 0) {
    //             echo '<option value="">Select State</option>';
    //             while ($row = $states->fetch_assoc()) {
    //                 echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    //             }
    //         } else {
    //             echo '<option value="">State not available</option>';
    //         }
    //     } elseif (!empty($_POST['state_iso2'])) {

    //         $getStateiso2 = $_POST['state_iso2'];
    //         $sel_country_Val = $_POST['sel_country_id'];

    //         // Fetch state id data based on the specific state iso2 and country code value
    //         $Singlequery = "SELECT * FROM states WHERE iso2 = '" . $getStateiso2 . "' AND country_code = '" . $sel_country_Val . "' AND flag = 1";
    //         $GetIdResult = $link->query($Singlequery);
    //         $singlerow = $GetIdResult->fetch_assoc();

    //         $GetStateID = $singlerow['id'];

    //         // Fetch city data based on the specific state id
    //         $query = "SELECT * FROM cities WHERE state_id = " . $GetStateID . " AND flag = 1 ORDER BY name ASC";
    //         $result = $link->query($query);

    //         // Generate HTML of city options list
    //         if ($result->num_rows > 0) {
    //             echo '<option value="">Select city</option>';
    //             while ($row = $result->fetch_assoc()) {
    //                 echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
    //             }
    //         } else {
    //             echo '<option value="">City not available</option>';
    //         }
    //     }
    // }

    // public function edit($id)
    // {
    //     return view('businessservice::edit');
    // }

    public function pricingCalculator(Request $request){
        return view("businessservice::onboarding.pricing");

    }

}
