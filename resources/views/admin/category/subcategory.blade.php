@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#0B2A97">SubCategory</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Subcategory List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table_id">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Added By</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       <tbody>
                        @foreach ($subcategories as $key=>$subcategory)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$subcategory->rel_to_category->category_name}}</td>
                            <td>{{$subcategory->subcategory_name}}</td>
                            <td>{{$subcategory->rel_to_user->name}}</td>
                            <td>{{$subcategory->created_at->diffForHumans()}}</td>
                            <td><div class="dropdown">
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
                                        href="">Edit</a>
                                    <a class="dropdown-item"
                                        href="">Delete</a>
                                </div>
                            </div></td>
                        </tr>
                        @endforeach
                       </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="card">

                <div class="card-header">
                    <h3>Add Subcategory</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('subcategory.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select class="form-control" name="category_id">
                                <option>-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Subcategory Name</label>
                            <input type="text" name="subcategory_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button for="" class="btn btn-primary">Add Subcategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
@endsection
