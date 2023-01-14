@extends('layouts.app')
@section('title','Quản lý người dùng')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      @include("layouts.elements.sidebar")
    </div>
    <main class="col-md-9 rounded shadow">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">QUẢN LÝ NGƯỜI DÙNG</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

          <a class='btn btn-primary' href="{{route('nguoi-dung.create')}}">Thêm người dùng mới</a>


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

        <table class="table table-striped" id="dsNguoiDung">
          <thead>
            <tr>
              <th class="th-sm">Họ tên</th>
              <th class="th-sm">MSCB</th>
              <th class="th-sm">SĐT</th>
              <th class="th-sm">Email</th>
              <th class="th-sm">Chức vụ</th>
              <th class="th-sm">Đơn vị</th>
              <th>Quyền</th>
              <th>Chỉnh sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>

              <td>{{$user->name}}</td>
              <td>{{$user->personal_id}}</td>
              <td>{{$user->phone}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->position}}</td>

              <td>{{$user->group->all()[0]['name'] }}</td>

              <td>
                @php
                switch($user->role){
                case 0:
                $role = "Người dùng thường";
                break;
                case 1:
                $role = "Văn thư";
                break;
                case 2:
                $role = "Lãnh đạo";
                break;
                case 3:
                $role = "Quản trị hệ thống";
                break;
                default:
                }


                @endphp
                {{ $role }}
              </td>
              <td><a href="{{ route('nguoi-dung.edit', $user->id)}}" class="btn btn-primary">Edit</a></td>
              <td>
                <form action="{{ route('nguoi-dung.destroy', $user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th class="th-sm">Họ tên</th>
              <th class="th-sm">MSCB</th>
              <th class="th-sm">SĐT</th>
              <th class="th-sm">Email</th>
              <th class="th-sm">Chức vụ</th>
              <th class="th-sm">Đơn vị</th>
              <th>Quyền</th>
              <th colspan="2">Chức năng</th>
            </tr>
          </tfoot>
        </table>
        <div>

        </div>


    </main>
  </div>
  
</div>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
  
    $('#dsNguoiDung').DataTable(
      {
        language:{
          search:"Tìm kiếm",
          lengthMenu:"Hiển thị _MENU_ người dùng",
          info:"Hiển thị _START_ - _END_ / _TOTAL_ kết quả"
        }
      }
    );
    $('.dataTables_length').addClass('bs-select');
  });
</script>
@endsection