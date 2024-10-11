<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourierStoreReuqest extends FormRequest
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
            'date_time' => ['required','date'],
            'item_received' => ['required','string'],
            'item_quantity' => ['required','numeric'],
            'item_description' => ['required','string'],
            'sender_id' => ['required','numeric'],
            // 'receiver' => ['required','numeric'],
            // 'received_by' => ['required','numeric'],
            // 'handover_to' => ['required','numeric'],
            // 'remarks' => ['required','string'],
        ];
    }

    public function messages(){
        return [
            'sender_id.required' => 'The Sender field is required.',
            'sender_id.numeric' => 'The sender must be a number.',
        ];
    }
}
