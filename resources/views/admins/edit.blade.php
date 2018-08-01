@extends('default')

@section('contents')
    <form action="{{route('admins.update',[$admin])}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        @include('_error')
        <div class="form-group">
            <label for="shop_name">名称</label>
            <input type="text" class="form-control" name="name" id="shop_name" value="{{$admin->name}}">
        </div>
        <div class="form-group">
            <label for="shop_img">邮箱</label>
            <input type="email" class="form-control" id="shop_img" name="email" value="{{$admin->email}}">
        </div>
        <div class="form-group">
            @foreach($role as $value)
                <label>
                    <input type="checkbox"  name="role_name[]" value="{{$value->id}}"{{$admin->hasAllRoles($value)?'checked':''}}>{{$value->name}}
                </label>
            @endforeach
        </div>
        <button type="submit" class="btn btn-default">修改</button>
    </form>
@endsection