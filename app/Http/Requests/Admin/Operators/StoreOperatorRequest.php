<?php

namespace App\Http\Requests\Admin\Operators;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperatorRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [ 'required', 'string' ],
            'phone_number' => [ 'required', 'string', 'regex:/^\+?[0-9]*$/' ],
        ];
    }

}
