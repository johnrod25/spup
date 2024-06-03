<?php

namespace App\Http\Controllers;

use App\Models\book_issue;
use App\Http\Requests\Storebook_issueRequest;
use App\Http\Requests\Updatebook_issueRequest;
use App\Models\auther;
use App\Models\book;
use App\Models\borrow;
use App\Models\category;
use App\Models\settings;
use App\Models\student;
use \Illuminate\Http\Request;
use Carbon\Carbon;

class BookIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transactions.index', [
            'books' => borrow::where('approve', '!=', 0)->get()
        ]);
    }

    public function borrow_index()
    {
        return view('borrow.index', [
            'books' => book_issue::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.issueBook_add', [
            'students' => student::latest()->get(),
            'books' => book::where('status', 'Y')->get(),
            'categories' => category::latest()->get(),
        ]);
    }

    public function create_form()
    {
        return view('borrowform', [
            'students' => student::latest()->get(),
            'books' => book::where('status', 'Y')->get(),
            'categories' => category::latest()->get(),
        ]);
    }
    public function updateitem($id)
    {
        return response(['success' => 'Employee created successfully.', 'items' => book::where('category_id', $id)->get()]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storebook_issueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storebook_issueRequest $request)
    {
        $book = book::find($request->book_id);
        if ($book->quantity >= $request->quantity) {
            $book->status = 'N';
            $book->quantity = $book->quantity - $request->quantity;
            // $book->quantity = '1';
            $book->save();
            $issue_date = date('Y-m-d');
            $return_date = date('Y-m-d', strtotime("+" . (settings::latest()->first()->return_days) . " days"));
            $data = book_issue::create($request->validated() + [
                'student_id' => $request->student_id,
                'requester' => $request->requester,
                'book_id' => $request->book_id,
                'quantity' => $request->quantity,
                'issue_date' => $issue_date,
                'return_date' => $return_date,
                'issue_status' => 'N',
                'approve' => 0,
            ]);
            $data->save();
            session()->put('notif', book_issue::whereDate('created_at', Carbon::today())->count());
            return redirect()->route('transactions');
        } else {
            return redirect()->back()->withErrors(['error_message' => 'Please select a quantity lower than stocks.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // calculate the total fine  (total days * fine per day)
        $book = book_issue::where('id', $id)->get()->first();
        $first_date = date_create(date('Y-m-d'));
        $last_date = date_create($book->return_date);
        $diff = date_diff($first_date, $last_date);
        $fine = (settings::latest()->first()->fine * $diff->format('%a'));
        return view('inventory.issueBook_edit', [
            'book' => $book,
            'fine' => $fine,
        ]);
    }

    public function approved($id)
    {
        $borrow = book_issue::find($id);
        $borrow->approve = 1;
        $borrow->save();
        return redirect()->route('borrows');
    }

    public function disapproved($id)
    {
        $borrow = book_issue::find($id);
        $borrow->approve = 2;
        $borrow->save();
        return redirect()->route('borrows');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatebook_issueRequest  $request
     * @param  \App\Models\book_issue  $book_issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $book = book_issue::find($id);
        $book->issue_status = 'Y';
        $book->return_day = now();
        $book->save();
        $bookk = book::find($book->book_id);
        $bookk->status = 'Y';
        $bookk->save();
        return redirect()->route('transactions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book_issue  $book_issue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        book_issue::find($id)->delete();
        return redirect()->route('transactions');
    }
}
