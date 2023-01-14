<!-- create.blade.php -->

@extends('layouts.app')
@section('title','Cập nhật thông tin người dùng')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      @include("layouts.elements.sidebar")
    </div>
    <main class="col-md-9 shadow rounded">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cập nhật thông người dùng</h1>
       
      </div>

      {{-- Form de o day --}}
      <style>
        .uper {
          margin-top: 40px;
        }
      </style>


      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div><br />
      @endif

      @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div><br />
      @endif

      <form method="post" class="col-md-12" action="{{ route('nguoi-dung.update',$users->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="number_label" class="col-form-label"> Họ và tên:</label></div>
          <div class="col-6"><input type="text" value="{{ $users->name }}" class="form-control " name="name" /></div>
          <div class="col-4">
            <span class="form-text">

            </span>
          </div>
        </div>

        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">MSCB :</label></div>
          <div class="col-6"><input type="text" value="{{ $users->personal_id }}" class="form-control " name="personal_id" /></div>
          <div class="col-4">
            <span class="form-text"></span>
          </div>
        </div>
        {{-- ------------------------------------ --}}
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">Email :</label></div>
          <div class="col-6"><input type="email" value="{{ $users->email }}" class="form-control " name="email" /></div>
          <div class="col-4">
            <span class="form-text"></span>
          </div>
        </div>
        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">Điện thoại :</label></div>
          <div class="col-6"><input type="phone" value="{{ $users->phone }}" class="form-control " name="phone" /></div>
          <div class="col-4">
            <span class="form-text"></span>
          </div>
        </div>
        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">Chức vụ :</label></div>
          <div class="col-6"><input type="text" value="{{ $users->position }}" class="form-control " name="position" /></div>
          <div class="col-4">
            <span class="form-text"></span>
          </div>
        </div>
        {{-- ------------------------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">Mật khẩu :</label></div>
          <div class="col-6"><input type="password"  class="form-control " name="password" /></div>
          <div class="col-4">
            <span class="form-text">
              Cần đặt lại mật khẩu, vui lòng gõ mật khẩu mới.
            </span>
          </div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">Xác nhận mật khẩu :</label></div>
          <div class="col-6"><input type="password" class="form-control " name="password_confirmation"/></div>
          <div class="col-4">
            <span class="form-text">
              Gõ mật khẩu mới.
            </span>
          </div>
        </div>
        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2">
            <label for="type" class="col-form-label">Quyền :</label>
          </div>
          <div class="col-6">
            <select name="role" class="form-control form-select">
             
              <option value="0" @if ($users->role==0) selected @endif>Người dùng thường</option>
              <option value="1" @if ($users->role==1) selected @endif>Văn thư</option>
              <option value="2" @if ($users->role==2) selected @endif>Lãnh đạo</option>
              <option value="3" @if ($users->role==3) selected @endif>Quản trị hệ thống</option>
             
            </select>
          </div>
          <div class="col-4">
            <span class="form-text">
              Quyền hệ thống
            </span>
          </div>
        </div>
        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2">
            <label for="type" class="col-form-label">Đơn vị :</label>
          </div>
          <div class="col-6">
            <select name="group_id" class="form-control form-select">
              @foreach($groups as $group)
              <option value="{{ $group->id }}" @if ($group->id == $users->group_id) selected @endif>@if ($group->id == $users->group_id) {{ $group->name }} @endif</option>
              @endforeach
            </select>
          </div>
          <div class="col-4">
            <span class="form-text">
              Đơn vị
            </span>
          </div>
        </div>
        {{-- ----------------------- --}}
        
        <div class="border-bottom mb-2"></div>
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
      </form>

  </div>


  </main>
</div>
</div>

@endsection