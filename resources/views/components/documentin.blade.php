<tr>
    <td><a href="{{ route('cong-van-den.show',['cong_van_den'=>$documentin->id]) }}">{{$documentin->label_number}}</a>
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