<?php

namespace App\Http\Controllers;

use App\Models\color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data']=color::all();
        return view('admin/color',$result);
    }

    
    public function manage_color(Request $request,$id='')
    {
        if($id>0){
            $arr=color::where(['id'=>$id])->get(); 

            $result['color']=$arr['0']->color;
            $result['size']=$arr['0']->size;
            $result['id']=$arr['0']->id;
        }else{
            $result['color']='';
            $result['size']='';
            $result['id']=0;
            
        }
        return view('admin/manage_color',$result);
    }

    public function manage_color_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'size'=>'required',
            'color'=>'required|unique:colors,color,'.$request->post('id'),   
        ]);

        if($request->post('id')>0){
            $model=color::find($request->post('id'));
            $msg="color updated";
        }else{
            $model=new color();
            $msg="color inserted";
        }
        $model->color=$request->post('color');
        $model->size=$request->post('size');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/color');
        
    }

    public function delete(Request $request,$id){
        $model=color::find($id);
        $model->delete();
        $request->session()->flash('message','color deleted');
        return redirect('admin/color');
    }

    public function status(Request $request,$status,$id){
        
        $model=color::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Status updated');
        return redirect('admin/color');
        // echo $type;
        // echo $id;
    }
}
