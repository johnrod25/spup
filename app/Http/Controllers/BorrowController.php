<?php

namespace App\Http\Controllers;
use App\Models\book_issue;
use App\Http\Requests\Storebook_issueRequest;
use App\Http\Requests\borrowRequest;
use App\Http\Requests\Updatebook_issueRequest;
use App\Models\auther;
use App\Models\book;
use App\Models\borrow;
use App\Models\category;
use App\Models\settings;
use App\Models\student;
use \Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function index()
    {
        return view('transactions.index', [
            'books' => borrow::where('approve','!=', 0)->get()
        ]);
    }

    public function staff_index()
    {
        $rows = borrow::where('seen', '=', '1')->get();
        foreach($rows as $row) {
            $row->seen = 2;
            $row->save();
        }
        return view('transactions.staff_index', [
            'books' => borrow::where('approve','!=', 0)->where('auther_id', session()->get('auther_id'))->get()
        ]);
    }
    public function borrow_index()
    {
        $rows = borrow::where('seen', '=', '0')->get();
        foreach($rows as $row) {
            $row->seen = 1;
            $row->save();
        }
        return view('borrow.index', [
            'books' => borrow::where('approve', 0)->get()
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
        return response(['success' => 'Employee created successfully.','items' => auther::where('auther_id',$id)->get()]);
    }

    public function edit($id)
    {
        // calculate the total fine  (total days * fine per day)
        $book = borrow::where('id',$id)->get()->first();
        $type = book::find($book->book_id);
        $first_date = date_create(date('Y-m-d'));
        $last_date = date_create($book->return_date);
        $diff = date_diff($first_date, $last_date);
        // $fine = (settings::latest()->first()->fine * $diff->format('%a'));
        if(session()->get('usertype') == 1){
            return view('transactions.edit', [
                'book' => $book,
                'type' => $type,
                // 'fine' => $fine,
            ]);
        } else {
            return view('transactions.staff_edit', [
                'type' => $type,
                'book' => $book,
                // 'fine' => $fine,
            ]);
        }

    }

    public function borrow_request(borrowRequest $request)
    {
        $book = book::find($request->book_id);
        if($book->quantity >= $request->quantity){
        $book->status = 'N';
        // $book->quantity = $book->quantity - $request->quantity;
        // $book->quantity = '1';
        $book->save();
        $issue_date = date('Y-m-d');
        // $return_date = date('Y-m-d', strtotime("+" . (settings::latest()->first()->return_days) . " days"));
        $data = borrow::create($request->validated() + [
            'auther_id' => 1,
            'teacher' => $request->teacher,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'issue_date' => $issue_date,
            // 'return_date' => $return_date,
            'issue_status' => 'P',
            'approve' => 0,
            'seen' => 0,
            'description' => ''
        ]);
        $data->save();
        session()->put('notif', book_issue::whereDate('created_at', Carbon::today())->count());
        return redirect()->back()->with('message', 'Request successful.');
    }else{
        return redirect()->back()->withErrors(['error_message' => 'Please select a quantity lower than stocks.']);
    }
    }


    public function approved($id,$auther_id)
    {
        $borrow = borrow::find($id);
        $borrow->auther_id = $auther_id;
        $borrow->issue_status = 'N';
        $borrow->approve = 1;
        $borrow->save();
        $book = book::find($borrow->book_id);
        if($book->quantity >= $borrow->quantity){
        $book->status = 'N';
        $book->quantity = $book->quantity - $borrow->quantity;
        // $book->quantity = '1';
        $book->save();
        }
        return redirect()->route('borrows');
    }

    public function approved_post($id,$auther_id)
    {
        // dd($request);
        $borrow = borrow::find($id);
        $borrow->auther_id = $auther_id;
        $borrow->approve = 1;
        // $borrow->auther_id = $request->auther_id;
        $borrow->save();
        return redirect()->route('borrows');
    }

    public function disapproved($id)
    {
        $borrow = borrow::find($id);
        $borrow->auther_id = 0;
        $borrow->approve = 2;
        $borrow->issue_status = 'D';
        $borrow->save();
        return redirect()->route('borrows');
    }

    public function get_staff()
    {
        return response(['success' => 'Employee created successfully.','staff' => auther::latest()->get()]);
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
        $book = borrow::find($id);
        $book->issue_status = 'Y';
        $book->return_date = now();
        $book->save();
        $bookk = book::find($book->book_id);
        $bookk->status= 'Y';
        $bookk->save();
        return redirect()->route('transactions.staff');
    }

    public function issued(Request $request, $id)
    {
        // dd($request->all());
        $book = borrow::find($id);
        $book->issue_status = 'I';
        $book->issue_date = now();
        $book->save();
        $bookk = book::find($book->book_id);
        $bookk->status= 'I';
        $bookk->save();
        return redirect()->route('transactions.staff');
    }

    public function reported($id, $description)
    {
        // dd($request->all());
        $book = borrow::find($id);
        $book->issue_status = 'X';
        $book->description = $description;
        $book->return_date = now();
        $book->save();
        $bookk = book::find($book->book_id);
        $bookk->status= 'X';
        $bookk->save();
        return response()->json(['success'=>'Ajax request submitted successfully']);
    }

    public function reported_ajax(Request $request)
    {
        // dd($request->all());
        $book = borrow::find($request->id);
        $book->issue_status = 'X';
        $book->description = $request->report_desc;
        $book->return_date = now();
        $book->save();
        $bookk = book::find($book->book_id);
        $bookk->status= 'X';
        $bookk->save();
        return response()->json(['success'=>'Report submitted successfully']);
        // return redirect()->route('transactions.staff');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book_issue  $book_issue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        borrow::find($id)->delete();
        return redirect()->route('transactions');
    }

}
