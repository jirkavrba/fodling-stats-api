<?php

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreInstitutionRequest extends FormRequest
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
                'unique:institutions,name',
            ],
            'logo' => [
                'required',
                'url'
            ],
            'color' => [
                'required',
                'regex:/#[0-9A-Fa-f]{6}/' // require the color to be in the hex format
            ]
        ];
    }
}
