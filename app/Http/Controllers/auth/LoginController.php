<?php

namespace App\Http\Controllers\auth;
use App\Models\book_issue;
use App\Models\borrow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Carbon\Carbon;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => "required",
            'password' => "required",
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            session()->put('usertype', auth()->user()->usertype);
            session()->put('notif', '');
            session()->put('id', auth()->user()->id);
            session()->put('auther_id', auth()->user()->auther_id);
            // Session::set('usertype', 1);
            return redirect('/dashboard');
        } else {
            return redirect()->back()->withErrors(['username' => 'Invalid username or password']);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
