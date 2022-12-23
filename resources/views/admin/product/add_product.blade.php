@extends('layouts.dashboard')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#" style="color:#0B2A97">Add Products</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Add Product</div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <select name="category_id" class="form-control category_id">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <select name="subcategory_id" id="subcategory" class="form-control">
                                    <option value="">-- Select SubCategory --</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <input type="text" class="form-control" name="product_name"
                                        placeholder="Product Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <input type="number" min="0" class="form-control" name="price"
                                        placeholder="Product Price">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <input type="number" min="0" class="form-control" name="discount"
                                        placeholder="Discount %">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <input type="text" class="form-control" name="brand" placeholder="Brand">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mt-3">
                                    <input type="text" class="form-control" name="short_desp"
                                        placeholder="Short Description">
                                    {{-- <textarea name="short_desp" id="" class="form-control" placeholder="Short Description"></textarea> --}}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mt-3">
                                    <textarea class="form-control" id="summernote" name="long_desp" placeholder="Long Description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">Product Preview</label>
                                    <input type="file" class="form-control" name="preview">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">Product Thumbnails</label>
                                    <input type="file" class="form-control" multiple name="thumbnails[]">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <button type="text" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $('.category_id').change(function() {
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: '/getsubcategory',
                type: 'POST',
                data: {
                    'category_id': category_id
                },

                success: function(data) {
                    $('#subcategory').html(data);
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    
@endsection
