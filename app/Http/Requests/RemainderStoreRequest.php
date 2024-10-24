<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemainderStoreRequest extends FormRequest
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
        // dd(request()->all());
        return [
            'title' => ['required','unique:remainders','min:3','max:255'],
            'remainder_type_id' => ['required','numeric'],
            'employee_id' => ['required','array'],
            'issuing_authority_id' => ['required','numeric'],
            'expairy_date' => ['required_if:is_expairy_date,1'],
            'date_time' => ['required', 'after_or_equal:'.now()->toDateTimeLocalString()],
        ];
    }

    public function messages(){
        return [
            'remainder_type_id.required' => 'Please select Remainder Type',
            'remainder_type_id.numeric' => 'Remainder Type should be a numeric value',
            'employee_id.numeric' => 'Employee should be a numeric value',
            'employee_id.required' => 'Please select Employee',
            'issuing_authority_id.required' => 'Please select Issuing Authority',
            'issuing_authority_id.numeric' => 'Issuing Authority should be a numeric value',
            'expairy_date.required_if' => 'Expiary Date is required',
        ];
    }
}
