@extends('layouts.app')
@section('title','Loại công văn')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      @include("layouts.elements.sidebar")
    </div>
    <main class="col-md-9 shadow rounded">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">LOẠI CÔNG VĂN</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

          <a class='btn btn-primary' href="{{route('loai-cong-van.create')}}">Thêm loại công văn</a>


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

              <th>Chức năng</th>
            </tr>
          </thead>
          <tbody>
            @foreach($types as $type)
            <tr>
             
              <td>{{$type->name}}</td>
         
                
              <td>{{$type->slug}}</td>
              <td>
                <form action="{{ route('loai-cong-van.destroy', $type->id)}}" method="post">
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