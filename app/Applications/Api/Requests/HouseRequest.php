<?php namespace App\Applications\Api\Http\Requests;

use \App\Core\Http\Requests\JsonRequest;

class HouseRequest extends JsonRequest
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
                    'name'       => 'required|min:3',
                ];
                break;
            case 'PATCH':
                return [
                    'name'       => 'required|min:3',
                ];
                break;
            default:
                return [];
                break;
        }

    }
}