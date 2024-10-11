<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
        return [
            'task_category_id' => ['required','numeric'],
            'date' => ['required','date'],
            'department_id' => ['required','numeric'],
            'description' => ['required','string'],
        ];
    }

    public function messages(){
        return [
            'task_category_id.required' => 'Please Select Task Category',
            'task_category_id.numeric' => 'Task Category should be Numeric Value',
            'department_id.required' => 'Please Select Department',
            'department_id.numeric' => 'Department should be Numeric Value',
        ];
    }
}
