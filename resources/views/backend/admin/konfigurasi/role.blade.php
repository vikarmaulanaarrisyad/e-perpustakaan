@extends('layouts.master')

@section('title', 'Konfigurasi')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Role</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    @if (auth()->user()->can('create role'))
                        <button type="button" class="btn bg-gradient-success btn-sm float-right"><i class="fas fa-plus"></i>
                            Tambah</button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive nowrap">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@include('layouts.include.datatables')

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
