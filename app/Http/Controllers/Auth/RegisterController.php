<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        if ($data['subject_enable'] != 'false') {
            $validate = Validator::make($data, [
                'subject_id' => 'array|required',
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'document' => 'required|string|max:255|unique:user',
                'phone' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:user',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string|max:255',
            ]);
        } else {
            $validate = Validator::make($data, [
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'document' => 'required|string|max:255|unique:user',
                'phone' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:user',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string|max:255',
            ]);
        }

        return $validate;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'document' => $data['document'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        $user->roles()->attach(Role::where('name', $data['role'])->first());

        if ($data['subject_enable'] != 'false') {
            foreach ($data['subject_id'] as $option_value) {
                $user->subjects()->sync(Subject::where('id', $option_value)->first(), false);
            }   
        }
        return $user;
    }
}
