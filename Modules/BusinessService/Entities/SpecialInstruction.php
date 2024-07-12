<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialInstruction extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'special_instructions';
    protected $fillable = [
        'special_instruction',
        'special_instruction_files ',
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\SpecialInstructionFactory::new();
    }
}
