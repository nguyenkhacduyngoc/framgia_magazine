<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\VerifyUser;
use App\Mail\VerifyRegister;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:60|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'username' => $data['username'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'password' => bcrypt($data['password']),
        ]);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        $mail = \Mail::to($user->email)->send(new VerifyRegister($user));
        return $user;
    }

    public function verifyEmail(Request $request){
        $verify_register = VerifyUser::where('token',$request->token)->firstOrFail();
        $user = User::where('id',$verify_register->user_id)->firstOrFail();
        if($user->verifyEmail == 1){
            return redirect('login')->withErrors('Your email have been verified');
        }
        $user->update(['verifyEmail' => 1]);
        return redirect('login')->withErrors('Verify Successfully');
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $users = $this->create($request->all());

        return redirect('login')->with('check your email for verify register', 'Success');
    }
}
