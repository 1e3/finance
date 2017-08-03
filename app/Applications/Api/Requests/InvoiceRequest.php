<?php namespace App\Applications\Api\Http\Requests;

use \App\Core\Http\Requests\JsonRequest;

class InvoiceRequest extends JsonRequest
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

    public function wantsJson()
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
                    'price'         =>  'required|regex:/^\d*(\.\d{2})?$/',
                    'description'   =>  'required|min:3',
                    'parcels'       =>  'required|numeric|min:1',
                    'user_id'       =>  'required|exists:users,id',
                    'user_payment_id'       =>  'required|exists:users,id',
                    'category_id'       =>  'required|exists:categories,id',
                    'house_id'       =>  'required|exists:houses,id',

                ];
                break;
            case 'PATCH':
                return [
                    'price'         =>  'required|regex:/^\d*(\.\d{2})?$/',
                    'description'   =>  'required|min:3',
                    'parcels'       =>  'required|numeric|min:1',
                    'user_id'       =>  'required|exists:users,id',
                    'user_payment_id'       =>  'required|exists:users,id',
                    'category_id'       =>  'required|exists:categories,id',
                    'house_id'       =>  'required|exists:houses,id',
                ];
                break;
            default:
                return [];
                break;
        }

    }
}