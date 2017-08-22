<?php namespace App\Applications\Api\Http\Requests;

use \App\Core\Http\Requests\JsonRequest;

class RoleRequest extends JsonRequest
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
                    'display_name' =>   'min:3',
                    'description' =>   'min:3'
                ];
                break;
            case 'PATCH':
                return [
                    'name'       => 'min:3',
                    'display_name' =>   'min:3',
                    'description' =>   'min:3'
                ];
                break;
            default:
                return [];
                break;
        }

    }
}