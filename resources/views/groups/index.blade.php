@extends('layouts.app')
@section('title','Đơn vị')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      @include("layouts.elements.sidebar")
    </div>
    <main class="col-md-9 shadow rounded">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">ĐƠN VỊ</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <a class='btn btn-primary' href="{{route('don-vi.create')}}">Thêm đơn vị</a>
        </div>
      </div>

      {{-- Form de o day --}}
      <style>
        .uper {
          margin-top: 40px;
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
              <th>Loại công văn</th>
              <th>Slug</th>

              <th colspan="2">Chức năng</th>
            </tr>
          </thead>
          <tbody>
            @foreach($groups as $group)
            <tr>
             
              <td>{{$group->name}}</td>
         
                
              <td>{{$group->slug}}</td>
              <td><a href="{{ route('don-vi.edit', $group->id)}}" class="btn btn-primary">Edit</a></td>
              <td>
                <form action="{{ route('don-vi.destroy', $group->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div>

        </div>


    </main>
  </div>
</div>

@endsection