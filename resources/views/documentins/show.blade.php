<!-- create.blade.php -->

@extends('layouts.app')
@section('title',$dataDocumentin->label_number)
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include("layouts.elements.sidebarshowin")
            @include("layouts.elements.sidebar")
        </div>

        <div class="col-md-9">
            <div class="col-md-12 shadow rounded">
                <h5>
                    <span class="badge rounded-pill bg-success">{{$dataDocumentin->label_number}}
                    </span>
                    <span class="badge rounded-pill bg-primary">{{ $dataDocumentin->title}}</span>
                </h5>

            </div>

            {{-- Form de o day --}}
            <style>
                .uper {
                    margin-top: 10px;
                }
            </style>


            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif

            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
            @endif
            <div class="embed-responsive embed-responsive-21by9">

                <object data="{{Storage::url($dataDocumentin->pathpdf)}}" type="application/pdf" width="100%"
                    height="800px">
                    <p>Trình duyệt không hỗ trợ plugin PDF. Vui lòng tải file <a
                            href="{{Storage::url($dataDocumentin->pathpdf)}}">click here to
                        </a></p>
                </object>
            </div>
        </div>
    </div>
</div>
@endsection