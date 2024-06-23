 @extends('backend.master')
 @section('container')
 
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard v2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
    <div class="col-md-12">
        <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data"> 
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Product Name</label>
              <input type="text" class="form-control" name="name" value="{{$product->name}}" id="exampleInputEmail1" placeholder="Enter Product Name">
            </div>
          <div class="form-group">
              <label>Category</label>
              <select class="form-control select2" name="category_id" style="width: 100%;" >
              <option>Please Select The Category</option>
              @foreach(App\Models\Category::orderBy('name','asc')->get() as $category)
              <option value="{{$category->id}}" {{$category->id == $product->category->id ? 'selected' : ''}}>{{$category->name}}</option>
                      @endforeach
              </select>
          </div>
      
              <div class="form-group">
              <label for="exampleInputEmail1">Product Brand</label>
              <input type="text" class="form-control" name="brand" value="{{$product->brand}}" id="exampleInputEmail1" placeholder="Enter Product Brand">
            </div>

          <div class="form-group">
              <label for="exampleInputEmail1">Product Price</label>
              <input type="number" class="form-control" name="price" value="{{$product->price}}" id="exampleInputEmail1" placeholder="Enter Product Price">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Product Offer Price</label>
              <input type="number" class="form-control" name="offer_price" value="{{$product->offer_price}}" id="exampleInputEmail1" placeholder="Enter Offer Price">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Product SKU</label>
              <input type="text" class="form-control" name="sku" value="{{$product->sku}}" id="exampleInputEmail1" placeholder="Enter Product SKU">
            </div>
          <div class="form-group">
              <label for="exampleInputEmail1">Product Stock</label>
              <input type="text" class="form-control" name="stock" value="{{$product->stock}}" id="exampleInputEmail1" placeholder="Enter Product Stock">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Product Weight</label>
              <input type="text" class="form-control" name="weight" value="{{$product->weight}}" id="exampleInputEmail1" placeholder="Enter Product Weight">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Product Details</label>
              <textarea class="form-control" name="details"  id="exampleInputEmail1" placeholder="Enter Product Details">{{$product->details}}</textarea>
            </div>
            
            
          </div>
                <!-- /.card-body -->

                <div class="card-footer">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
    </div>
  </div>
  </div>
  @endsection