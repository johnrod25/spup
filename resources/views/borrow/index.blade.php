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
                    <h3>Manage Borrows</h3>
                    <a class="add-new btn btn-primary" href="{{ route('borrow-form') }}"><i class="fas fa-plus"></i> Add Borrow</a>
                </div>
                <hr class="hr">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                <th>Date Requested</th>
                                <th>Requester Name</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <!-- <th>Phone</th>
                                <th>Email</th> -->
                                <!-- <th>Date Issued</th>
                                <th>Returned Date</th> -->
                                <!-- <th>Status</th> -->
                                <th>Actions</th>
                                <!-- <th>Disapprove</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr>
                                        <td>{{ date('Y-m-d',strtotime($book->created_at)) }}</td>
                                        <td>{{ $book->teacher }}</td>
                                        <td>{{ $book->book->name }}</td>
                                        <td>{{ $book->quantity }}</td>
                                        <!-- <td>
                                            @if ($book->issue_status == 'Y')
                                                <span class='badge badge-success'>Returned</span>
                                            @else
                                                <span class='badge badge-danger'>Issued</span>
                                            @endif
                                        </td> -->
                                        <td class="d-flex justify-content-center">
                                            <a class="btn btn-success mr-3" title="Approved" data-toggle="modal" data-target="#modal-approve"  onclick="openModal(<?= $book->id;?>)"><i class="fas fa-thumbs-up"></i></a>
                                            <a href="{{ route('borrow.disapproved', $book->id) }}"class="btn btn-danger" title="Disapproved"><i class="fas fa-thumbs-down"></i></a>                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">No Transaction Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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

<div class="modal fade" id="modal-approve" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Assign Staff</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="row needs-validation" >
            <div class="form-group col-12">
                <label>Staff Name</label>
                <select class="form-control" name="auther_id" id="staff_list"  value="{{ old('auther_id') }}" required>
                    <option value="">Select Staff</option>
                </select>
                @error('staff_id')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
          </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-success" data-toggle="tooltip" title="Set" class="btn btn-primary" id="book_id" onclick="submitModal(this)">Approve</a>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->

@endsection
<script>
    function updateItem(){
        // alert(category.value)
        let stafflist = document.getElementById('staff_list');
        $.ajax({
            type: 'get',
            url: "/borrow/getstaff",
            success: function(response){
                // alert(response.success);
                stafflist.innerHTML = '';
                response.staff.forEach( (element) => {
                    stafflist.innerHTML += '<option value="'+element.id +'">'+element.name+'</option>'
                });

            }
        });
    }
    function openModal(id){
        document.getElementById('book_id').value = id;
        updateItem();
    }
    function submitModal(id){
        let auther_id = $('#staff_list').val() 
        if(auther_id != ''){
            $.ajax({
                type: 'get',
                url: "/borrow/approved/"+id.value+"/"+auther_id,
                success: function(response){
                    window.location.href = "borrows";
                }
            });
        } else {
            $('#auther_id').focus();
        }
    }
</script>
