<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class RoleRequest extends FormRequest
{
    protected $scenes = [
        'add'  => ['unit_id', 'name'],
        'edit' => ['unit_id', 'name', 'id'],
        'delete' => ['id']
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'unit_id' => 'required',
            'name' => 'required',
            'id' => 'required',
        ];
    }
}
