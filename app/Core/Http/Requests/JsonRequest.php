<?php namespace App\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Concerns\InteractsWithContentTypes;
use Illuminate\Http\JsonResponse;

abstract class JsonRequest extends FormRequest
{
    use InteractsWithContentTypes;

    /**
     * Force response json type when validation fails
     * @var bool
     */
    protected $forceJsonResponse = FALSE;

    public function wantsJson()
    {
        return true;
    }


    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        if ($this->forceJsonResponse || $this->ajax() || $this->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }

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
            //
        ];
    }
}