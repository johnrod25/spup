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
                    <h3>Add Items</h3>
                    <a class="add-new btn btn-primary" href="{{ route('category.views', $cat_id) }}">All Items</a>
                </div>
                <hr class="hr">
                <div class="row">
                <div class="offset-md-3 col-md-6">
                    <form class="yourform" action="{{ route('inventory.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control @error('category_id') isinvalid @enderror " name="category_id" readonly required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" <?= $cat_id == $category->id ? 'selected':'';  ?> >{{ $category->name }}</option>
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
                                placeholder="Item Name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       <div class="row">
                        <div class="form-group col-md-6">
                                <label>Quantity</label>
                                <input type="number" class="form-control @error('quantity') isinvalid @enderror"
                                    placeholder="Quantity" name="quantity" value="{{ old('quantity') }}" required>
                                @error('quantity')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Unit Type</label>
                                <input type="text" class="form-control @error('type') isinvalid @enderror"
                                    placeholder="Unit Type (pcs | units | sets | L | mL | etc.)" name="type" value="{{ old('type') }}" required>
                                @error('type')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                       </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control @error('location') isinvalid @enderror"
                                    placeholder="Location" name="location" value="{{ old('location') }}" required>
                                @error('location')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <!-- <input type="text" class="form-control @error('status2') isinvalid @enderror"
                                placeholder="Status" name="status2" value="{{ old('status2') }}" required> -->
                            <select class="form-control @error('status2') isinvalid @enderror " name="status2" required>
                                <option value="Functional">Functional</option>
                                <option value="Not Functional">Not Functional</option>
                            </select>
                            @error('status2')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Inventory Done by</label>
                            <select class="form-control @error('auther_id') isinvalid @enderror " name="auther_id">
                                <option value="">Select Staff</option>
                                @foreach ($authors as $author)
                                    <option value='{{ $author->id }}'>{{ $author->name }}</option>";
                                @endforeach
                            </select>
                            @error('auther_id')
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
