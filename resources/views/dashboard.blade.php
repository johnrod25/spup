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
                <!-- <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Staff</span>
                        <span class="info-box-number">{{ $authors }}</span>
                    </div>
                    </div>
                </div>               -->
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-book"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Inventory</span>
                        <span class="info-box-number">{{ $books }}</span>
                    </div>
                    </div>
                </div>
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4" title="<?php foreach($report_info as $report){ echo $report->book->name." - ".$report->description."\n"; } ?>">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-bug"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Damaged</span>
                        <span class="info-box-number">{{ $reported }}</span>
                    </div>
                    </div>
                </div>
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-4" title="<?php foreach($restock_info as $info){ echo $info->name." - ".$info->quantity." ".$info->type."\n"; } ?>">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cubes"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Need Restock</span>
                        <span class="info-box-number">{{ $restock }}</span>
                    </div>
                    </div>
                </div>
                <!-- <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-globe"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Location</span>
                        <span class="info-box-number">{{ $publishers }}</span>
                    </div>
                    </div>
                </div> -->
                <!-- <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-light elevation-1"><i class="fas fa-list"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Categories</span>
                        <span class="info-box-number">{{ $categories }}</span>
                    </div>
                    </div>
                </div> -->
                <!-- <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Faculty</span>
                        <span class="info-box-number">{{ $students }}</span>
                    </div>
                    </div>
                </div> -->
                <!-- <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-handshake"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Transactions</span>
                        <span class="info-box-number">{{ $issued_books }}</span>
                    </div>
                    </div>
                </div> -->
            </div>
                <!-- /.row -->
        </div>
    </section>
     <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@endsection