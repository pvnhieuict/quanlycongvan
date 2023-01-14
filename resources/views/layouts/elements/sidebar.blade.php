<nav id="sidebarMenu">
  <ul class="list-group bg-success shadow">
    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">CÔNG VĂN</h5>
      </div>
    </a>
    <li class="list-group-item"><a class="link-primary text-decoration-none" href="{{ route('cong-van-den.index')}}">
      <span data-feather="file" class="align-text-bottom"></span>
      Công văn đến phổ biến
    </a></li>
    <li class="list-group-item"> <a class="link-primary text-decoration-none" href="{{ route('cong-van-di.index')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Công văn đi phổ biến
    </a></li>
    <li class="list-group-item"><a class="link-primary text-decoration-none" href="{{ route('congviec')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Công việc được giao
    </a></li>
    <li class="list-group-item"><a class="link-primary text-decoration-none" href="{{ route('truy-luc')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Truy lục công văn
    </a></li>
  </ul>
{{-- Văn thư --}}
@cannot('nguoidungthuong')
  @cannot('lanhdao')
  <ul class="list-group bg-success shadow">
    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">VĂN THƯ</h5>
      </div>
    </a>
    <li class="list-group-item"><a class="link-primary text-decoration-none" href="{{ route('cong-van-den.create')}}">
      <span data-feather="file" class="align-text-bottom"></span>
      Thêm công văn đến
    </a></li>
    <li class="list-group-item"> <a class="link-primary text-decoration-none" href="{{ route('cong-van-di.create')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Thêm công văn đi
    </a></li>
    <li class="list-group-item"><a class="link-primary text-decoration-none" href="{{ route('qlcvd')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Quản lý công văn đến
    </a></li>
    <li class="list-group-item"><a class="link-primary text-decoration-none" href="{{ route('qlcvdi')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Quản lý công văn đi
    </a></li>
    <li class="list-group-item"><a class="link-primary text-decoration-none" href="{{ route('loai-cong-van.index')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Phân loại công văn
    </a></li>
  </ul>
  @endcannot
  @endcannot
  {{-- Quan tri he thong --}}
  @can('quantrihethong')
  <ul class="list-group bg-success shadow">
    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">QUẢN LÝ NGƯỜI DÙNG</h5>
      </div>
    </a>
    <li class="list-group-item"><a class="link-primary text-decoration-none" href="{{ route('don-vi.index')}}">
      <span data-feather="file" class="align-text-bottom"></span>
      Quản lý đơn vị
    </a></li>
    <li class="list-group-item"> <a class="link-primary text-decoration-none" href="{{ route('nguoi-dung.index')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Quản lý người dùng
    </a></li>

    <li class="list-group-item"> <a class="link-primary text-decoration-none" href="{{ route('nguoi-dung.create')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Thêm người dùng mới
    </a></li>
  </ul>
  @endcan
  @can('lanhdao')
  <ul class="list-group bg-success shadow">
    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">LÃNH ĐẠO</h5>
      </div>
    </a>
    <li class="list-group-item"><a class="link-primary text-decoration-none" href="{{ route('qlcvd')}}">
      <span data-feather="file" class="align-text-bottom"></span>
      Quản lý công văn đến
    </a></li>
    <li class="list-group-item"> <a class="link-primary text-decoration-none" href="{{ route('qlcvdi')}}">
      <span data-feather="" class="align-text-bottom"></span>
      Quản lý công văn đi
    </a></li>
  </ul>
  @endcan
</nav>