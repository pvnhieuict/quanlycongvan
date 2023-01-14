@extends('layouts.app')
@section('title','Công văn đi')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      @include("layouts.elements.sidebar")
    </div>
    
    <main class="col-md-9 ms-sm-auto">
      <div
        class="shadow-sm d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-2 mb-1 border-bottom">
        <h1 class="h2">XEM CÔNG VĂN ĐI</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        @cannot('nguoidungthuong')
        <a class='btn btn-primary' href="{{route('cong-van-di.create')}}">Nhập công văn đi</a>
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

        <table class="table table-striped shadow">
          <thead>
            <tr>
              <th>Số công văn</td>
              <th>Nội dung công văn</td>
              <th>Trạng thái</td>
              <th>Ngày đi</td>
              <th>Người ký</td>
                @cannot('nguoidungthuong')
                <th colspan="2">Chức năng</td>
                @endcannot
            </tr>
          </thead>
          <tbody>
            @foreach($documenouts as $documenout)
            <tr>
              <td><a
                  href="{{ route('cong-van-di.show',['cong_van_di'=>$documenout->id]) }}">{{$documenout->label_number}}</a>
              </td>
              <td>{{$documenout->title}}</td>
              <td>
                @switch($documenout->status)
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
              <td>{{$documenout->out_date}}</td>
              <td>{{$documenout->signature}}</td>
              @cannot('nguoidungthuong')
              <td><a href="{{ route('cong-van-di.edit', $documenout->id)}}" class="btn btn-primary">Edit</a></td>
              <td>
                <form action="{{ route('cong-van-di.destroy', $documenout->id)}}" method="post">
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
        {!! $documenouts->links() !!}
        <div>
          
        </div>

    </main>
  </div>
</div>

@endsection