<?php
use App\Http\Middleware\admin;
use App\Http\Middleware\staff;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\AutherController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\BookIssueController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\staffDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/Change-password', [LoginController::class, 'changePassword'])->name('change_password');
Route::get('/borrow-form', [BorrowController::class, 'create_form'])->name('borrow-form');
Route::get('/notification', [dashboardController::class, 'updateNotif'])->name('notif');


Route::middleware(['auth'])->group(function () {
    Route::get('change-password',[dashboardController::class,'change_password_view'])->name('change_password_view');
    Route::post('change-password',[dashboardController::class,'change_password'])->name('change_password');
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard', [dashboardController::class, 'staff_index'])->name('dashboard')->middleware([staff::class]);

    
    // Staff CRUD
    Route::get('/staff', [AutherController::class, 'index'])->name('staff')->middleware([admin::class]);
    Route::get('/staff/create', [AutherController::class, 'create'])->name('staff.create')->middleware([admin::class]);
    Route::get('/staff/edit/{auther}', [AutherController::class, 'edit'])->name('staff.edit')->middleware([admin::class]);
    Route::post('/staff/update/{id}', [AutherController::class, 'update'])->name('staff.update')->middleware([admin::class]);
    Route::post('/staff/delete/{id}', [AutherController::class, 'destroy'])->name('staff.destroy')->middleware([admin::class]);
    Route::post('/staff/create', [AutherController::class, 'store'])->name('staff.store')->middleware([admin::class]);

    // author CRUD
    Route::get('/authors', [AutherController::class, 'index'])->name('authors');
    Route::get('/authors/create', [AutherController::class, 'create'])->name('authors.create');
    Route::get('/authors/edit/{auther}', [AutherController::class, 'edit'])->name('authors.edit');
    Route::post('/authors/update/{id}', [AutherController::class, 'update'])->name('authors.update');
    Route::post('/authors/delete/{id}', [AutherController::class, 'destroy'])->name('authors.destroy');
    Route::post('/authors/create', [AutherController::class, 'store'])->name('authors.store');

    // publisher crud
    Route::get('/publishers', [PublisherController::class, 'index'])->name('publishers');
    Route::get('/publisher/create', [PublisherController::class, 'create'])->name('publisher.create');
    Route::get('/publisher/edit/{publisher}', [PublisherController::class, 'edit'])->name('publisher.edit');
    Route::post('/publisher/update/{id}', [PublisherController::class, 'update'])->name('publisher.update');
    Route::post('/publisher/delete/{id}', [PublisherController::class, 'destroy'])->name('publisher.destroy');
    Route::post('/publisher/create', [PublisherController::class, 'store'])->name('publisher.store');
    
    // Category CRUD
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/views/{id}', [CategoryController::class, 'views'])->name('category.views');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');

    // Inventory CRUD
    Route::get('/item', [InventoryController::class, 'index'])->name('inventory');
    Route::get('/item/create/{id}', [InventoryController::class, 'create'])->name('inventory.create');
    Route::get('/item/edit/{book}', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::post('/inventory/update/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::post('/inventory/delete/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
    Route::post('/item/create', [InventoryController::class, 'store'])->name('inventory.store');
    
    
    // books CRUD
    Route::get('/books', [BookController::class, 'index'])->name('books');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::get('/book/edit/{book}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/book/update/{id}', [BookController::class, 'update'])->name('book.update');
    Route::post('/book/delete/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::post('/book/create', [BookController::class, 'store'])->name('book.store');

    // students CRUD
    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::get('/student/edit/{student}', [StudentController::class, 'edit'])->name('student.edit');
    Route::post('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::post('/student/delete/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
    Route::post('/student/create', [StudentController::class, 'store'])->name('student.store');
    Route::get('/student/show/{id}', [StudentController::class, 'show'])->name('student.show');

    //transactions
    Route::get('/transactions', [BorrowController::class, 'index'])->name('transactions')->middleware([admin::class]);
    Route::get('/staff/transactions', [BorrowController::class, 'staff_index'])->name('transactions.staff')->middleware([staff::class]);
    Route::get('/transaction/create', [BookIssueController::class, 'create'])->name('transaction.create')->middleware([admin::class]);
    Route::get('/transaction/updateitem/{id}', [BookIssueController::class, 'updateitem'])->name('transaction.updateitem');
    Route::get('/transaction/edit/{id}', [BookIssueController::class, 'edit'])->name('transaction.edit')->middleware([admin::class]);
    Route::post('/transaction/update/{id}', [BookIssueController::class, 'update'])->name('transaction.update')->middleware([admin::class]);
    Route::post('/transaction/delete/{id}', [BookIssueController::class, 'destroy'])->name('transaction.destroy')->middleware([admin::class]);
    Route::post('/transaction/create', [BookIssueController::class, 'store'])->name('transaction.store');
    
    //borrows
    Route::get('/borrows', [BorrowController::class, 'borrow_index'])->name('borrows');
    Route::get('/borrow/create', [BorrowController::class, 'create'])->name('borrow.create');
    Route::get('/borrow/updateitem/{id}', [BorrowController::class, 'updateitem'])->name('borrow.updateitem');
    Route::get('/borrow/getstaff', [BorrowController::class, 'get_staff'])->name('borrow.getstaff');
    Route::get('/borrow/edit/{id}', [BorrowController::class, 'edit'])->name('borrow.edit');
    Route::post('/borrow/update/{id}', [BorrowController::class, 'update'])->name('borrow.update');
    Route::post('/borrow/issued/{id}', [BorrowController::class, 'issued'])->name('borrow.issued');
    Route::post('/borrow/reported_ajax', [BorrowController::class, 'reported_ajax'])->name('borrow.reported_ajax');
    Route::get('/borrow/reported/{id}/{description}', [BorrowController::class, 'reported'])->name('borrow.reported');
    Route::post('/borrow/delete/{id}', [BorrowController::class, 'destroy'])->name('borrow.destroy');
    Route::post('/borrow/create', [BorrowController::class, 'store'])->name('borrow.store');
    Route::post('/borrow/request', [BorrowController::class, 'borrow_request'])->name('borrow.request');
    Route::post('/borrow/approved_post/{id}', [BorrowController::class, 'approved'])->name('borrow.approved');
    Route::get('/borrow/approved/{id}/{auther_id}', [BorrowController::class, 'approved_post'])->name('borrow.approved_post');
    Route::get('/borrow/disapproved/{id}', [BorrowController::class, 'disapproved'])->name('borrow.disapproved');


    Route::get('/book_issue', [BookIssueController::class, 'index'])->name('book_issued');
    Route::get('/book-issue/create', [BookIssueController::class, 'create'])->name('book_issue.create');
    Route::get('/book-issue/edit/{id}', [BookIssueController::class, 'edit'])->name('book_issue.edit');
    Route::post('/book-issue/update/{id}', [BookIssueController::class, 'update'])->name('book_issue.update');
    Route::post('/book-issue/delete/{id}', [BookIssueController::class, 'destroy'])->name('book_issue.destroy');
    Route::post('/book-issue/create', [BookIssueController::class, 'store'])->name('book_issue.store');
    
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('/reports/Date-Wise', [ReportsController::class, 'date_wise'])->name('reports.date_wise');
    Route::post('/reports/Date-Wise', [ReportsController::class, 'generate_date_wise_report'])->name('reports.date_wise_generate');
    Route::get('/reports/monthly-Wise', [ReportsController::class, 'month_wise'])->name('reports.month_wise');
    Route::post('/reports/monthly-Wise', [ReportsController::class, 'generate_month_wise_report'])->name('reports.month_wise_generate');
    Route::get('/reports/not-returned', [ReportsController::class, 'not_returned'])->name('reports.not_returned');
    
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings');
});
