<?php

namespace Modules\BusinessService\Interfaces;

interface CustomerInterface
{
    public function get();
    public function create($data);
    public function getCustomer($customer_id);

    public function customerWithMatchingPhoneNoInUsers($phoneToCheck);
    public function customerWithMatchingEmailInUsers($email);
    public function customerWithMatchingPhoneNoInSecondaryNumbers($phone_no);
}
