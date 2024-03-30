
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
                                <td><b>{{ $book->quantity }} {{ $type->type }}</b></td>
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
                            @elseif ($book->issue_status == 'D')
                                <tr>
                                    <td>Status</td>
                                    <td><b>Rejected</b></td>
                                </tr>
                            @endif
                        </table>
                        <div class="row">
                            @if ($book->issue_status == 'P')
                            <form action="{{ route('borrow.issued', $book->id) }}" method="post" autocomplete="off" class="mr-3">
                                @csrf
                                <input type='submit' class='btn btn-success' name='save' value='Issue Item'>
                            </form>
                            @elseif ($book->issue_status == 'I')
                            <form action="{{ route('borrow.update', $book->id) }}" method="post" autocomplete="off" class="mr-3">
                                @csrf
                                <input type='submit' class='btn btn-success' name='save' value='Return Item'>
                            </form>
                            @endif
                            <form>
                                <input type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-reported" onclick="openModalReport(<?= $book->id;?>)" value="Report Item">
                            </form>
                            
                        </div>
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


<div class="modal fade" id="modal-reported" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Report Reason</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="row needs-validation" >
            <div class="form-group col-12">
                <label>Description</label>
                <input type="text" class="form-control" name="description" id="report_desc"  value="{{ old('description') }}" placeholder="Reason for report.." required>
                @error('description')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
          </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" data-toggle="tooltip" title="Set" class="btn btn-primary" id="book_id" onclick="submitModal(this)">Report</a>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->

@endsection
<script>
    function openModalReport(id){
        document.getElementById('book_id').value = id;
    }

    function submitModal(id){
        let report_desc = $('#report_desc').val() 
        if(report_desc != ''){
            $.ajax({
                type: 'get',
                // data:{
                //     id:id.value,
                //     report_desc:report_desc,
                // },
                url: "/borrow/reported/"+id.value+"/"+report_desc,
                // url:"/borrow/reported_ajax",
                success: function(response){
                    // window.location.href = "transactions";
                    $('#modal-reported').modal('hide');
                    successToast(response.success)
                }
            });
        } else {
            $('#report_desc').focus();
        }
    }
</script>

