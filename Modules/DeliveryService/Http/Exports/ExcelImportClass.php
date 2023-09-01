<?php

namespace Modules\DeliveryService\Http\Exports;

use App\Models\Area;
use App\Models\City;
use App\Models\User;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;
use Modules\BusinessService\Entities\CustomerAddress;
use Modules\DeliveryService\Entities\Delivery;

class ExcelImportClass implements WithHeadingRow, onEachRow
{
    protected $headerColumns = [];
    // protected $expectedHeaders = ['Full Name'];
    protected $expectedHeaders = [
        'address',
        'area_with_city_select_option',
        'customerid_optional',
        'email_optional',
        'emirate_with_timeselect_option',
        'full_name',
        'google_link_address_optional',
        'notes',
        'notification_select_option',
        'phone',
        'pickup_point_optional',
        'product_type_optional'
    ]; // List of expected headers


    protected $selectedCustomers = [];
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $sheetTitle = $row->getWorksheet()->getTitle();


        // Get the actual headers from the Excel file
        $actualHeaders = $row->toArray();
        // Compare actual headers with expected headers
        if ($this->headersMatch($actualHeaders)) {
            echo "<pre>" . $row['phone'] . "<pre>";
            //TODO: Call repo fucntion here. 
            $customer_db_id = User::where(['phone' => $row['phone']])->get();
            $sheet_area_with_city = $row['area_with_city_select_option'];
            $city_name = '';
            $area_name = '';

            $openingParenthesisPos = strpos($sheet_area_with_city, '(');

            if ($openingParenthesisPos !== false) {
                $city_name = substr($sheet_area_with_city, 0, $openingParenthesisPos);
                $area_name = substr($sheet_area_with_city, $openingParenthesisPos + 1, -1);
            }
            $city = City::where(['name' => $city_name]);
            $area = Area::where(['name' => $area_name]);
            $customer_address = CustomerAddress::where(['customer_id' => $customer_db_id, 'city_id' => $city->id, 'state_id' => $area->id])->get();

            echo "<pre>sheet " . $sheet_area_with_city . "<pre>";
            echo "<pre>city " . $city->id . " " . $city->name . "<pre>";
            echo "<pre>area " . $area->id . " " . $area->name . "<pre>";
            echo "<pre>customer_address " . $customer_address . "<pre>";

            dd($customer_db_id);
        } else {
            // Headers do not match, throw an exception or handle the error
            throw new \Exception('Headers do not match expected format.');
        }
        if ($sheetTitle === 'Worksheet') {
            // Get the value of the customer cell in the current row
            $customer = $row->toArray()["customer"];

            // Check if the value already exists in the $selectedCustomers array
            if (in_array($customer, $this->selectedCustomers)) {
                // Value is a duplicate, handle the error as needed
                // For demonstration, I'll just print a message here
                echo "Duplicate value found in row: " . $rowIndex . PHP_EOL;
            } else {
                $address = $row->toArray()["delivery_address"];
                $deliverySlot = $row->toArray()["delivery_slot"];
                $item_type = $row->toArray()["item_type_optional"];
                $enableSMSNotifications = $row->toArray()["enable_sms_notifications_optional"];
                $enableEmailNotifications = $row->toArray()["enable_email_notifications_optional"];
                $special_instructions = $row->toArray()["special_instructions_optional"];
                $notes = $row->toArray()["notes_optional"];
                $codAmount = $row->toArray()["cod_amount_optional"];
                // Value is not a duplicate, add it to the selectedOptions array
                $this->selectedCustomers[] = $customer;


                //TODO::Push delivery data to database table (Delivery)
            }
        } else if ($sheetTitle == "New Customers") {
            // Import data from the "New Customers" sheet
            $customer = $row->toArray()["customer"];

            if (in_array($customer, $this->selectedCustomers)) {
                // Value is a duplicate, handle the error as needed
                // For demonstration, I'll just print a message here
                echo "Duplicate value found in row: " . $rowIndex . " of sheet: " . $sheetTitle . PHP_EOL;
            } else {
                $address = $row->toArray()["delivery_address"];
                $deliverySlot = $row->toArray()["delivery_slot"];
                $item_type = $row->toArray()["item_type_optional"];
                $enableSMSNotifications = $row->toArray()["enable_sms_notifications_optional"];
                $enableEmailNotifications = $row->toArray()["enable_email_notifications_optional"];
                $special_instructions = $row->toArray()["special_instructions_optional"];
                $notes = $row->toArray()["notes_optional"];
                $codAmount = $row->toArray()["cod_amount_optional"];

                // Value is not a duplicate, add it to the selectedOptions array
                $this->selectedCustomers[] = $customer;

                dd($customer, $address, $deliverySlot, $item_type, $enableSMSNotifications, $enableEmailNotifications, $special_instructions, $notes, $codAmount);

                // TODO: Push delivery data to the database table (Delivery)
            }
        }

        return $this->selectedCustomers;
    }

    public function headingRow(): int
    {
        return 1;
    }

    protected function headersMatch($actualHeaders)
    {

        $actualHeaders = array_keys($actualHeaders);
        $actualHeadersLowercase = array_map('strtolower', $actualHeaders);
        $expectedHeadersLowercase = array_map('strtolower', $this->expectedHeaders);

        sort($actualHeadersLowercase);
        sort($expectedHeadersLowercase);

        return $actualHeadersLowercase === $expectedHeadersLowercase;
    }


    //    public function model(array $row)
    //    {
    //        dd($row);
    //        die();
    //        return null;
    ////        return new Delivery([
    ////            'name' => $row['name'],
    ////            'email' => $row['email'],
    ////            'phone_number' => $row['phone_number'],
    ////        ]);
    //    }

    //    public function rules(): array
    //    {
    //        return [
    //            'name' => 'required|string|max:255',
    //            'email' => 'required|email|unique:delivery,email',
    //            'phone_number' => 'required|string|max:20',
    //        ];
    //    }

    //    public function customValidationMessages()
    //    {
    //        return [
    //            'email.unique' => 'The email address :value is already taken.',
    //        ];
    //    }
}
