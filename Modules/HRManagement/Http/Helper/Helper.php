<?php

namespace Modules\HRManagement\Http\Helper;

use Exception;
use Illuminate\Support\Facades\Log;

class Helper
{
    // Helper Functions
    public function storeFile($file, $directory)
    {
        $file_url = $file->getClientOriginalName();
        $file_url = time() . '-' . date('YmdHi') . '-' . $file_url;
        $file_url = "hr/" . $directory . "/" . $file_url;
        $file->move("hr/" . $directory . "/", $file_url);
        return $file_url;
    }
}
