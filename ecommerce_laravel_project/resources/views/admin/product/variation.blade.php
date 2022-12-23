@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#" style="color:#0B2A97">Add Variation</a></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Color List</h3>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($colors as $key => $color)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $color->color_name }}</td>
                                <td>
                                    <div style="width: 50px;height:50px;border-radius:50px;background:{{ $color->color_code }}">
                                        {{ $color->color_code == null ? 'NA' : '' }}</div>
                                </td>
                                <td><a class="btn btn-danger" href="{{route('color.delete', $color->id)}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Color</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.color') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            
                            <input type="text" class="form-control" name="color_name" placeholder="Color Name">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Use hex code e.g. #000000</label>
                            <input type="text" class="form-control" name="color_code" placeholder="Color Code">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Color</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Size List</h3>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>Size Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($sizes as $key => $size)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $size->size_name }}</td>
                                <td><a class="btn btn-danger" href="{{route('size.delete', $size->id)}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Size</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.size') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <input type="text" class="form-control" name="size_name" placeholder="Size Name">
                        </div>
                        

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Size</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
