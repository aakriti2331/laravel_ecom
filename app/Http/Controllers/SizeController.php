<?php

namespace App\Http\Controllers;

use App\Models\size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data']=size::all();
        return view('admin/size',$result);
    }

    
    public function manage_size(Request $request,$id='')
    {
        if($id>0){
            $arr=size::where(['id'=>$id])->get(); 

            $result['size']=$arr['0']->size;
            $result['id']=$arr['0']->id;
        }else{
            $result['size']='';
            $result['id']=0;
            
        }
        return view('admin/manage_size',$result);
    }

    public function manage_size_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'size'=>'required',

        ]);

        if($request->post('id')>0){
            $model=size::find($request->post('id'));
            $msg="Size updated";
        }else{
            $model=new size();
            $msg="Size inserted";
        }
        $model->size=$request->post('size');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/size');
        
    }

    public function delete(Request $request,$id){
        $model=size::find($id);
        $model->delete();
        $request->session()->flash('message','size deleted');
        return redirect('admin/size');
    }
    public function status(Request $request,$status,$id){
        
        $model=size::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Status updated');
        return redirect('admin/size');
        // echo $type;
        // echo $id;
    }
}
