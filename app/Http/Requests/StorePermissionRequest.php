<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StorePermissionRequest extends FormRequest
{
//    public function authorize()
//    {
//        return Gate::allows('permission_create');
//    }

    public function rules()
    {
        return [
            'app_model' => [
                'string',
                'required',
            ],
            'permission_name' => [
                'string',
                'required',
            ],
            'permission_codename' => [
                'string',
                'required',
            ],
            'is_active' => [
                'boolean',
            ],
        ];
    }
}
