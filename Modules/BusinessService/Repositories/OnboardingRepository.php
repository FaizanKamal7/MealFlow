<?php

namespace Modules\BusinessService\Repositories;

use App\Models\City;
use App\Models\State;
use Modules\BusinessService\Entities\Business;
use Modules\BusinessService\Interfaces\OnboardingInterface;

// use Modules\BusinessService\Interfaces\OnboardingInterface;

class OnboardingRepository implements OnboardingInterface
{

    // /**
    //  * @param $firstName
    //  * @param $lastName
    //  * @param $personalEmailAddress
    //  * @param $personalPhoneNumber
    //  * @param $companyEmailAddress
    //  * @param $companyPhoneNumber
    //  * @param $picture
    //  * @param $city
    //  * @param $country
    //  * @param $maritalStatus
    //  * @param $hireDate
    //  * @param $probationStartDate
    //  * @param $probationEndDate
    //  * @param $designationId
    //  * @param $leavePolicyId
    //  * @return mixed
    //  */

    public function createBusiness($firstName)
    {
        $business = new Business([
            "first_name" => $firstName,
        ]);

        $business->save();
        return $business;
    }
}
