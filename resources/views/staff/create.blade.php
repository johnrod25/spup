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
                    <h3>Add Staff</h3>
                    <a class="add-new btn btn-primary" href="{{ route('staff') }}">All Staff</a>
                </div>
                <hr class="hr">
                <div class="row">
                    <div class="offset-md-3 col-md-6">
                <form class="yourform" action="{{ route('authors.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label>Id Number</label>
                        <input type="text" class="form-control @error('id_number') isinvalid @enderror" placeholder="Id Number" name="id_number" value="{{ old('id_number') }}" required>
                        @error('id_number')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Staff Name</label>
                        <input type="text" class="form-control @error('name') isinvalid @enderror" placeholder="Staff Name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control @error('username') isinvalid @enderror" placeholder="Username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="submit" name="save" class="btn btn-success" value="Save" required>
                </form>
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
