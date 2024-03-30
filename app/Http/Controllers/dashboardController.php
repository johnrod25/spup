<?php

namespace App\Http\Controllers;

use App\Http\Requests\changePasswordRequest;
use App\Models\auther;
use App\Models\book;
use App\Models\book_issue;
use App\Models\borrow;
use App\Models\category;
use App\Models\publisher;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'authors' => auther::count(),
            'publishers' => publisher::count(),
            'categories' => category::count(),
            'books' => book::count(),
            'students' => student::count(),
            'issued_books' => book_issue::count(),
            'reported' => borrow::where('issue_status', 'X')->count(),
            'report_info' => borrow::where('issue_status', 'X')->get(),
            'restock' => book::where('quantity','<=', 5)->count(),
            'restock_info' => book::where('quantity','<=', 5)->get(),
        ]);
    //     if(session()->get('usertype') == 1){
    //     return view('dashboard', [
    //         'authors' => auther::count(),
    //         'publishers' => publisher::count(),
    //         'categories' => category::count(),
    //         'books' => book::count(),
    //         'students' => student::count(),
    //         'issued_books' => book_issue::count(),
    //         'reported' => borrow::where('issue_status', 'X')->count(),
    //         'report_info' => borrow::where('issue_status', 'X')->get(),
    //         'restock' => book::where('quantity','<=', 0)->count(),
    //         'restock_info' => book::where('quantity','<=', 0)->get(),
    //     ]);
    // }else{
    //     return view('staffportal.dashboard', [
    //         'authors' => auther::count(),
    //         'publishers' => publisher::count(),
    //         'categories' => category::count(),
    //         'books' => book::count(),
    //         'students' => student::count(),
    //         'issued_books' => book_issue::count(),
    //         'reported' => borrow::where('issue_status', 'X')->count(),
    //         'restock' => book::where('quantity','<=', 0)->count(),

    //     ]);
    // }
    }

    public function staff_index(){
        return view('staffportal.dashboard', [
            'authors' => auther::count(),
            'publishers' => publisher::count(),
            'categories' => category::count(),
            'books' => book::count(),
            'students' => student::count(),
            'issued_books' => book_issue::count(),
            'restock' => book::where('quantity','<=', 0)->count(),
            'reported' => borrow::where('issue_status', 'X')->count(),
        ]);
    }

    public function change_password_view()
    {
        return view('reset_password');
    }

    public function change_password(Request $request)
    {
            if($request->password == $request->password_confirmation){
                $user = User::find(auth()->user()->id);
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->back()->with(['success_message' => "Password Changed Successfully!"]);
            }else{
                return redirect()->back()->with(['error_message' => "Incorrect password."]);
            }
       
        // if (Auth::check(["username" => auth()->user()->username, "password" => $request->c_password])) {
            
        //     // auth()->user()->password = bcrypt($request->password);
        // } else {
        //     return "";
        // }
    }

    public function updateNotif(){
        // session()->put('notif', borrow::where('seen', 0));
        if(session()->get('usertype') == 1){
            return response(['notif' => borrow::where('seen', 0)->count(),'ndata' => borrow::where('seen', 0)->get()]);
        }else{
            return response(['notif' => borrow::where('seen', 1)->where('auther_id',session()->get('auther_id'))->count(),'ndata' => borrow::where('seen', 1)->where('auther_id',session()->get('auther_id'))->get() ]);
        }
    }
}
