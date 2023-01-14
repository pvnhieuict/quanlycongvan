@extends('layouts.app')
@section('title','Công văn đến')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      @include("layouts.elements.sidebar")
    </div>
    

    <main class="col-md-9 shadow rounded">
      <div
        class="d-flex justify-content-between flex-wrap  align-items-center border-bottom">
        <h1 class="h2 mt-1">XEM CÔNG VĂN ĐẾN</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        @cannot('nguoidungthuong')
        <a class='btn btn-primary' href="{{route('cong-van-den.create')}}">Nhập công văn đến</a>
        @endcannot
        </div>
      </div>

      {{-- Form de o day --}}
      <style>
        .uper {
          margin-top: 10px;
        }
      </style>
      <div class="uper">
        @if(session()->get('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div><br />
        @endif

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Số công văn</td>
              <th>Nội dung công văn</td>
              <th>Trạng thái</td>
              <th>Ngày đến</td>
              <th>Người ký</td>
              @cannot('nguoidungthuong')
              <th colspan="2">Chức năng</td>
              @endcannot
            </tr>
          </thead>
          <tbody>
            @foreach($documentins as $documentin)
            <tr>
              <td><a
                  href="{{ route('cong-van-den.show',['cong_van_den'=>$documentin->id]) }}">{{$documentin->label_number}}</a>
              </td>
              <td>{{$documentin->title}}</td>
              <td>
                @switch($documentin->status)
                @case(0)
                <span class="badge bg-danger">Đã tiếp nhận</span>
                @break

                @case(1)
                <span class="badge bg-primary">Đã giao việc</span>
                @break

                @case(2)
                <span class="badge bg-warning text-dark">Đang xử lý</span>
                @break

                @case(3)
                <span class="badge bg-success">Đã xử lý</span>
                @break

                @default
                
                @endswitch
            
              </td>
              <td>{{$documentin->in_date}}</td>
              <td>{{$documentin->signature}}</td>
              @cannot('nguoidungthuong')
              <td><a href="{{ route('cong-van-den.edit', $documentin->id)}}" class="btn btn-primary">Edit</a></td>
              <td>
                <form action="{{ route('cong-van-den.destroy', $documentin->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
              @endcannot
            </tr>
            @endforeach
          </tbody>
        </table>
          {!! $documentins->links() !!}
        <div>

        </div>


    </main>
  </div>
</div>

@endsection