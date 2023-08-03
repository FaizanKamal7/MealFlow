<?php

namespace Modules\DeliveryService\Http\Exports;
use App\Models\ActivityLogs;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;
use Modules\DeliveryService\Entities\Delivery;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class DeliveryTemplateClass implements FromCollection, WithHeadings, WithEvents
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return new Collection($this->data);
    }

    public function headings(): array
    {
        // Define the column headings here
        return [
            'Customer',
            'Delivery Address',
            'Delivery Slot',
            'Item Type (optional)',
            'Enable SMS Notifications (optional)',
            'Enable Email Notifications (optional)',
            'Special Instructions (optional)',
            'Notes (optional)',
            'COD Amount (optional)',

            // Add more column headings as needed
        ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function (AfterSheet $event) {

                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                /**
                 * Validation for bulkuploadsheet
                 */

                //ToDo::Get customers,Branch Delivery Slots from DB and populate in following format.

                $customers = "osman@gmail.com, Talha@gmail.com, Saad@gmail.com, Ammar@gmail.com";
                $deliverySlots = "DXB-Burj 6AM-12AM, DXB-Burj 12PM-2PM"; //Format: City-Area Slot Start Time-Slot End Time
                $enableNotifications = "Yes,No";


                // Ask user total number of deliveries they want to upload,then run the for loop til that number to generate rows.
                //in this case, I have selected 10 for example purpose.
                for ($i = 2; $i <= 11; $i++) {
                    // Set the value of cell B in the current row
                    $cellValue = "Select Customer";
                    $sheet->setCellValue('A' . $i, $cellValue);

                    // Apply data validation to the cell
                    $objValidation = $sheet->getCell('A' . $i)->getDataValidation();
                    $objValidation->setType(DataValidation::TYPE_LIST);
                    $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('"' . $customers . '"');
                    $objValidation->setAllowBlank(false);


                    // Set the value of cell C (Delivery Slot) in the current row
                    $cellValue = "Select Delivery Slot";
                    $sheet->setCellValue('C' . $i, $cellValue);

                    // Apply data validation to the cell
                    $objValidation = $sheet->getCell('C' . $i)->getDataValidation();
                    $objValidation->setType(DataValidation::TYPE_LIST);
                    $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('"' . $deliverySlots . '"');
                    $objValidation->setAllowBlank(false);

                    // Set the value of cell E (SMS Notifications) in the current row
                    $cellValue = "Select";
                    $sheet->setCellValue('E' . $i, $cellValue);

                    // Apply data validation to the cell
                    $objValidation = $sheet->getCell('E' . $i)->getDataValidation();
                    $objValidation->setType(DataValidation::TYPE_LIST);
                    $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('"' . $enableNotifications . '"');


                    // Set the value of cell F (Email Notifications) in the current row
                    $cellValue = "Select";
                    $sheet->setCellValue('F' . $i, $cellValue);

                    // Apply data validation to the cell
                    $objValidation = $sheet->getCell('F' . $i)->getDataValidation();
                    $objValidation->setType(DataValidation::TYPE_LIST);
                    $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('"' . $enableNotifications . '"');

                }

            }
        ];
    }
}
