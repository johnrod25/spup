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
                    <h3>Manage Transactions</h3>
                    <!-- <a class="add-new btn btn-primary" href="{{ route('transaction.create') }}"><i class="fas fa-plus"></i> Add Transaction</a> -->
                </div>
                <hr class="hr">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Staff Assigned</th>
                                    <th>Requester Name</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Date Issued</th>
                                    <!-- <th>Returned Date</th> -->
                                    <th>Status</th>
                                    <th>Actions</th>
                                    <!-- <th>Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr <?php if(date('Y-m-d') > date('Y-m-d',strtotime($book->return_date)) && $book->issue_status == 'N'){ echo "style='background:rgba(255,0,0,0.2)'";} ?>>
                                        <td> <?php if($book->auther_id != 0) { echo $book->auther->name;}else{ echo "None";}  ?></td>
                                        <td>{{ $book->teacher }}</td>
                                        <td>{{ $book->book->name }}</td>
                                        <td>{{ $book->quantity }}</td>
                                        <td>{{ $book->issue_date }}</td>
                                        <!-- <td>{{ $book->return_date }}</td> -->
                                        <td>
                                        @if ($book->issue_status == 'P')
                                                <span class='badge badge-info'>Pending</span>
                                            @elseif ($book->issue_status == 'Y')
                                                <span class='badge badge-success'>Returned</span>
                                            @elseif ($book->issue_status == 'D')
                                                <span class='badge badge-danger'>Rejected</span>
                                            @elseif ($book->issue_status == 'I')
                                                <span class='badge badge-primary'>Issued</span>
                                            @else
                                                <span class='badge badge-danger'>Reported</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('borrow.edit', $book->id) }}" class="btn btn-info mr-3" title="view"><i class="fas fa-eye"></i></a>
                                            <form action="{{ route('borrow.destroy', $book->id) }}" method="post"
                                                class="form-hidden">
                                                <button class="btn btn-danger" title="delete"> <i class="fas fa-trash"></i></button>
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
