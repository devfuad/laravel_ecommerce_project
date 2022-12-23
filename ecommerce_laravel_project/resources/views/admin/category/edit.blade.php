@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#0B2A97">Edit Category</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success mx-3">{{ session('success') }}</div>
                @endif
                <div class="card-header">

                    <h3>Edit Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="category_id" value="{{$category_info->id}}">

                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name"
                                value="{{ $category_info->category_name }}">
                            @error('category_name')
                                <strong role="alert" class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Category Image</label>
                            <input type="file" class="form-control" name="category_image"   onchange="document.getElementById('category_image').src = window.URL.createObjectURL(this.files[0])">

                            <img id="category_image" width="200" src="{{asset('uploads/category')}}/{{$category_info->category_image}}" alt="">

                            @error('category_image')
                                <strong role="alert" class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Edit Category</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
