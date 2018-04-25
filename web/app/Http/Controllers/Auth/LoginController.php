<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $username = 'username';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['getConfirmation','logout']);
    }

    // Aqui va lo que se necesita para permitir el acceso
    protected function credentials(Request $request)
    {

        // valida que el usuario debe estar activo

        return [
            'username' => $request->get ('username'),
            'password' => $request->get('password'),
            'active' => true,
            //'registration_token' => null  // restringe usuarios que no hayan verificado su cuenta por email
        ];

        // return $request->only($this->username, 'password'); // asi es por defecto!

    }

    //Para autenticar con username, cambiar por email si desea logear con email
    public function username()
    {
        return 'username';
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // *** Verifica que primero deba verificar su email

        if ($user->registration_token != null) {

            // auth()->logout();
            return redirect()->route('home')->with('status', 'Necesita confirmar su email, para tener accceso a todos los recursos');

        }

        return redirect()->intended($this->redirectPath());
    }

    public function getConfirmation($token)
    {
        $user = User::where('registration_token', $token)->firstOrFail();
        $user->registration_token = null;
        $user->save();

        return redirect('/login')
            ->with('status', 'Ahora ya puedes iniciar sesion');

    }

}
