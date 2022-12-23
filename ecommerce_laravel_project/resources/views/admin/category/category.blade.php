@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#0B2A97">Category</a></li>
        </ol>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Category List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Added By</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($categories as $key => $category)
                                <tr>

                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td><img width="50" height="50"
                                            src="{{ asset('uploads/category') }}/{{ $category->category_image }}"
                                            alt=""></td>
                                    <td>{{ $category->rel_to_user->name }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    {{-- <td><button class="btn btn-danger">Delete</button></td> --}}
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-info light sharp" data-toggle="dropdown"
                                                aria-expanded="false">
                                                <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24">
                                                        </rect>
                                                        <circle fill="#000000" cx="5" cy="12" r="2">
                                                        </circle>
                                                        <circle fill="#000000" cx="12" cy="12" r="2">
                                                        </circle>
                                                        <circle fill="#000000" cx="19" cy="12" r="2">
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </button>

                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('category.edit', $category->id) }}">Edit</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('category.delete', $category->id) }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success mx-3">{{ session('success') }}</div>
                    @endif
                    <div class="card-header">

                        <h3>Add Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="category_name">
                                @error('category_name')
                                    <strong role="alert" class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Category Image</label>
                                <input type="file" class="form-control" name="category_image"
                                    onchange="document.getElementById('category_image').src = window.URL.createObjectURL(this.files[0])">
                                <img width="200" id="category_image" alt="">
                                @error('category_image')
                                    <strong role="alert" class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add Category</button>

                            </div>






                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Trashed Category List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Deleted By</th>
                                <th>Deleted At</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($trashed as $key => $trash)
                                <tr>

                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $trash->category_name }}</td>
                                    <td><img width="50" height="50"
                                            src="{{ asset('uploads/category') }}/{{ $trash->category_image }}"
                                            alt=""></td>
                                    <td>{{ $trash->rel_to_user->name }}</td>
                                    <td>{{ $trash->created_at }}</td>
                                    {{-- <td><button class="btn btn-danger">Delete</button></td> --}}
                                    <td> <button type="button" class="btn btn-info light sharp" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24">
                                                    </rect>
                                                    <circle fill="#000000" cx="5" cy="12" r="2">
                                                    </circle>
                                                    <circle fill="#000000" cx="12" cy="12" r="2">
                                                    </circle>
                                                    <circle fill="#000000" cx="19" cy="12" r="2">
                                                    </circle>
                                                </g>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(39px, 40px, 0px);">

                                            <a class="dropdown-item"
                                                href="{{ route('category.restore', $trash->id) }}">Restore</a>
                                            <a class="dropdown-item"
                                                href="{{ route('category.force.delete', $trash->id) }}">Delete</a>
                                        </div>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
