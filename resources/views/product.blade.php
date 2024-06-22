@extends('layouts.main')

@section('content')
    <!-- Page header -->
    <div class="page-header  d-print-none text-white">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Product Management | E-Mart
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Products</h3>
                            <button href="#" class="btn btn-lime" data-bs-toggle="modal"
                                data-bs-target="#add-new-product">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-package-import">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                    <path d="M12 12l8 -4.5" />
                                    <path d="M12 12v9" />
                                    <path d="M12 12l-8 -4.5" />
                                    <path d="M22 18h-7" />
                                    <path d="M18 15l-3 3l3 3" />
                                </svg>
                                Add new product
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th width="20%">Description</th>
                                        <th width="10%">Price</th>
                                        <th class="text-center">Total Stock</th>
                                        <th class="text-center">Product Status</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex py-1 align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url('{{ asset('storage/product_img/' . $product['product_image']) }}')"></span>
                                                    <div class="flex-fill">
                                                        <div class="font-weight-medium">{{ $product['product_name'] }}</div>
                                                        <div class="text-muted">
                                                            <span
                                                                class="text-reset">{{ $product['category_name'] == null ? 'Uncategorized' : $product['category_name'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">{{ $product['product_desc'] }}</div>
                                            </td>
                                            <td class="text-muted">
                                                Rp. {{ $product['price'] }}
                                            </td>
                                            <td class="text-muted text-center">{{ $product['stock'] }}</td>
                                            <td class="text-muted text-center">
                                                {{ $product['is_active'] == 1 ? 'Active' : 'Non Active' }}
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">

                                                    <button href='#' id="{{ $product['id'] }}"
                                                        class='editBtn btn btn-orange' data-bs-toggle='modal'
                                                        data-bs-target='#edit-product'>Edit Product</button>

                                                    <form action="{{ route('product.destroy', $product['id']) }}"
                                                        method="post" id="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" value="delete" class="btn btn-red"
                                                            id="deleteUserBtn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-alert-octagon">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M12.802 2.165l5.575 2.389c.48 .206 .863 .589 1.07 1.07l2.388 5.574c.22 .512 .22 1.092 0 1.604l-2.389 5.575c-.206 .48 -.589 .863 -1.07 1.07l-5.574 2.388c-.512 .22 -1.092 .22 -1.604 0l-5.575 -2.389a2.036 2.036 0 0 1 -1.07 -1.07l-2.388 -5.574a2.036 2.036 0 0 1 0 -1.604l2.389 -5.575c.206 -.48 .589 -.863 1.07 -1.07l5.574 -2.388a2.036 2.036 0 0 1 1.604 0z" />
                                                                <path d="M12 8v4" />
                                                                <path d="M12 16h.01" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="add-new-product" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Create New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card">
                    <form action="#" method="POST" id="addNewProductForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="alert alert-danger" id="errorMsg" style="display: none">
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Product Image</div>
                                <input type="file" class="form-control" name="product_image" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Product Name</label>
                                <div>
                                    <input type="text" class="form-control" placeholder="Enter Product Name"
                                        name="product_name" required />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Description</label>
                                <div>
                                    <textarea class="form-control" name="product_desc" placeholder="Product Description" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label required">Price (Rp)</label>
                                        <div>
                                            <input type="text" class="form-control" placeholder="10000"
                                                name="price" required />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Stock</label>
                                        <div>
                                            <input type="text" class="form-control" placeholder="250"
                                                name="stock" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Show Product</label>
                                <select class="form-select" name="is_active">
                                    <option value="">Select Option</option>
                                    <option value="1">Show</option>
                                    <option value="0">Hide</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category Product</label>
                                <select name="category_id" class="form-control">
                                    <option>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col">
                                    Already enter correct data for the product? click <a class="text-lime"
                                        href="#">Save</a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" href="#" class="btn btn-lime"> Save </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="progress" id="progressBar" style="display: none;">
                    <div class="progress-bar progress-bar-indeterminate bg-lime"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="edit-product" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Edit New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card">
                    <form action="#" method="POST" id="editProductForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="prodId" name="id">
                        <div class="card-body">
                            <div class="alert alert-danger" id="errorMsg" style="display: none">
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Product Image</div>
                                <input type="file" class="form-control" id="newProdImage" name="product_image_new" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Product Name</label>
                                <div>
                                    <input type="text" class="form-control" id="prodName"
                                        placeholder="Enter Product Name" name="product_name" required />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Description</label>
                                <div>
                                    <textarea class="form-control" name="product_desc" id="prodDesc" placeholder="Product Description" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label required">Price (Rp)</label>
                                        <div>
                                            <input type="text" class="form-control" id="prodPrice"
                                                placeholder="10000" name="price" required />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Stock</label>
                                        <div>
                                            <input type="text" class="form-control" id="prodStock" placeholder="250"
                                                name="stock" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Show Product</label>
                                <select class="form-select" name="is_active">
                                    <option value="">Select Option</option>
                                    <option value="1">Show</option>
                                    <option value="0">Hide</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Category</label>
                                <select name="category_id" class="form-select">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['category_name'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col">
                                    Already enter correct data for the product? click <a class="text-lime"
                                        href="#">Save</a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" href="#" class="btn btn-lime"> Save </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="progress" id="progressBar" style="display: none;">
                    <div class="progress-bar progress-bar-indeterminate bg-lime"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $("#addNewProductForm").on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            $("#progressBar").removeAttr("style");

            $.ajax({
                url: "{{ route('product.store') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $('#add-new-product').modal('toggle');
                    // $("#alertSuccess").removeAttr("style");

                    setTimeout(function() {
                        location.reload();
                    }, 300);
                },
                error: function(xhr) {
                    // Handle error response
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            $("#progressBar").css("display", "none");
                            $('#errorMsg').removeAttr("style");
                            $('#errorMsg').append('<p>' + value + '</p>');
                        });
                    } else {
                        console.error('Unexpected error occurred.');
                    }
                }
            });
        });

        $("#editProductForm").on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            $("#progressBar").removeAttr("style");

            $.ajax({
                url: "{{ route('product.update') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $('#edit-product').modal('toggle');
                    // $("#alertSuccess").removeAttr("style");

                    setTimeout(function() {
                        location.reload();
                    }, 300);
                },
                error: function(xhr) {
                    // Handle error response
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            $("#progressBar").css("display", "none");
                            $('#errorMsg').removeAttr("style");
                            $('#errorMsg').append('<p>' + value + '</p>');
                        });
                    } else {
                        console.error('Unexpected error occurred.');
                    }
                }
            });
        });

        $(document).on('click', '.editBtn', function() {
            let id = $(this).attr('id');

            $.ajax({
                url: "{{ route('product.edit') }}",
                type: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response, xhr) {
                    if (response.status == 200) {
                        $("#prodId").val(response.data['id'])
                        $("#prodName").val(response.data['product_name']);
                        $("#prodDesc").val(response.data['product_desc']);
                        $("#prodPrice").val(response.data['price']);
                        $("#prodStock").val(response.data['stock']);
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }

            });
        });
    </script>
@endpush
