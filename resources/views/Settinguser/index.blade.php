@extends('layouts.master')

@section('judul')
Aplikasi Data Penjualan
@endsection

@section('judul_sub')
Setting User
@endsection

@section('content')
<div class="py-6">
    <div class="row mb-6">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="d-flex justify-content-around mt-3 mb-3 ms-3 me-3">
                    <div class="col-6 ms-4">
                        <a href="{{ route('setting-user.create') }}"
                            class="m-2 btn btn-outline-success my-1 btn-sm">
                            <i data-feather="plus"></i> Tambah Data
                        </a>
                    </div>
                    <div class="col-6 me-4">
                        <form action="/setting-user" class="d-flex align-items-end">
                            <input type="text" class="form-control" placeholder="Cari Data" name="search"
                                value="{{ request('search') }}" />
                            <div class="ms-2 me-2">
                                <button type="submit" class="btn btn-dark">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>

                <!-- Tab content -->
                <div class="tab-content p-4" id="pills-tabContent-table">
                    <div class="tab-pane tab-example-design fade show active" id="pills-table-design" role="tabpanel" aria-labelledby="pills-table-design-tab">
                        <!-- Basic table -->
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($settingUser as $item => $key)
                                    <tr>
                                        <th scope="row">{{ ($settingUser->currentPage() - 1) * $settingUser->perPage() + $item + 1 }}</th>
                                        <td>{{ $key->name }}</td>
                                        <td>{{ $key->email }}</td>
                                        <td>{{ $key->role }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1 justify-content-center">
                                                <a href="/setting-user/{{ $key->id }}/edit" title="Edit" class="btn btn-outline-warning btn-sm d-flex align-items-center justify-content-center">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <a href="/setting-user/{{ $key->id }}/access" title="Tambah Akses Menu" class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center" style="display: none">
                                                    <i data-feather="user-check"></i>
                                                </a>
                                                <form action="/setting-user/{{$key->id}}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete" class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center" value="Delete">
                                                        <i data-feather="trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <div class="d-flex justify-content-between">
                                <div>
                                    Showing {{ $settingUser->firstItem() }} to {{ $settingUser->lastItem() }} of {{ $settingUser->total() }} entries
                                </div>
                                <div class="d-flex justify-content-end">
                                    {{ $settingUser->appends(request()->query())->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection