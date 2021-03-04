<?php

namespace App\Http\Controllers;

use App\Models\coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data']=coupon::all();
        return view('admin/coupon',$result);
    }

    
    public function manage_coupon(Request $request,$id='')
    {
        if($id>0){
            $arr=coupon::where(['id'=>$id])->get(); 

            $result['title']=$arr['0']->title;
            $result['value']=$arr['0']->value;
            $result['code']=$arr['0']->code;
            $result['id']=$arr['0']->id;
        }else{
            $result['title']='';
            $result['value']='';
            $result['code']='';
            $result['id']=0;
            
        }
        return view('admin/manage_coupon',$result);
    }

    public function manage_coupon_process(Request $request)
    {
       // return $request->post();
    
        $request->validate([
            'title'=>'required',
            'value'=>'required',
            'code'=>'required|unique:coupons,code,'.$request->post('id'),   
        ]);

        if($request->post('id')>0){
            $model=coupon::find($request->post('id'));
            $msg="Coupon updated";
        }else{
            $model=new coupon();
            $msg="coupon inserted";
        }
        $model->title=$request->post('title');
        $model->code=$request->post('code');
        $model->value=$request->post('value');
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/coupon');
        
    }

    public function delete(Request $request,$id){
        $model=coupon::find($id);
        $model->delete();
        $request->session()->flash('message','coupon deleted');
        return redirect('admin/coupon');
    }
    public function status(Request $request,$status,$id){
        
        $model=coupon::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Status updated');
        return redirect('admin/coupon');
        // echo $type;
        // echo $id;
    }
}
