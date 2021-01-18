<?php

namespace App\Http\Controllers;

use App\Img;
use Illuminate\Http\Request;

class ImgController extends Controller
{
    //展示相册添加视图
    public function index(){
        return view('index');
    }
//    文件异步上传方法
    public function file(Request $request){
       $data=$request->file('file')->store('','uploader');
//       拼接路径
        $data='/img/'.$data;
//        文件异步上传成功后，把图片路径返回给前端
        return ['code'=>200,'msg'=>'上传成功','data'=>$data];
    }
//    图片添加入库方法
     public function save(Request $request){
//        过滤token值
         $request->except('_token');
//         执行入库
         $data=Img::create($request->all());
         if($data){
             return redirect(route('img'));
         }
     }
//     展示图片列表
     public function imgindex(){
        $data=Img::where('state',1)->get();
       return view('img',compact('data'));
     }
     public function del($id){
//        根据id删除数据
         Img::destroy($id);
         return ['code'=>200,'msg'=>'删除成功','data'=>null];
     }
}
