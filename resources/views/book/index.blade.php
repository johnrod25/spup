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
                    <h3>Inventory</h3>
                    <a class="add-new btn btn-primary" href="{{ route('book.create') }}">Add Item</a>
                </div>
                <hr class="hr">
                <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <!-- <th>No.</th> -->
                            <th>Quantity</th>
                            <th>Item name</th>
                            <th>Category</th>
                            <th>Inventory Done by:</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <!-- <td class="id">{{ $book->id }}</td> -->
                                <td>{{ $book->quantity }}</td>
                                <td>{{ $book->name }}</td>
                                <td>{{ $book->category->name }}</td>
                                <td>{{ $book->auther->name }}</td>
                                <td>{{ $book->publisher->name }}</td>
                                <td>
                                    @if ($book->status == 'Y')
                                        <span class='badge badge-success'>Available</span>
                                    @else
                                        <span class='badge badge-danger'>Issued</span>
                                    @endif
                                </td>
                                <td class="edit">
                                    <a href="{{ route('book.edit', $book) }}" class="btn btn-success">Edit</a>
                                </td>
                                <td class="delete">
                                    <form action="{{ route('book.destroy', $book) }}" method="post"
                                        class="form-hidden">
                                        <button class="btn btn-danger delete-book">Delete</button>
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No Item Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                {{ $books->links('vendor/pagination/bootstrap-4') }}
                </table>
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
