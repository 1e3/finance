<?php namespace App\Applications\Api\Http\Requests;

use \App\Core\Http\Requests\JsonRequest;

class PaymentRequest extends JsonRequest
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
        switch($this->method())
        {
            case 'POST':
                return [
                    'price'     =>  'required|regex:/^\d*(\.\d{2})?$/',
                    'status'    =>  'required|numeric|min:0',
                    'user_id'       =>  'required|exists:users,id',
                    'invoice_id'       =>  'required|exists:invoices,id',
                ];
                break;
            case 'PATCH':
                return [
                    'status'    =>  'required|numeric|min:0',
                ];
                break;
            default:
                return [];
                break;
        }

    }
}