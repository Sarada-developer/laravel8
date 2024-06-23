@extends('backend.master')
@section('container')
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
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              
              <a href="{{url('/product')}}"><button class="btn btn-primary">Add Product</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Serial No.</th>
                    <th>Product Name</th>
                    <th>Category ID</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Offer Price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                 <tbody>
                     @foreach($product as $item)
                     <tr>
                     <td>{{$item['id']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['category_id']}}</td>
                        <td>{{$item['brand']}}</td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['offer_price']}}</td>
                        <td><a href="{{url('product/edit/')}}/{{$item->id}}"> <button class="btn btn-primary">Edit</button></a>&nbsp
                       <a href="{{url('product/delete/')}}/{{$item->id}}"> <button class="btn btn-danger">Delete</button></a></td>
                     </tr>
                     @endforeach
                 </tbody>
                  <tfoot>
                  <tr>
                  <th>Serial No.</th>
                    <th>Product Name</th>
                    <th>Category ID</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Offer Price</th>

                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
</div>
    @endsection