<?php

namespace App\Http\Helper;

use App\Models\ActivityLogs;
use Modules\CRM\Entities\Task;
use Modules\DeliveryService\Entities\BagTimeline;

class Helper
{
    public function logActivity($userId, $moduleName, $action, $subject, $url, $description, $ipAddress, $userAgent, $oldValues, $newValues, $recordId, $recordType, $method)
    {
        ActivityLogs::create([
            'user_id' => $userId,
            'module_name' => $moduleName,
            'action' => $action,
            'subject' => $subject,
            'url' => $url,
            'description' => $description,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'record_id' => $recordId,
            'record_type' => $recordType,
            'method' => $method,
        ]);
    }

    public function bagTimeline($bag_id, $delivery_id, $status_id, $action_by, $vehicle_id, $description)
    {
        BagTimeline::create([
            'bag_id' => $bag_id,
            'delivery_id' => $delivery_id,
            'status_id' => $status_id,
            'action_by' => $action_by,
            'vehicle_id' => $vehicle_id,
            'description' => $description,
        ]);
    }




}
