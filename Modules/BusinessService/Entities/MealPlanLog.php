<?php

namespace Modules\DeliveryService\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealPlanLog extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "action",
        "action_by",
        "meal_plan_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'action_by');
    }

    public function mealPlan()
    {
        return $this->belongsTo(MealPlan::class, 'meal_plan_id');
    }

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\MealPlanLogFactory::new();
    }
}
