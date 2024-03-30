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
                    <h3>Manage Items</h3>
                    <a class="add-new btn btn-primary" href="{{ route('inventory.create', $cat_id) }}"><i class="fas fa-plus"></i> Add Item</a>
                </div>
                <hr class="hr">
                <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th colspan="7">
                                <h6 class="text-center"><?php echo $cat_name; ?></h6>
                            </th>
                        </tr>
                        <tr>
                            <!-- <th>No.</th> -->
                            <th>Quantity</th>
                            <th>Item Description</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Stock Status</th>
                            <th>Inventory Done by:</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                            <!-- <th>Delete</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>{{ $book->quantity.' '.$book->type }}</td>
                                <td>{{ $book->name }}</td>
                                <td>{{ $book->publisher->name }}</td>
                                <td>{{ $book->status2 }}</td>
                                <td>
                                     @if ($book->quantity > 0)
                                        <span class='badge badge-success'>Available</span>
                                    @else
                                        <span class='badge badge-danger'>Not Available</span>
                                    @endif
                                </td>
                                <td>{{ $book->auther->name }}</td>
                                <!-- <td>
                                    @if ($book->status == 'Y')
                                        <span class='badge badge-success'>Available</span>
                                    @else
                                        <span class='badge badge-danger'>Issued</span>
                                    @endif
                                </td> -->
                                <td class="edit row">
                                    <a href="{{ route('inventory.edit', $book) }}" class="btn btn-success mr-3" title="Edit Item"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('inventory.destroy', $book) }}" method="post"
                                        class="form-hidden">
                                        <button class="btn btn-danger delete-book" title="Delete Item"><i class="fas fa-trash"></i></button>
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
