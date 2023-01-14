<!-- create.blade.php -->

@extends('layouts.layout')

<!-- create.blade.php -->

@section('content')
<div class="container-fluid">
  <div class="row">
    @include("layouts.elements.sidebar")

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nhập công văn đến</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button>
        </div>
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

      <form method="POST" class="col-md-12" action="{{ route('cong-van-den.update', $dataTypeDocuments->id ) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="number_label" class="col-form-label"> Số công văn:</label></div>
          <div class="col-6"><input type="text" class="form-control " name="label_number"  value="{{ $dataTypeDocuments->label_number }}" /></div>
          <div class="col-4">
            <span class="form-text">

            </span>
          </div>
        </div>

        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">Nội dung công văn :</label></div>
          <div class="col-6"><input type="text" class="form-control " name="title" value="{{ $dataTypeDocuments->title }}"/></div>
          <div class="col-4">
            <span class="form-text"></span>
          </div>
        </div>
        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2">
            <label for="type" class="col-form-label">Loại công văn :</label>
          </div>
          <div class="col-6">
            <select name="type_id" class="form-control form-select">
              @foreach($typeDocument as $item)
              <option value="{{ $item->id }}" @if(old('type_id') == $dataTypeDocuments->type->id || $item->id == $dataTypeDocuments->type->id) selected @endif>{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-4">
            <span class="form-text">
              Loại công văn: phân loại công văn theo thể thức văn bản hoặc theo nội dung
            </span>
          </div>
        </div>
        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2">
            <label for="type" class="col-form-label">Mức độ mật:</label>
          </div>
          <div class="col-6">
            <select name="secret" class="form-select">
              <option value="0" @if($dataTypeDocuments->secret == 0) selected @endif>Phổ biến</option>
              <option value="1" @if($dataTypeDocuments->secret == 1) selected @endif>Không phổ biến</option>
            </select>
          </div>
          <div class="col-4">
            <span id="" class="form-text">
              Chọn trạng thái công văn.
            </span>
          </div>
        </div>
        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2">
            <label for="type" class="col-form-label">Trạng thái :</label>
          </div>
          <div class="col-6">
            <select name="status" class="form-select">
              <option @if($dataTypeDocuments->status == 0) selected @endif value="0">Đã tiếp nhận</option>
              <option @if($dataTypeDocuments->status == 1) selected @endif value="1">Đã giao việc</option>
              <option @if($dataTypeDocuments->status == 2) selected @endif value="2">Đang xử lý</option>
              <option @if($dataTypeDocuments->status == 3) selected @endif value="3">Đã xử lý</option>
            </select>
          </div>
          <div class="col-4">
            <span id="" class="form-text">
              Chọn trạng thái công văn.
            </span>
          </div>
        </div>
        {{-- ----------------------- --}}
        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="inputPassword6" class="col-form-label">File PDF</label>
          </div>
          <div class="col-6">
            <a class="badge bg-success mb-2" href="{{Storage::url($dataTypeDocuments->pathpdf)}}" target="_blank">Link file</a>
            <input type="file" name="pathpdf" id="pathpdf" value="{{ $dataTypeDocuments->pathpdf }}" accept=".pdf"
              class="form-control-file form-control form-control-dm">
          </div>
          <div class="col-4">
            <span id="" class="form-text">
              Chọn file mới để cập nhật.
            </span>
          </div>
        </div>
        {{-- --------------------------- --}}

        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="number_label" class="col-form-label">Người ký:</label>
          </div>
          <div class="col-6">
            <input type="text" class="form-control" name="signature" value="{{$dataTypeDocuments->signature}}"/>
          </div>
          <div class="col-4">
            <span id="passwordHelpInline" class="form-text">
            </span>
          </div>
        </div>
        {{-- -------------------------- --}}
        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="inputPassword6" class="col-form-label">Ngày ký</label>
          </div>
          <div class="col-6">
            <input type="date" name="signature_date" id="iddate" value="{{$dataTypeDocuments->signature_date}}" placeholder="dd-mm-yyyy" class="form-control">
          </div>
          <div class="col-4">
            <span id="" class="form-text">

            </span>
          </div>
        </div>
        {{-- ---------------------------------- --}}
        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="inputPassword6" class="col-form-label">Ngày đến</label>
          </div>
          <div class="col-6">
            <input type="date" name="in_date" id="iddate" value="{{$dataTypeDocuments->in_date}}" placeholder="dd-mm-yyyy" class="form-control">
          </div>
          <div class="col-4">
            <span id="" class="form-text">

            </span>
          </div>
        </div>
        {{-- ---------------------------------- --}}
        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="" class="col-form-label">Ngày lưu</label>
          </div>
          <div class="col-6">
            <input type="date" name="store_date" id="iddate" value="{{$dataTypeDocuments->store_date}}" placeholder="dd-mm-yyyy" class="form-control">
          </div>
          <div class="col-4">
            <span id="" class="form-text">

            </span>
          </div>
        </div>
        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="" class="col-form-label">Thông tin chi tiết</label>
          </div>
          <div class="col-6">
            <textarea type="textarea" cols="10" rows="3" name="detail" id="iddate" class="form-control" value="{{$dataTypeDocuments->detail}}"></textarea>
          </div>
          <div class="col-4">
            <span id="" class="form-text">

            </span>
          </div>
        </div>
        {{-- ------------------------------- --}}
        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="" class="col-form-label">Số bản</label>
          </div>
          <div class="col-6">
            <input type="number" name="copy_number" id="" value="{{$dataTypeDocuments->copy_number}}" class="form-control">
          </div>
          <div class="col-4">
            <span id="" class="form-text">

            </span>
          </div>
        </div>
        {{-- ------------------------------- --}}
        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="" class="col-form-label">Nơi phát hành công văn</label>
          </div>
          <div class="col-6">
            <input type="text" name="from_palce" id="" value="{{$dataTypeDocuments->from_place}}" class="form-control">
          </div>
          <div class="col-4">
            <span id="" class="form-text">

            </span>
          </div>
        </div>
        <div class="border-bottom mb-2"></div>
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
      </form>

  </div>


  </main>
</div>
</div>

@endsection

