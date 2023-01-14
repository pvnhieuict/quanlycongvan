@extends('layouts.layout')
<!-- create.blade.php -->
@section('content')
<div class="container-fluid">
  <div class="row">
    @include("layouts.elements.sidebar")

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cập nhật thông tin đơn vị</h1>
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

      <form method="POST" class="col-md-12" action="{{ route('don-vi.update', $groups->id ) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="number_label" class="col-form-label">Tên đơn vị:</label></div>
          <div class="col-6"><input type="text" class="form-control " name="name" value="{{ $groups->name }}" /></div>
          <div class="col-4">
            <span class="form-text">

            </span>
          </div>
        </div>

        {{-- ----------------------- --}}
        <div class="row align-items-center mb-2">
          <div class="col-2"><label for="content" class="col-form-label">Slug :</label></div>
          <div class="col-6"><input type="text" class="form-control " name="slug" value="{{ $groups->slug }}" /></div>
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