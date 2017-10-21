<?php

namespace App\Http\Requests\Validation;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Validation\PasosIniciativa;

class UpdatePasosIniciativaRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return PasosIniciativa::$rules;
    }
}
