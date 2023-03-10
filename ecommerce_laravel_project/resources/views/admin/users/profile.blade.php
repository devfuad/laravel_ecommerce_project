@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#0B2A97">Profile</a></li>

        </ol>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h1> Change Name</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('name.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Update Name</button>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div> --}}


                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h1> Change Password</h1>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success mx-3">{{ session('success') }}</div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('pass.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Old Password</label>
                                <input type="password" name="old_password" class="form-control">
                                @error('old_password')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                                @if (session('wrong_pass'))
                                    <strong class="text-danger">{{ session('wrong_pass') }}</strong>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div> --}}


                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    @if (session('imagesuccess'))
                        <div class="alert alert-success mx-3">{{session('imagesuccess')}}</div>
                    @endif
                    <div class="card-header">
                        <h1> Change Image</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('photo.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="Image" class="form-label">Image</label>
                                <input type="file" name="photo_update" class="form-control" value="{{ asset('uploads/users') }}">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Update Image</button>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div> --}}


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
