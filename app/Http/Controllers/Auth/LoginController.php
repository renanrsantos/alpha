<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Models\Cadastros\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Http\Request;

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
    protected $redirectTo = '/';
    
    protected $username = 'usulogin';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request) {
        $url = $request->segment(1);
        $userdata = ['usulogin'=>$request->get('usulogin'),'password'=>$request->get('ususenha')];
        $remember = (bool) $request->get('remember');
        $user = Usuario::where('usulogin','=',$userdata['usulogin'])->get();
        if($user->isEmpty()){
            return Redirect::to($url.'/login')->withErrors(['Usuário inválido']);
        } else
        if (Auth::attempt($userdata,$remember)) {
            return Redirect::to($url);
        } else {        
            return Redirect::to($url.'/login')
                    ->withErrors(['Senha inválida'])
                    ->withInput($request->except('ususenha'));
        }
    }
    
    public function logout(Request $request){
        $this->guard()->logout();
        $request->session()->invalidate();
        
        return Redirect::to($request->segment(1));
    }
}
