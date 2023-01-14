<!-- create.blade.php -->

@extends('layouts.app')
@section('title',$dataDocumentout->label_number)
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include("layouts.elements.sidebarshowout")
            @include("layouts.elements.sidebar")
        </div>
        <div class="col-md-9">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h5><span class="badge rounded-pill bg-success">{{$dataDocumentout->label_number}}
                    </span><span class="badge rounded-pill bg-primary">{{ $dataDocumentout->title}}</span></h5>

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

            <object data="{{Storage::url($dataDocumentout->pathpdf)}}" type="application/pdf" width="100%" height="800px">
                <p>Trình duyệt không hỗ trợ plugin PDF. Vui lòng tải file <a
                        href="{{Storage::url($dataDocumentout->pathpdf)}}">click here to
                    </a></p>
            </object>
        </div>

        {{-- <iframe height="800px" width=100% src="{{Storage::url($dataDocumentout->pathpdf)}}" #zoom=50'></iframe>
        --}}
    </div>
</div>
@endsection