@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
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
                           
                           
                            
                            
                            
                              
                        </div>

                    
                 <h2 class="mb10">Product Attributes</h2>
            <div class="col-lg-12" id="product_attr_box">
               @php 
               $loop_count_num=1;
               @endphp
               @foreach($productAttrArr as $key=>$val)
               @php 
               $loop_count_prev=$loop_count_num;
               $pAArr=(array)$val;
               @endphp
               <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">
               <div class="card" id="product_attr_{{$loop_count_num++}}">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-2">
                              <label for="sku" class="control-label mb-1"> SKU</label>
                              <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['sku']}}" required>
                           </div>
                           <div class="col-md-2">
                              <label for="mrp" class="control-label mb-1"> MRP</label>
                              <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['mrp']}}" required>
                           </div>
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1"> Price</label>
                              <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['price']}}" required>
                           </div>
                           <div class="col-md-3">
                              <label for="size_id" class="control-label mb-1"> Size</label>
                              <select id="size_id" name="size_id[]" class="form-control">
                                 <option value="">Select</option>
                                 @foreach($size as $list)
                                 @if($pAArr['size_id']==$list->id)
                                    <option value="{{$list->id}}" selected>{{$list->size}}</option>
                                    @else
                                    <option value="{{$list->id}}">{{$list->size}}</option>
                                    @endif
                                
                                   
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="color_id" class="control-label mb-1"> Color</label>
                              <select id="color_id" name="color_id[]" class="form-control">
                                 <option value="">Select</option>
                                 @foreach($color as $list)
                                    @if($pAArr['size_id']==$list->id)
                                    <option value="{{$list->id}}" selected>{{$list->color}}</option>
                                    @else
                                    <option value="{{$list->id}}">{{$list->color}}</option>
                                    @endif
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-2">
                              <label for="qty" class="control-label mb-1"> Qty</label>
                              <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['qty']}}" required>
                           </div>
                           <div class="col-md-4">
                              <label for="attr_image" class="control-label mb-1"> Image</label>
                              <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                              @if($pAArr['attr_image']!='')
                            <img src="{{asset('storage/media/'.$pAArr['attr_image'])}}" height="80px" width="80px" alt="">
                            @endif
                           </div>
                           <div class="col-md-2">
                              <label for="attr_image" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                              
                              @if($loop_count_num==2)
                                <button type="button" class="btn btn-success btn-lg" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                              @else
                              <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg">
                                <i class="fa fa-minus"></i>&nbsp; Remove</button></a>
                              @endif  

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>

            <h2 class="mb10">Product Images</h2>
            <div class="col-lg-12" id="product_images_box">
               @php 
               $loop_count_image_num=1;
               @endphp
               @foreach($productImagesArr as $key=>$val)
               @php 
               $loop_count_image_prev=$loop_count_image_num;
               $pIArr=(array)$val;
               @endphp
               <input id="piid" type="hidden" name="piid[]" value="{{$pIArr['id']}}">
               <div class="card" >
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                        
                           <div class="col-md-2" id="product_images_{{$loop_count_image_num++}}">
                              <label for="images" class="control-label mb-1"> Image</label>
                              <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                              @if($pIArr['images']!='')
                            <img src="{{asset('storage/media/'.$pIArr['images'])}}" height="80px" width="80px" alt="">
                            @endif
                           </div>
                           <div class="col-md-2">
                              <label for="images" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                              
                              @if($loop_count_image_num==2)
                                <button type="button" class="btn btn-success btn-lg" onclick="add_images_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                              @else
                              <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg">
                                <i class="fa fa-minus"></i>&nbsp; Remove</button></a>
                              @endif  

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
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
<script>
        var loop_count=1; 
        function add_more(){
       loop_count++;
       var html='<input id="paid" type="text" name="paid[]" ><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';

       html+='<div class="col-md-2"><label for="sku" class="control-label mb-1"> SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>'; 

       html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1"> MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>'; 

       html+='<div class="col-md-2"><label for="price" class="control-label mb-1"> Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

       var size_id_html=jQuery('#size_id').html(); 
       html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1"> Size</label><select id="size_id" name="size_id[]" class="form-control">'+size_id_html+'</select></div>';

       var color_id_html=jQuery('#color_id').html(); 
       html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1"> Color</label><select id="color_id" name="color_id[]" class="form-control" >'+color_id_html+'</select></div>';

       html+='<div class="col-md-2"><label for="qty" class="control-label mb-1"> Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

       html+='<div class="col-md-4"><label for="attr_image" class="control-label mb-1"> Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';

       html+='<div class="col-md-2"><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 

       html+='</div></div></div></div>';

       jQuery('#product_attr_box').append(html)
   }
   function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
   }


    var loop_image_count=1;
    function add_images_more(){
    loop_image_count++;
    var  html='<div class="col-md-2" id="product_images_"'+loop_image_count+'><label for="images" class="control-label mb-1"> Image</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';
    html+='<div class="col-md-2"><label for="images" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more1("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 
    html+='</div></div>';
    jQuery('#product_images_box').append(html)
    }
    function remove_more1(loop_image_count){
    jQuery('#product_images_'+loop_image_count).remove();
    }
</script>
@endsection