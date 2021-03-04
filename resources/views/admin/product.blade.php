@extends('admin/layout')
@section('page_title','Products')
@section('product_select','active')
@section('container')
    {{session('message')}}                          
    <h1 class="mb10">Category</h1>
    <a href="product/manage_product">
        <button type="button" class="btn btn-success">
            Add product
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>SLUG</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->category_id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->slug}}</td>
                            <td><img src="{{asset('storage/media/'.$list->image)}}" height="80px" width="80px" alt="{{$list->image}}"></td>
                            <td>
                                <a href="{{url('admin/product/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
@if($list->status==1)
                                <a href="{{url('admin/product/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-success">Activate</button></a>

@elseif($list->status==0)
                                <a href="{{url('admin/product/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Deactivate</button></a>
@endif 
                                <a href="{{url('admin/product/manage_product/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection