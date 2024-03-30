@extends('layouts.header')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid mt-2">
            <!-- Info boxes -->
            <div class="row p-3">
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Items</span>
                        <span class="info-box-number">{{ $books }}</span>
                    </div>
                    </div>
                </div>
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Categories</span>
                        <span class="info-box-number">{{ $categories }}</span>
                    </div>
                    </div>
                </div>
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-handshake"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Borrow</span>
                        <span class="info-box-number">{{ $issued_books }}</span>
                    </div>
                    </div>
                </div>
            </div>
                <!-- /.row -->
        </div>
    </section>
     <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@endsection