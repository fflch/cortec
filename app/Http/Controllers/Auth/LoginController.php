<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('senhaunica')->redirect();
    }

    public function handleProviderCallback()
    {
        $userSenhaUnica = Socialite::driver('senhaunica')->user();

        # verifica se o usuário é um admin
        $admins = explode(',', env('ADMINS'));
        if(!in_array($userSenhaUnica->codpes, $admins)) {
            return redirect('/')
            ->withErrors(__('messages.validacao.login.body'));
        }

        # busca o usuário local
        $user = User::where('codpes',$userSenhaUnica->codpes)->first();


        if (is_null($user)) {
            $user = new User;
        }

        // bind do dados retornados
        $user->codpes = $userSenhaUnica->codpes;
        $user->email = $userSenhaUnica->email;
        $user->name = $userSenhaUnica->nompes;
        $user->save();

        Auth::login($user, true);
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}
