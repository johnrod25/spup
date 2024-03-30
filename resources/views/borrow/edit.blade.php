@extends('layouts.header')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Main content -->
    <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card pb-5">               
                <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h3>Return Item</h3>
                </div>
                <hr class="hr">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="yourform">
                        <table cellpadding="10px" width="90%" style="margin: 0 0 20px;">
                            <tr>
                                <td>Requester Name: </td>
                                <td><b>{{ $book->teacher }}</b></td>
                            </tr>
                            <tr>
                                <td>Item Name : </td>
                                <td><b>{{ $book->book->name }}</b></td>
                            </tr>
                            <tr>
                                <td>Quantity: </td>
                                <td><b>{{ $book->quantity }}</b></td>
                            </tr>
                            <tr>
                                <td>Issue Date : </td>
                                <td><b>{{ date('Y-m-d', strtotime($book->issue_date)) }}</b></td>
                            </tr>
                            <tr>
                                <td>Return Date : </td>
                                <td><b>{{ date('Y-m-d', strtotime($book->return_date)) }}</b></td>
                            </tr>
                            @if ($book->issue_status == 'Y')
                                <tr>
                                    <td>Status</td>
                                    <td><b>Returned</b></td>
                                </tr>
                                <tr>
                                    <td>Returned On</td>
                                    <td><b>{{ date('Y-m-d', strtotime($book->return_day)) }}</b></td>
                                </tr>
                            @else
                                @if (date('Y-m-d') > date('Y-m-d', strtotime($book->return_date)) )
                                    <tr>
                                        <td>Fine</td>
                                        <td>Rs. {{ $fine }}</td>
                                    </tr>
                                @endif
                            @endif
                        </table>
                        @if ($book->issue_status == 'N')
                        <div class="row">
                            <form action="{{ route('borrow.update', $book->id) }}" method="post" autocomplete="off" class="mr-3">
                                @csrf
                                <input type='submit' class='btn btn-success' name='save' value='Return Item'>
                            </form>
                            <form action="{{ route('borrow.update', $book->id) }}" method="post" autocomplete="off">
                                @csrf
                                <input type='submit' class='btn btn-danger' name='report' value='Report Item'>
                            </form>
                        </div>
                        @endif
                    </div>
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