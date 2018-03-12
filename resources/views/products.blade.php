@extends('layouts.master')
@section('slider')
    @include('layouts.slider')
@endsection
@section('content')
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="main-breadcrumb">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="">Trang chủ</a></li>
                        <li class="active breadcrumb-title">{!!$RootName!!}</li>
                    </ol>
                </div>
            </div>
            <div class="register-partner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="header-name">
                            <h1>BẢNG GIÁ {!!$RootName!!}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-list-grid">
                <div class="row" style="margin:0;border: 2px #ccc solid;">
                @if($items->count() > 0)
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tuyến đường</th>
                            <th>Loại dịch vụ</th>
                            <th>Chiều đi</th>
                            <th>Loại xe</th>
                            <th>Giá vé</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{$item->Name}}</td>
                            <td>{{($item->IsHot==0)?'Du lịch': 'Vận tải'}}</td>
                            <td>{{($item->IsHome==0)?'1 chiều': '2 Chiều'}}</td>
                            <td>{{$item->category()->first()->Name}}</td>

                            <td>{{number_format($item->Price,0,',','.')}} VNĐ</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <code> Sản phẩm đang cập nhật</code>
                @endif
                </div>
            </div>
            <div class="colletion-topbar">
                <div class="pull-right">
                    {!!$items->links()!!}
                </div>
            </div>
        </div>
    </div>
    <div class="register-partner">
        <div class="container-fluid">
            <div class="row">
                <div class="header-name">
                    <h2>ĐĂNG KÝ KHÁCH HÀNG</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-style form-login">
                    @if ($errors->count() > 0)
                        @foreach ($errors as $element)
                            {{ $element->first() }}
                        @endforeach
                    @endif
                    <form accept-charset="UTF-8" action="{!!route('postAddCart')!!}" id="customer_register" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="{{ $errors->has('FullName') ? ' has-error' : '' }}" name="FullName" required="" value="@if (old('FullName')){{old('FullName')}}@else{{(Auth::guard('account')->check()) ? Auth::guard('account')->user()->FullName : ''}}@endif" requiredmsg="Vui lòng nhập đầy đủ Họ và Tên" placeholder="Nhập Họ và Tên">
                            @if ($errors->has('FullName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('FullName') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="{{ $errors->has('Email') ? ' has-error' : '' }}" name="Email" required="" requiredmsg="Vui lòng nhập địa chỉ Email" placeholder="Địa chỉ Email" value="@if (old('Email')){{old('Email')}}@else{{(Auth::guard('account')->check()) ? Auth::guard('account')->user()->Email : ''}}@endif">
                            @if ($errors->has('Email'))
                                <span class="help-block">
                                    <strong>{{ ($errors->first('Email')=='The email has already been taken.') ? 'Email đã được đăng ký.' : $errors->first('Email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="{{ $errors->has('Phone') ? ' has-error' : '' }}" name="Phone" required="" requiredmsg="Vui lòng nhập Số điện thoại" placeholder="Số điện thoại" value="@if (old('Phone')){{old('Phone')}}@else{{(Auth::guard('account')->check()) ? Auth::guard('account')->user()->Phone : ''}}@endif">
                            @if ($errors->has('Phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="{{ $errors->has('Address') ? ' has-error' : '' }}"  requiredmsg="Vui lòng nhập Địa chỉ " name="Address" required="" placeholder="Địa chỉ"  value="@if (old('Address')){{old('Address')}}@else{{(Auth::guard('account')->check()) ? Auth::guard('account')->user()->Address : ''}}@endif">
                            @if ($errors->has('Address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @if ($root=='ve-xe-tet')
                        <div class="row hidden">
                            <div class="col-md-6">
                                <input type="text" class="{{ $errors->has('Company') ? ' has-error' : '' }}" name="Company" requiredmsg="Vui lòng nhập Tên công ty" placeholder="Tên công ty"  value="@if (old('Company')){{old('Company')}}@else{{(Auth::guard('account')->check()) ? Auth::guard('account')->user()->Company : 'Vé xe tết'}}@endif">
                                @if ($errors->has('Company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Company') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="{{ $errors->has('Role') ? ' has-error' : '' }}"  requiredmsg="Vui lòng nhập chức vụ" name="Role" placeholder="Chức vụ"  value="@if (old('Role')){{old('Role')}}@else{{(Auth::guard('account')->check()) ? Auth::guard('account')->user()->Role : 'Vé xe tết'}}@endif">
                                @if ($errors->has('Role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row hidden">
                            <div class="col-md-6">
                                <input type="text" class="{{ $errors->has('Weight') ? ' has-error' : '' }}" name="Weight" required="" placeholder="Khối lượng" value="0">
                                @if ($errors->has('Weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="VehicleType" value="{{\App\Models\Category::where('Alias',$root)->first()->id}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="time" name="TimeStart" class="form-control" required="required" title="" placeholder="Giờ đi">
                            </div>
                            <div class="col-md-6">
                                <input type="date" name="DateStart" class="form-control" value="" required="required" title="" placeholder="Ngày đi">
                            </div>
                        </div>
                        <div class="row hidden">
                            <div class="col-md-6">
                                <div class="radio">
                                    <label id="1chieu">
                                        <input type="radio" name="IsHome" id="input" value="0" checked="checked">
                                        1 Chiều
                                    </label>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="{{ $errors->has('Company') ? ' has-error' : '' }}" name="Company" placeholder="Tên công ty (nếu có)"  value="@if (old('Company')){{old('Company')}}@else{{(Auth::guard('account')->check()) ? Auth::guard('account')->user()->Company : ''}}@endif">
                            @if ($errors->has('Company'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Company') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <select name="Role"  style="margin: 0;" id="check-role">
                                <option value="0">Loại hình Du lịch</option>
                                <option value="1">Loại hình Vận tải</option>
                            </select>
                        </div>
                    </div>
                    <div class="row chieudi">
                        <div class="col-md-6">
                            <div class="radio">
                                <label class="2chieu">
                                    <input type="radio" name="IsHome" value="0" checked="checked">
                                    1 Chiều
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="radio">
                                <label class="2chieu">
                                    <input type="radio" name="IsHome" value="1">
                                    2 Chiều
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="time" name="TimeStart" class="form-control" required="required" title="" placeholder="Giờ đi">
                        </div>
                        <div class="col-md-6">
                            <input type="date" name="DateStart" class="form-control" value="" required="required" title="" placeholder="Ngày đi">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" class="{{ $errors->has('Weight') ? ' has-error' : '' }}" name="Weight" placeholder="Khối lượng Kg (nếu có)" value="{{old('Weight')}}" >
                            @if ($errors->has('Weight'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Weight') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <select name="VehicleType" class="{{ $errors->has('VehicleType') ? ' has-error' : '' }}" required="required" style="margin: 0;" id="loaixe">
                                @php
                                    $getDichvu=\App\Models\Category::where(['Alias'=>'dich-vu','Type'=>3])->first();
                                @endphp
                                @if ($getDichvu and $getDichvu->categorys()->where(['IsActive'=>1,'Type'=>3])->count() > 0)
                                    @foreach ($getDichvu->categorys()->where(['IsActive'=>1,'Type'=>3])->orderBy('Idx')->get() as $element)
                                <option value="{{$element->id}}">{{$element->Name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('VehicleType'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('VehicleType') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="{{ $errors->has('AddressStart') ? ' has-error' : '' }}" name="AddressStart" id="start" placeholder="Địa điểm đi" value="{{old('AddressStart')}}">
                            @if ($errors->has('AddressStart'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('AddressStart') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="{{ $errors->has('AddressEnd') ? ' has-error' : '' }}" name="AddressEnd" id="end" placeholder="Địa điểm đến" value="{{old('AddressEnd')}}" >
                            @if ($errors->has('AddressEnd'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('AddressEnd') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-sm btn-default" id="checkprice">Giá tạm tính</button>
                        </div>
                        <div class="col-md-6">
                            <label id="tinhgia"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="{{ $errors->has('Note') ? ' has-error' : '' }}" name="Note" required="" placeholder="Yêu cầu" row="5">{{old('Note')}}</textarea>
                            @if ($errors->has('Note'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                            <button class="btn-cart">Đặt xe</button>
                        </div>
                    </div>
                    @if (session()->has('msg'))
                    <script>alert("{{session()->get('msg')}}");</script>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsProduct')
<script src="{{asset('js/owl.carousel.min.1.js')}}"></script>
<script >
    $(document).ready(function(){
        $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
        $('#check-role').change(function(){
            if ($(this).val()==1) {
                $('.chieudi').html('<div class="col-md-6"><div class="radio"><label id="1chieu"><input type="radio" name="IsHome" id="input" value="0" checked="checked">1 Chiều</label></div></div>');
            } else {
                $('.chieudi').html('<div class="col-md-6"><div class="radio"><label id="1chieu"><input type="radio" name="IsHome" id="input" value="0" checked="checked">1 Chiều</label></div></div><div class="col-md-6"><div class="radio"><label id="2chieu"><input type="radio" name="IsHome" value="1">2 Chiều</label></div></div>')
            }
        });
        $('#checkprice').click(function(){
            var AddressStart=$('input[name="AddressStart"]').val();
            var AddressEnd=$('input[name="AddressEnd"]').val();
            var Role=$('select[name="Role"]').val();
            var IsHome=$('input:radio[name="IsHome"]:checked').val();
            var Weight=$('input[name="Weight"]').val();
            var VehicleType=$('select[name="VehicleType"]').val();
            console.log(Role);
            if (AddressStart=='') {alert('Chưa nhập địa chỉ đi!');}
            else {
                if (AddressEnd=='') {alert('Chưa nhập địa chỉ đến');} 
                else {
                    if (Role==1 && Weight=='') {alert('Chưa nhập khối lượng!');} 
                    else {
                        $.ajax({
                        url:'{{route('postcheckKm')}}', 
                        type:'post',
                        cache:false,
                        data:{AddressStart:AddressStart,AddressEnd:AddressEnd,Role:Role,IsHome:IsHome,Weight:Weight,VehicleType:VehicleType},
                        dataType:'html',
                        success:function(msg){                        
                            $('#tinhgia').html(msg);
                        },
                        error:function(){ alert('Truyền dữ liệu thất bại');}
                        });
                    }
                }
            }
        });
    });
</script>
@endsection