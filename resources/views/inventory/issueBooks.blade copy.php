@extends('layouts.header')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Main content -->
    <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">               
                <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h3>Transactions</h3>
                    <a class="add-new btn btn-primary" href="{{ route('transaction.create') }}">Add Transaction</a>
                </div>
                <hr class="hr">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                <th>Id Number</th>
                                <th>Faculty Name</th>
                                <th>Item Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Date Issued</th>
                                <th>Returned Date</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr style='@if (date('Y-m-d') > $book->return_date->format('d-m-Y') && $book->issue_status == 'N') ) background:rgba(255,0,0,0.2) @endif'>
                                        <td>{{ $book->student->id_number }}</td>
                                        <td>{{ $book->student->name }}</td>
                                        <td>{{ $book->book->name }}</td>
                                        <td>{{ $book->student->phone }}</td>
                                        <td>{{ $book->student->email }}</td>
                                        <td>{{ $book->issue_date->format('d M, Y') }}</td>
                                        <td>{{ $book->return_date->format('d M, Y') }}</td>
                                        <td>
                                            @if ($book->issue_status == 'Y')
                                                <span class='badge badge-success'>Returned</span>
                                            @else
                                                <span class='badge badge-danger'>Issued</span>
                                            @endif
                                        </td>
                                        <td class="edit">
                                            <a href="{{ route('transaction.edit', $book->id) }}" class="btn btn-success">Edit</a>
                                        </td>
                                        <td class="delete">
                                            <form action="{{ route('transaction.destroy', $book) }}" method="post"
                                                class="form-hidden">
                                                <button class="btn btn-danger">Delete</button>
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">No Transaction Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $books->links('vendor/pagination/bootstrap-4') }}
                    </div>
                </div>

                
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
