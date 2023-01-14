@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include("layouts.elements.sidebar")
        </div>
        <div class="col-md-9" style="background-image: url('{{ asset('img/bg.jpg') }}'); background-repeat: no-repeat;
        background-size: cover;">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}

            
            </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
        </div>
    </div>


    @endsection