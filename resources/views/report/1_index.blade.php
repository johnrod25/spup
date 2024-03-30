@extends("layouts.header")
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
                <div class="row m-3">
                    <div class="offset-md-4 col-md-4">
                        <h2 class="admin-heading text-center">Reportssss</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book"></i></span>        
                        <div class="info-box-content">
                            <span class="info-box-text">Items</span>
                            <span class="info-box-number">1</span>
                        </div>
                        </div>
                    </div>

                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book"></i></span>        
                        <div class="info-box-content">
                            <span class="info-box-text">Items</span>
                            <span class="info-box-number">2</span>
                        </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book"></i></span>        
                        <div class="info-box-content">
                            <span class="info-box-text">Items</span>
                            <span class="info-box-number">1</span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                                <a href="{{ route('reports.date_wise') }}" class="card-link">
                                    <h5 class="card-title mb-0">Date Wise Report</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                                <a href="{{ route('reports.month_wise') }}" class="card-link">
                                    <h5 class="card-title mb-0">Monthly Wise Report</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                                <a href="{{ route('reports.not_returned') }}" class="card-link">
                                    <h5 class="card-title mb-0">Not Returned</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
