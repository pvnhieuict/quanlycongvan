<!-- create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      @include("layouts.elements.sidebar")
    </div>
    <main class="col-md-9 shadow rounded">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nhập công văn đến</h1>
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

      <form method="post" class="col-md-12" action="{{ route('cong-van-den.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="number_label" class="col-form-label"> Số công văn:</label></div>
          <div class="col-6"><input type="text" class="form-control " name="label_number" /></div>
          <div class="col-4">
            <span class="form-text">

            </span>
          </div>
        </div>

        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">Nội dung công văn :</label></div>
          <div class="col-6"><input type="text" class="form-control " name="title" /></div>
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
              @foreach($dataTypeDocuments as $dataTypeDocument)
              <option value="{{ $dataTypeDocument->id }}">{{ $dataTypeDocument->name }}</option>
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
              <option selected value="0">Không phổ biến</option>
              <option value="1">Phổ biến</option>
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
              <option selected value="0">Đã tiếp nhận</option>
              <option value="1">Đã giao việc</option>
              <option value="2">Đang xử lý</option>
              <option value="3">Đã xử lý</option>
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
            <input type="file" name="pathpdf" id="pathpdf" accept=".pdf"
              class="form-control-file form-control form-control-dm" required>
          </div>
          <div class="col-4">
            <span id="" class="form-text">
              Upload file PDF của công văn
            </span>
          </div>
        </div>
        {{-- --------------------------- --}}

        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="number_label" class="col-form-label">Người ký:</label>
          </div>
          <div class="col-6">
            <input type="text" class="form-control" name="signature" />
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
            <input type="date" name="signature_date" id="iddate" placeholder="dd-mm-yyyy" class="form-control">
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
            <input type="date" name="in_date" id="iddate" placeholder="dd-mm-yyyy" class="form-control">
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
            <input type="date" name="store_date" id="iddate" placeholder="dd-mm-yyyy" class="form-control">
          </div>
          <div class="col-4">
            <span id="" class="form-text">

            </span>
          </div>
        </div>

        <div class="row g-3 align-items-center mb-2">
          <div class="col-2">
            <label for="" class="col-form-label">Ngày đến hạn</label>
          </div>
          <div class="col-6">
            <input type="date" name="ngaydenhan" id="iddate" placeholder="dd-mm-yyyy" class="form-control">
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
            <textarea type="textarea" cols="10" rows="3" name="detail" id="iddate" class="form-control"></textarea>
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
            <input type="number" name="copy_number" id="" class="form-control">
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
            <input type="text" name="from_palce" id="" class="form-control">
          </div>
          <div class="col-4">
            <span id="" class="form-text">

            </span>
          </div>
        </div>

        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="number_label" class="col-form-label"> Người phụ trách:</label></div>
          <div class="col-6"><input type="text" class="form-control search" name="nguoiphutrach" /></div>
          <div class="col-4">
            <span class="form-text">

            </span>
          </div>
        </div>

        <div class="border-bottom mb-2"></div>
        <button type="submit" class="btn btn-primary mb-2">Lưu thông tin</button>
      </form>

  </div>


  </main>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
  var path = "{{ route('autocomplete') }}";
  $('input.search').typeahead({
    
      source:  function (str, process) 
      {
        return $.get(path, { str: str }, function (data) {
              return process(data);
          });  
      }
  });
</script>

@endsection