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
                    <h3>Manage Staff</h3>
                    <a class="add-new btn btn-primary" href="{{ route('staff.create') }}"><i class="fas fa-plus"></i> Add Staff</a>
                </div>
                <hr class="hr">
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Actions</th>
                            <!-- <th>Delete</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($authors as $auther)
                                <tr>
                                    <td>{{ $auther->id_number }}</td>
                                    <td>{{ $auther->name }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('staff.edit', $auther) }}" title="Edit Staff" class="btn btn-success mr-3"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('staff.destroy', $auther->id) }}" title="Delete Staff" class="btn btn-danger delete-author"><i class="fas fa-trash "></i></a>
                                    </td>
                                    <!-- <td class="delete">
                                        <form action="{{ route('staff.destroy', $auther->id) }}" method="post"
                                            class="form-hidden">
                                            <button class="btn btn-danger delete-author"><i class="fas fa-trash "></i> Delete</button>
                                            @csrf
                                        </form>
                                    </td> -->
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Staff Found</td>
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