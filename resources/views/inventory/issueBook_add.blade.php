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
                    <h3>Add Borrow</h3>
                    <a class="add-new btn btn-primary" href="{{ route('transactions') }}">All Borrowed List</a>
                </div>
                <hr class="hr">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <form class="yourform" action="{{ route('transaction.create') }}" method="post"
                        autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label>Faculty Name</label>
                            <select class="form-control" name="student_id" required>
                                <option  value="{{ old('student_id') }}">Select Faculty Name</option>
                                @foreach ($students as $student)
                                    <option value='{{ $student->id }}'>{{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" onchange="updateItem(this)"  value="{{ old('category_id') }}" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Item Name - (Stocks)</label>
                            <select class="form-control" name="book_id" id="item_list"  value="{{ old('book_id') }}" required>
                                <option value="">Select Item Name</option>
                                <!-- @foreach ($books as $book)
                                    <option value='{{ $book->id }}'>{{ $book->name }}</option>
                                @endforeach -->
                            </select>
                            @error('book_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" step="any" class="form-control" name="quantity" required>
                            @error('quantity')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @error('error_message')
                            <div class='alert alert-danger'>{{ $message }}</div>
                        @enderror
                        <input type="submit" name="save" class="btn btn-success" value="Save">
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

<script>
    function updateItem(category){
        // alert(category.value)
        let itemlist = document.getElementById('item_list');
        $.ajax({
            type: 'get',
            url: "/transaction/updateitem/"+category.value,
            success: function(response){
                // alert(response.success);
                itemlist.innerHTML = '';
                response.items.forEach( (element) => {
                    itemlist.innerHTML += '<option value="'+element.id +'">'+element.name + ' - ('+ element.quantity+')</option>'
                });

            }
        });
    }
</script>
