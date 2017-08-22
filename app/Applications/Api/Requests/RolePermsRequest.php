<?php namespace App\Applications\Api\Http\Requests;

use \App\Core\Http\Requests\JsonRequest;

class RolePermsRequest extends JsonRequest
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
            'perms.*'       => 'required|exists:permissions,id',
        ];
    }
}