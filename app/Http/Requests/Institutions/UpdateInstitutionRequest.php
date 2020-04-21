<?php

namespace App\Http\Requests\Institutions;

use App\Institution;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateInstitutionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('institutions', 'name')->ignore($this->institution->id)
            ],
            'logo' => [
                'required',
                'url'
            ],
            'color' => [
                'required',
                'regex:/#[0-9A-Fa-f]{6}/'
            ]
        ];
    }
}
