@extends('staffportal.header')
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
                    <h3>Manage Categories</h3>
                    <a class="add-new btn btn-primary" href="{{ route('category.create') }}"><i class="fas fa-plus"></i> Add Category</a>
                </div>
                <hr class="hr">
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                            <!-- <th>No.</th> -->
                            <th width="85%">Category Name</th>
                            <th >Action</th>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <!-- <td>{{ $category->id }}</td> -->
                                    <td >{{ $category->name }}</td>
                                    <td class="edit d-flex">
                                        <a href="{{ route('category.views', $category->id) }}" class="btn btn-info mx-3" title="View Category"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('category.edit', $category) }}" class="btn btn-success mr-3" title="Edit Category"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('category.destroy', $category) }}" method="post"
                                            class="form-hidden">
                                            <button class="btn btn-danger delete-author"title="Delete Category"><i class="fas fa-trash"></i></button>
                                            @csrf
                                        </form>
                                    </td>
                                    <!-- <td class="delete">
                                    </td> -->
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Category Found</td>
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