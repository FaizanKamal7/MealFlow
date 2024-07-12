<?php

namespace Modules\DeliveryService\Http\Exports;

use App\Http\Helper\Helper;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\DeliverySlotInterface;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\DeliveryService\Jobs\UploadDeliveriesCSV;

use function PHPUnit\Framework\isEmpty;

class ExcelImportClass implements FromArray
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function onRow(Row $row)
    {
        // $rowIndex = $row->getIndex();
        // $sheetTitle = $row->getWorksheet()->getTitle();

        // // Get the actual headers from the Excel file
        // $actualHeaders = $row->toArray();

    }

    public function headingRow(): int
    {
        return 1;
    }

    
}
