<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\VerifikacijaKorisnika;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Session\Flash;
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        /*@\Illuminate\Contracts\Validation\Validator*/
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
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verifikovan'=>false,
            'verifikacioni_kod'=> str_random(40),
            'verifikacioni_kod_datum'=>Carbon::now()
        ]);
    }
    public function register(Request $request)
    {
        $validator = $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        Mail::to($user)->send(new VerifikacijaKorisnika($user->verifikacioni_kod));

        return view('auth/registered');
    }
    public function confirm($token){
        if($user = User::where('verifikacioni_kod',$token)->first()) {
            $datumTokena = new Carbon($user->verifikacioni_kod_datum);
            $danas = Carbon::now();
            if ($danas <= $datumTokena->addDay(1)) {
                $user->verifikovan = 1;
                $user->verifikacioni_kod = '';
                $user->save();
                return view('auth/confirm')->with(['user_name' => $user->name]);
            }
        }
    }
}
