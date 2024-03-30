@extends('layouts.header')
@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid mt-2">

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">Reset Password</h2>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <form class="yourform" action="{{ route('change_password') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" name="c_password" value=""
                                required>
                            @error('c_password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password" value="" required>
                            @error('new_password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" value="" required>
                            @error('new_password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if(session()->has('error_message'))
                            <div class="alert alert-danger">
                                {{ session()->get('error_message') }}
                            </div>
                        @endif
                        @if(session()->has('success_message'))
                            <div class="alert alert-success">
                                {{ session()->get('success_message') }}
                            </div>
                        @endif
                        <input type="submit" class="btn btn-success" value="Update" required>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </section>
     <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@endsection
