@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#" style="color:#0B2A97">Product List</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Product List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Discount %</th>
                            <th>Price after Discount</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount == null ? 'No Discount' : $product->discount }}</td>
                                <td>{{ $product->discount == null ? $product->price : $product->after_discount }}</td>
                                <td>{{ $product->brand == null ? 'Unknown' : $product->brand }}</td>
                                <td>{{ $product->rel_to_category->category_name }}</td>
                                <td>{{ $product->rel_to_subcategory->subcategory_name }}</td>
                                <td><img width="50";
                                        src="{{ asset('uploads/product/preview/') }}/{{ $product->preview }}"
                                        alt=""></td>
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
                                            <a class="dropdown-item" href="{{ route('product.delete', $product->id) }}">Delete</a>
                                            <a class="dropdown-item" href="{{ route('product.inventory', $product->id) }}">Inventory</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
