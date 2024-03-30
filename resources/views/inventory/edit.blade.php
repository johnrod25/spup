@extends('layouts.header')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Main content -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card bg-light pb-5">               
                <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h3>Update Item</h3>
                </div>
                <hr class="hr">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <form class="yourform" action="{{ route('inventory.update', $book->id) }}" method="post"
                        autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control @error('category_id') isinvalid @enderror " name="category_id"
                                >
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    @if ($category->id == $book->category_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" class="form-control @error('name') isinvalid @enderror"
                                placeholder="Item Name" name="name" value="{{ $book->name }}" >
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Quantity</label>
                                <input type="number" class="form-control @error('name') isinvalid @enderror"
                                    placeholder="Quantity" name="quantity" value="{{ $book->quantity }}" >
                                @error('quantity')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Unit Type</label>
                                <input type="text" class="form-control @error('type') isinvalid @enderror"
                                    placeholder="Unit Type" name="type" value="{{ $book->type }}" >
                                @error('type')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control @error('status2') isinvalid @enderror "
                                name="status2" >
                                <option value="Functional" <?= $book->status2 == 'Functional' ? 'selected': '' ?>>Functional</option>
                                <option value="Not Functional" <?= $book->status2 == 'Not Functional' ? 'selected': '' ?>>Not Functional</option>
                            </select>
                            @error('status2')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control @error('location') isinvalid @enderror"
                                    placeholder="Location" name="location" value="{{ $book->location }}" >
                                @error('location')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Inventory Done by</label>
                            <select class="form-control @error('auther_id') isinvalid @enderror " name="author_id">
                                <option value="">Select Staff</option>
                                @foreach ($authors as $auther)
                                    @if ($auther->id == $book->auther_id)
                                        <option value="{{ $auther->id }}" selected>{{ $auther->name }}</option>
                                    @else
                                        <option value="{{ $auther->id }}">{{ $auther->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('auther_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" name="save" class="btn btn-success" value="Update" >
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

