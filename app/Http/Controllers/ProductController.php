<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $result['data']=product::all();
        return view('admin/product',$result);
    }

    
    public function manage_product(Request $request,$id='')
    {


        if($id>0){
            $arr=product::where(['id'=>$id])->get(); 

            $result['category_id']=$arr['0']->category_id;
            $result['name']=$arr['0']->name;
            $result['slug']=$arr['0']->slug;
            $result['model']=$arr['0']->model;
            $result['brand']=$arr['0']->brand;
            $result['short_desc']=$arr['0']->short_desc;
            $result['long_desc']=$arr['0']->long_desc;
            $result['keywords']=$arr['0']->keywords;
            $result['technical_spec']=$arr['0']->technical_spec;
            $result['uses']=$arr['0']->uses;
            $result['warranty']=$arr['0']->warranty;
            $result['image']=$arr['0']->image;
            $result['id']=$arr['0']->id;
            $result['sku']=$arr['0']->sku;
            $result['mrp']=$arr['0']->mrp;            
            $result['price']=$arr['0']->price;
            $result['qty']=$arr['0']->qty;
            $result['color_id']=$arr['0']->color_id;
            $result['size_id']=$arr['0']->size_id;
        }else{
            $result['category_id']="";
            $result['name']="";
            $result['image']="";
            $result['slug']="";
            $result['model']="";
            $result['brand']="";
            $result['short_desc']="";
            $result['long_desc']="";
            $result['keywords']="";
            $result['technical_spec']="";
            $result['uses']="";
            $result['warranty']="";
            $result['sku']="";
            $result['mrp']="";            
            $result['price']="";
            $result['qty']="";
            $result['color_id']="";
            $result['size_id']="";
            $result['id']=0;
            
            
        }
        $result['color']=DB::table('colors')->where(['status'=>1])->get();
        $result['category']=DB::table('categories')->where(['status'=>1])->get();
        $result['size']=DB::table('sizes')->where(['status'=>1])->get();

        //dd($result);
        return view('admin/manage_product',$result);
    }

    public function manage_product_process(Request $request)
    {
        //return $request->post();
        if($request->post('id')>0){
          $image_validation="mimes:jpeg,jpg,png,gif";
        }else{
            $image_validation="required|mimes:jpeg,jpg,png,gif";
        }
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:products,slug,'.$request->post('id'),   
            'image'=>$image_validation,
            ]);

        if($request->post('id')>0){
            $model=product::find($request->post('id'));
            $msg="product updated";
        }else{
            $model=new product();
            $msg="product inserted";
        }

        if($request->hasFile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;

        }

        $model->name=$request->post('name');
        $model->category_id=$request->post('category_id');
        $model->brand=$request->post('brand');
        $model->model=$request->post('model');
        $model->short_desc=$request->post('short_desc');
        $model->long_desc=$request->post('long_desc');
 
        $model->slug=$request->post('slug');
        $model->uses=$request->post('uses');
        $model->warranty=$request->post('warranty');
        $model->technical_spec=$request->post('technical_spec');
        $model->keywords=$request->post('sku');
        $model->keywords=$request->post('price');
        $model->keywords=$request->post('mrp');
        $model->keywords=$request->post('image');
        $model->keywords=$request->post('qty');
        $model->status=1;
        
       //return $model;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/product');
        
    }

    public function delete(Request $request,$id){
        $model=product::find($id);
        $model->delete();
        $request->session()->flash('message','Product deleted');
        return redirect('admin/product');
    }

    public function status(Request $request,$status,$id){
        
        $model=product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Status updated');
        return redirect('admin/product');
        // echo $type;
        // echo $id;
    }
}
