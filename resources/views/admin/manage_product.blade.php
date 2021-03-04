@extends('admin/layout')
@section('page_title','Manage Product')
@section('container')


@if($id>0)
{{$image_required=""}}
@else
{{$image_required="required"}}
@endif
    <h1 class="mb10">Manage Product</h1>
    <a href="{{url('admin/product')}}">
        <button type="button" class="btn btn-success">
            Back
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                            @csrf
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Name</label>
                                                <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                @error('name')
                                                <div class="alert alert-danger" role="alert">
                                                    {{$message}}		
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cat_id" class="control-label mb-1">Category</label>
                                                <select id="category_id" value="{{$category_id}}" name="category_id"  class="form-control">
                                              
                                                @foreach($category as $list)
                                                @if($category_id==$list->id)
                                                <option selected value="{{$list->id}}">
                                                {{$list->category_name}}
                                                @else
                                                <option value="{{$list->id}}">
                                                {{$list->category_name}}</option>
                                                @endif
                                                @endforeach
                                                </select>
                                           
                                                @error('name')
                                                <div class="alert alert-danger" role="alert">
                                                    {{$message}}		
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="brand" class="control-label mb-1">Brand</label>
                                                <input id="brand" value="{{$brand}}" name="brand" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="model" class="control-label mb-1">Model</label>
                                                <input id="model" value="{{$model}}" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="short_desc" class="control-label mb-1">Short Description</label>
                                                    <textarea name="short_desc" id="short_desc" cols="30" rows="10" class="form-control" aria-required="true" aria-invalid="false" required>{{$short_desc}}</textarea>

                                            
                                            </div>
                                            <div class="form-group">
                                                <label for="long_desc" class="control-label mb-1">Long Description</label>
                                                <textarea name="long_desc" id="long_desc" cols="30" rows="10" class="form-control" aria-required="true" aria-invalid="false" required>{{$long_desc}}</textarea>                                            
                                            </div>
                                            <div class="form-group">
                                                <label for="keywords" class="control-label mb-1">keywords</label>
                                                <input id="keywords" value="{{$keywords}}" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="uses" class="control-label mb-1">uses</label>
                                                <input id="uses" value="{{$uses}}" name="uses" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="technical_spec" class="control-label mb-1">technical specifications</label>
                                                <input id="technical_spec" value="{{$technical_spec}}" name="technical_spec" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="warrenty" class="control-label mb-1">warranty</label>
                                                <input id="warrenty" value="{{$warranty}}" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="slug" class="control-label mb-1">Slug</label>
                                                <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                @error('slug')
                                                <div class="alert alert-danger" role="alert">
                                                    {{$message}}		
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Product Image</label>
                                                <input id="image" value="{{$image}}" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                                                @error('image')
                                                <div class="alert alert-danger" role="alert">
                                                    {{$message}}		
                                                </div>
                                                @enderror
                                            </div>
                                           
                                            
                                       
                                    </div>
                                </div>
                            </div>
                           
                           
                            
                            
                            
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                    <div class="form-group">
                                                <label for="mrp" class="control-label mb-1">Mrp</label> 
                                                <input id="mrp" value="" name="mrp" type="text" class="form-control" aria-required="true" aria-invalid="false" required>

                                            </div>
                                            <div class="form-group">
                                                <label for="sku" class="control-label mb-1">Sku</label>
                                                <input id="sku" value="" name="sku" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="price" class="control-label mb-1"> Price(Rs)</label>
                                                <input id="price" value="" name="price" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            
                                            </div>
                                    </div>
                                    </div>
                                    </div>    
                        </div>
                        
                        <div>


                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    Submit
                                                </button>
                                            </div>
                                            <input type="hidden" name="id" value="{{$id}}"/>
                        </form>
        </div>

       

    </div>
                        
@endsection