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
                        Users Management | E-Mart
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Users</h3>
                        {{-- <div class="operation">
                            <a href="#addProduct" class="btn btn-lime">+ Add New Product</a>
                        </div> --}}
                    </div>

                    <div class="table-responsive">
                        <table class="table card-table table-vcenter datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Customer Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th width="20%">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                        <td>
                                            {{ $user['first_name'] . ' ' . $user['last_name'] }}
                                        </td>
                                        <td>
                                            {{ $user['email'] }}<br>
                                            <small class="text-muted">{{ $user['phone'] }}</small>
                                        </td>
                                        <td>
                                            {{ $user['address'] }}
                                        </td>
                                        <td>
                                            <span class="badge bg-success me-1"></span> Active User
                                        </td>

                                        <td class="text-end">
                                            <form action="{{ route('user.destroy', $user['id']) }}" method="POST"
                                                id="delete-form">
                                                @csrf
                                                <button type="submit" class="btn btn-red" id="deleteUserBtn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                        <p class="m-0 text-muted">Showing <span>{{ $totalUsers }}</span> of
                            <span>{{ $totalUsers }}</span>
                            entries
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
