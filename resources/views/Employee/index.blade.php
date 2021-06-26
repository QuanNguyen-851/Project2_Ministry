@extends('layouts.layout')
@section('main')
    <h1>Danh sách nhân viên
        <i class="fa fa-users"></i>
    </h1>
  
        <div class="table-responsive">
            <div class="card">
                <div class="row">
                            <div class="content">
                                <ul role="tablist" class="nav nav-tabs">
                                      <form class="navbar-form navbar-left navbar-search-form" role="search" style="    margin: 0;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" value="{{$search}}" name ="search" class="form-control" placeholder="Search...">
                                        </div>
                                    </form>
                                    
                                    <form action="">
                                        <button type="submit" name="btn"class="btn btn-primary btn-fill" style="float: right;margin-right: 15px;" >Đồng ý</button>
                                        <input type="file" name="file" class="form-control" style="float: right;width: 25%;" messages="ssdhf">
                                    </form>
                                    <li class=" active">
                                        <a href="#settings" class=" active" data-toggle="tab">Tất cả </a>
                                    </li>
                                    <li role="presentation" >
                                        <a href="#agency" data-toggle="tab">Giáo vụ</a>
                                    </li>
                                    <li>
                                        <a href="#company" data-toggle="tab">Kế toán</a>
                                    </li>
                                   
                                    
                                    
                                </ul>

                                <div class="tab-content">
                                    {{-- tất cả --}}
                                    <div id="settings" class="tab-pane active">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th class="text-center">Username</th>
                                                    <th class="text-center">Họ Và tên</th>
                                                    <th class="text-center">giới tính</th>
                                                    <th class="text-center">ngày sinh</th>
                                                    <th  class="text-center">số điện thoại</th>
                                                    <th class="text-center">Vị trí</th>
                                                    
                                                    <th  >
                                                        <a href="" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                                                        <i class="pe-7s-add-user" > Thêm Nhân viên</i>
                                                    </a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allemployee as $item)
                                                <tr>
                                                    <th class="text-center">{{$item->userName}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    
                                                    <th class="text-center">
                                                    @php
                                                        $gt = ($item->gender == 1) ? "Nam" : "Nữ";
                                                    @endphp
                                                    {{$gt}}
                                                    </th>
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center" >{{$item->phone}}</th>
                                                    <th class="text-center"> 
                                                        @if ($item->permission == 1)
                                                            {{"Giáo vụ"}}
                                                        @else
                                                        {{"Kế toán"}}
                                                        @endif
                                                    </th>
                                                    
                                                    <td class="td-actions text-right">
                                                       
                                                        <a rel="tooltip" title="Show" class="btn btn-success btn-link btn-sm" href="">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                            
                                                           @if ($item->block ==1)
                                                               
                                                           <a rel="tooltip" title="Unblock" class="btn btn-warning btn-link btn-sm btn-fill" href="{{ route('unblock', $item->id)}}" onclick="return confirm('bạn chắc chứ ! ')">
                                                                <i class="pe-7s-check" ></i>
                                                            </a>
                                                            @else
                                                            <a rel="tooltip" title="Block" class="btn btn-danger btn-link btn-sm" href="{{ route('block', $item->id)}}" onclick="return confirm('bạn chắc chứ ! ')">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                           @endif
                                                            
                                                       
                                                    </td>
                                                </tr>    
                                                @endforeach
                                                
    
                                            </tbody>
                                        </table> 
                                        <div style="text-align: center;">
                                        {{ $allemployee->appends(['search'=>$search])->links('pagination::bootstrap-4') }}
                                        </div>

                                    </div>
                                    {{-- Giáo vụ--}}
                                    <div id="agency" class="tab-pane ">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th class="text-center">Username</th>
                                                    <th class="text-center">Họ Và tên</th>
                                                    <th class="text-center">giới tính</th>
                                                    <th class="text-center">ngày sinh</th>
                                                    <th  class="text-center">số điện thoại</th>
                                                    <th class="text-center">Vị trí</th>
                                                    
                                                    <th  >
                                                        <a href="" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                                                        <i class="pe-7s-add-user" > Thêm Nhân viên</i>
                                                    </a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Miemployee as $item)
                                                <tr>
                                                    <th class="text-center">{{$item->userName}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    
                                                    <th class="text-center">
                                                    @php
                                                        $gt = ($item->gender == 1) ? "Nam" : "Nữ";
                                                    @endphp
                                                    {{$gt}}
                                                    </th>
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center" >{{$item->phone}}</th>
                                                    <th class="text-center"> 
                                                        @if ($item->permission == 1)
                                                            {{"Giáo vụ"}}
                                                        @else
                                                        {{"Kế toán"}}
                                                        @endif
                                                    </th>
                                                    
                                                    <td class="td-actions text-right">
                                                      
                                                        <a rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm" href="{{ route('students.edit', $item->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                            <a rel="tooltip" title="Hide" class="btn btn-danger btn-link btn-sm" href="{{ route('students.hide', $item->id)}}" onclick="return confirm('bạn chắc chứ ! ')">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                           
                                                           
                                                       
                                                    </td>
                                                </tr>    
                                                @endforeach
                                                
    
                                            </tbody>
                                        </table> 
                                       
                                    </div>
                                    {{-- Kế toán --}}
                                    <div id="company" class="tab-pane">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th class="text-center">Username</th>
                                                    <th class="text-center">Họ Và tên</th>
                                                    <th class="text-center">giới tính</th>
                                                    <th class="text-center">ngày sinh</th>
                                                    <th  class="text-center">số điện thoại</th>
                                                    <th class="text-center">Vị trí</th>
                                                    
                                                    <th  >
                                                        <a href="" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                                                        <i class="pe-7s-add-user" > Thêm Nhân viên</i>
                                                    </a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Acemployee as $item)
                                                <tr>
                                                    <th class="text-center">{{$item->userName}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    
                                                    <th class="text-center">
                                                    @php
                                                        $gt = ($item->gender == 1) ? "Nam" : "Nữ";
                                                    @endphp
                                                    {{$gt}}
                                                    </th>
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center" >{{$item->phone}}</th>
                                                    <th class="text-center"> 
                                                        @if ($item->permission == 1)
                                                            {{"Giáo vụ"}}
                                                        @else
                                                        {{"Kế toán"}}
                                                        @endif
                                                    </th>
                                                    
                                                    <td class="td-actions text-right">
                                                      
                                                        <a rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm" href="{{ route('students.edit', $item->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                            <a rel="tooltip" title="Hide" class="btn btn-danger btn-link btn-sm" href="{{ route('students.hide', $item->id)}}" onclick="return confirm('bạn chắc chứ ! ')">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                           
                                                           
                                                       
                                                    </td>
                                                </tr>    
                                                @endforeach
                                                
    
                                            </tbody>
                                        </table> 
                                    </div>
                                  
                                </div>

                            </div>
                        
                    
                    
                </div>
            </div>
        </div>
@endsection