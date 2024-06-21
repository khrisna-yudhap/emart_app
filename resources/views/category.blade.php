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
                        Product Category | E-Mart
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Category</h3>
                            {{-- <div class="operation">
                                <a href="#addProduct" class="btn btn-lime">+ Add New Product</a>
                            </div> --}}
                        </div>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>Product Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                            <td>
                                                {{ $category['category_name'] }}
                                            </td>
                                            <td class="text-end">
                                                <form action="{{ route('category.destroy', $category['id']) }}"
                                                    method="post" id="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" value="delete" class="btn btn-red"
                                                        id="deleteUserBtn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
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
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Showing <span>{{ count($categories) }}</span> of
                                <span>{{ count($categories) }}</span>
                                entries
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Form New Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <label class="form-label">Product Category Name</label>
                                    <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                        placeholder="Food & Drink" name="category_name" value="{{ old('category_name') }}">
                                </div>
                                <div class="operation d-flex justify-content-end">
                                    <button type="submit" class="btn btn-lime">+ Save New Category</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
