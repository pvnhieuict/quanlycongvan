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
          margin-top: 10px;
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

      <form method="post" class="col-md-12" action="{{ route('nguoi-dung.updateprofile',$users->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="number_label" class="col-form-label"> Họ và tên:  </label></div>
          <div class="col-6">{{ $users->name }}</div>
          <div class="col-4">
            <span class="form-text">

            </span>
          </div>
        </div>

        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">MSCB :</label></div>
          <div class="col-6">{{ $users->personal_id }}</div>
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
        {{-- ----------------------- --}}
        
        <div class="border-bottom mb-2"></div>
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
      </form>

  </div>


  </main>
</div>
</div>

@endsection