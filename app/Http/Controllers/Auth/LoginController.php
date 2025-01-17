<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;


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
    protected $redirectTo = '/dashboard/users';
    protected $redirectAfterLogout = '/login';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function loggedOut(Request $request)
    {
        return redirect($this->redirectAfterLogout);
    }

    protected function username()
    {
        return 'username';
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::attempt(
            ['username' => $request->username, 'password' => $request->password],
            $request->filled('remember')
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    protected function authenticated(Request $request, $user)
{
    if (!$user->active) {
        auth()->logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect()->route('login')->withErrors([
            'username' => 'Your account is not active.',
        ]);
    }
}
}
