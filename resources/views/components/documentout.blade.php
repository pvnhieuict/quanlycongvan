{{-- <tr {!! $attributes !!}>
    <td class="border px-4 py-2">Book #{{ $documentout->id }}</td>
    <td class="border px-4 py-2 w-1/2">
        <p>{{ $documentout->title }}</p>
        <p class="text-xs">{{ $documentout->description }}</p>
    </td>
    <td class="border px-4 py-2">{{ $documentout->released_at }}</td>
    <td class="border px-4 py-2">{{ $documentout->comments_count }} {{ Str::plural('comment', $documentout->comments_count) }}</td>
</tr> --}}
<tr>
    <td><a href="{{ route('cong-van-di.show',['cong_van_di'=>$documentout->id]) }}">{{$documentout->label_number}}</a>
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
    <td>{{$documentout->in_date}}</td>
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