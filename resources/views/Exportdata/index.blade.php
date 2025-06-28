@extends('layouts.master')

@section('judul')
Aplikasi Data Penjualan
@endsection

@section('judul_sub')
Export Data
@endsection

@section('content')
<div class="py-6">
    <div class="row mb-6">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="tab-content p-4" id="pills-tabContent-basic-forms">
                    <div class="tab-pane tab-example-design fade show active" id="pills-basic-forms-design"
                        role="tabpanel" aria-labelledby="pills-basic-forms-design-tab">
                        <form action="{{ route('export.data.execute') }}" method="POST">
                            @csrf
                            <!-- Input -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label" for="selectOne">Dari Menu</label>
                                <select id="menu" class="form-select" name="menu">
                                    @foreach ($getDataMenus as $key => $jp)
                                        <option value="{{ $jp['key'] }}">{{ $jp['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="selectOne">Format</label>
                                <select id="format" class="form-select" name="format">
                                    <option value="xlsx">EXCEL</option>
                                    <option value="csv">CSV</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="textInput">From</label>
                                <input type="date" id="label" class="form-control" name="FromDate" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="textInput">To</label>
                                <input type="date" id="route" class="form-control" name="EndDate" autocomplete="off">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-outline-success">Export Data</button>
                                </div>
                                <div class="col"></div>
                                <div class="col-3">
                                    <a href="{{ route('export-data.index') }}"
                                        class="btn btn-outline-warning text-end">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection