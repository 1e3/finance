<?php
namespace App\Applications\Api\Http\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Models\Users\Repositories\UserRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\Core\Traits\TraitToken;

class RegisterController extends Controller
{
    use RegistersUsers, TraitToken;

    protected $repo;

    public function __construct(UserRepository $user)
    {
        $this->repo = $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $token = $this->generateToken($user);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_at' => $this->getTokenLife($token)
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Domains\Users\User
     */
    protected function create(array $data)
    {
        return $this->repo->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}