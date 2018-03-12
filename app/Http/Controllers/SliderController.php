<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\AddSliderRequest;
use App\Http\Requests\EditSliderRequest;
use Illuminate\Support\Facades\Input;
use File,DateTime,Image;

class SliderController extends Controller
{
    /*------------------------------Lấy danh sách Slider----------------------------------------*/
    public function getSliders()
    {
        $items=Slider::all();
        return view('control.sliders.index',compact('items'));
    }
    /*------------------------------Thêm slider loại sản phẩm------------------------------------*/
    public function getAddSlider()
    {
        return view('control.sliders.slider');
    }
    
    /*-------------------------------Lưu thêm Slider-------------------------------------------*/
    public function postAddSlider(AddSliderRequest $request)
    {
        $slider =new Slider;
        $IdxMax= (count(Slider::all()) + 1);
        // Upload hình ảnh
        if ($request->file('Img')) {
            $image = $request->file('Img');
            $file_name = 'Upload/slider/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(1349, 500)->save($file_name,100);
            $slider->Img             =     $file_name;
        }
        else{$slider->Img            =     '';}
        $slider->Url                    =    $request->Url;
        $slider->Name                   =    $request->Name;
        $slider->IsActive               =     ($request->IsActive == 'on') ? 1 : 0;
        $slider->Idx                    =     $IdxMax;
        $slider->Locale                 =     'vi-vn';
        $slider->created_at             =     new DateTime();
        $slider->updated_at             =     new DateTime();

        $slider->save();
        return redirect()->route('getSliders');
    }
    /*---------------------------------Sửa Slider-----------------------------------------------*/
    public function getEditSlider($id)
    {   
        $item=Slider::find($id); // Lấy dữ liệu slider theo id
        if(count($item)>0){
            return view('control.sliders.slider',compact('item'));
        }
        else
        {
            $route='getSliders';
            $msg='Thông tin slider chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin slider chưa chính xác']);
        }
    }
    /*--------------------------------Lưu thay đổi Slider------------------------------------*/
    public function postEditSlider(Request $request)
    {
        $slider =Slider::Find($request->id);
        $IsActive=($request->IsActive == 'on') ? 1 : 0;
        // Upload hình ảnh
        if ($request->file('Img')) {
            $image = $request->file('Img');
            $file_name = 'Upload/slider/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(1349, 500)->save($file_name,100);
            if($slider->Img!='')
            {
                if (File::exists($slider->Img)) {
                    File::delete($slider->Img);
                }
            }
            $slider->Img             =     $file_name;
        }
        $slider->Url        =     $request->Url;
        $slider->Name        =     $request->Name;
        $slider->IsActive        =     $IsActive;
        $slider->updated_at      =     new DateTime();
        $slider->save();
        return redirect()->route('getSliders');
    }
    /*--------------------------------Xóa slider----------------------------------------------*/
    public function postSliderDel(Request $request)
    {
        $slider=Slider::find($request->id);
        if(count($slider)>0)
        {
            if (File::exists($slider->Img)) {
                File::delete($slider->Img);
            }
            $slider->delete();
            return redirect()->route('getSliders');
        }       
        else
        {
            $route='getSliders';
            $msg='Thông tin slider chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin slider chưa chính xác']);
        }
    }
    /*-----------------------------------Ajax Active Slider---------------------------------------*/
    public function postActiveSlider(Request $request)
    {
        if ($request->ajax()) {
            $slider=Slider::Find($request->id);
            $IsActive=($request->IsActive==0) ? 1 : 0;
            // lưu bảng slider
            $slider->IsActive  = $IsActive;
            $slider->save();
            return ($IsActive == 1) ? 'on' : 'off';
        }
    }
}
