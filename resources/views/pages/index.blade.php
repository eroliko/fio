@php use App\Http\Core\Mappers\GenderMapper; @endphp
@extends('main')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{$error}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col">
                <h2>Male actors upload</h2>
                @include('components.csv-upload-form', ['gender' => GenderMapper::GENDER_MALE])
            </div>
            <div class="col">
                <h2>Female actors upload</h2>
                @include('components.csv-upload-form', ['gender' => GenderMapper::GENDER_FEMALE])
            </div>
        </div>
    </div>
@endsection
