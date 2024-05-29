@extends('app')

@section('content')
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="card-title">Create Conference List</h3>
                        <a href="{{ route('conferences.index') }}" class="btn btn-light" style="position: absolute; top: 10px; right: 10px; background-color: #facc73; color: black; border-color: white; width: 46px"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('conferences.store') }}" method="POST">
                            @csrf
                            @include('form')

                            <!-- Display validation errors for each input field -->
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            @error('participants')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary" style="height: 50px; background-color: #a6530e; color: white; border-color: #a6530e;">Add Conference</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
