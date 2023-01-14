@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include("layouts.elements.sidebar")
        </div>
        <div class="col-md-9">
            <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:pt-0">
                <div class="mb-1">
                    <div class="card mb-2">
                        <div class="card-header text-primary">
                          TRUY LỤC CÔNG VĂN
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <label class="col-auto" for="term">
                                            Nhập nội dung công văn
                                        </label>
                                        <input value="{{ $term }}"
                                            class="form-control col-md-3"
                                            id="term" name="term" type="text">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            
                    <table class="table table-striped shadow">
                        <thead>
                          <tr>
                            <th>Số công văn</td>
                            <th>Nội dung công văn</td>
                            <th>Trạng thái</td>
                            <th>Ngày tiếp nhận</td>
                            <th>Người ký</td>
                            @cannot('nguoidungthuong')
                            <th colspan="2">Chức năng</td>    
                            @endcannot
                            
                    
                          </tr>
                        </thead>
                        <tbody>
                    
                            @foreach($results as $result)
                            <x-dynamic-component :component="class_basename($result)" :data="$result"
                                :class="$loop->even ? 'bg-gray-200' : ''" />
                            @endforeach
                        </tbody>
                    </table>
            
                    {!! $results->withQueryString()->links() !!}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
