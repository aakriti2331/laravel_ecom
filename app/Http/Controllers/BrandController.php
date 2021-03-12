<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $result['data']=brand::all();
        return view('admin/brand',$result);
    }

    
    public function manage_brand(Request $request,$id='')
    {
        if($id>0){
            $arr=brand::where(['id'=>$id])->get(); 

            $result['brand']=$arr['0']->brand;
            $result['image']=$arr['0']->image;
            $result['id']=$arr['0']->id;
        }else{
            $result['brand']='';
            $result['image']='';
            $result['id']=0;
            
        }
        return view('admin/manage_brand',$result);
    }

    public function manage_brand_process(Request $request)
    {
        //return $request->post();
        if($request->post('id')>0){
            $image_validation="mimes:jpeg,jpg,png,gif";
          }else{
              $image_validation="";
          } 
        $request->validate([
            'brand'=>'required|unique:brands,brand,'.$request->post('id'),
            'image'=>$image_validation,   
        ]);

        if($request->post('id')>0){
            $model=brand::find($request->post('id'));
            $msg="brand updated";
        }else{
            $model=new brand();
            $msg="Brand inserted";
        }
        if($request->hasFile('image')){
            //dd('hello');
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;

        }

        $model->brand=$request->post('brand');

        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/brand');
        
    }

    public function delete(Request $request,$id){
        $model=brand::find($id);
        $model->delete();
        $request->session()->flash('message','Brand deleted');
        return redirect('admin/brand');
    }

    public function status(Request $request,$status,$id){
        
        $model=brand::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Status updated');
        return redirect('admin/brand');
        // echo $type;
        // echo $id;
    }
}
