<?php

namespace Modules\DeliveryService\Http\Exports;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;
use Modules\DeliveryService\Entities\Delivery;

class ExcelImportClass implements  WithHeadingRow, onEachRow
{

    protected $selectedCustomers = [];

    public function onRow(Row $row)
    {

        $rowIndex = $row->getIndex();
        $sheetTitle = $row->getWorksheet()->getTitle();

        if($sheetTitle === 'Worksheet'){
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

//                dd($customer,$address,$deliverySlot,$item_type,$enableSMSNotifications,$enableEmailNotifications,$special_instructions,$notes,$codAmount);

                //TODO::Push delivery data to database table (Delivery)
            }
        }else if($sheetTitle == "New Customers"){
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

                dd($customer,$address,$deliverySlot,$item_type,$enableSMSNotifications,$enableEmailNotifications,$special_instructions,$notes,$codAmount);

                // TODO: Push delivery data to the database table (Delivery)
            }
        }

        return $this->selectedCustomers;
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
