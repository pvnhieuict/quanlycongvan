@extends('layouts.app')
@section('title','Công văn đến')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      @include("layouts.elements.sidebar")
    </div>


    <main class="col-md-9 shadow rounded">
      <div class="d-flex justify-content-between flex-wrap  align-items-center border-bottom">
        <div class="card mb-2 col-md-12">
          <div class="card-body">
            <a class="btn btn-danger" href="{{ route('qlcvdith')}}">Công văn đi trễ hạn</a>
          </div>
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
              <th>Ngày gửi</td>
              <th>Người ký</td>
                @cannot('nguoidungthuong')
              <th colspan="2">Chức năng</td>
                @endcannot
            </tr>
          </thead>
          <tbody>
            @foreach($documentouts as $documentout)
            <tr>
              <td><a
                  href="{{ route('cong-van-di.show',['cong_van_di'=>$documentout->id]) }}">{{$documentout->label_number}}</a>
              </td>
              <td>{{$documentout->title}}</td>
              <td>
                @switch($documentout->status)
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
              <td>{{$documentout->out_date}}</td>
              <td>{{$documentout->signature}}</td>
              @cannot('nguoidungthuong')
              <td><a href="{{ route('cong-van-den.edit', $documentout->id)}}" class="btn btn-primary">Edit</a></td>
              <td>
                <form action="{{ route('cong-van-den.destroy', $documentout->id)}}" method="post">
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
        {{ $documentouts->links() }}
        <div>

        </div>


    </main>
  </div>
</div>

@endsection