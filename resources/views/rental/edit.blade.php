@extends('rental.layout')
@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Ubah Data Rental</h5>
        <form method="post" action="{{ route('rental.update', $data->id_rental) }}">
            @csrf
            <div class="mb-3">
                <label for="id_rental" class="form-label">ID Rental</label>
                <input type="text" class="form-control" id="id_rental" name="id_rental" value="{{ $data->id_rental }}">
            </div>
            <div class="mb-3">
                <label for="id_customer" class="form-label">ID Customer</label>
                <input type="text" class="form-control" id="id_customer" name="id_customer" value="{{ $data->id_customer }}">
            </div>
            <div class="mb-3">
                <label for="id_mobil" class="form-label">ID Mobil</label>
                <input type="text" class="form-control" id="id_mobil" name="id_mobil" value="{{ $data->id_mobil }}">
            </div>
            <div class="mb-3">
                <label for="id_sopir" class="form-label">ID Sopir</label>
                <input type="text" class="form-control" id="id_sopir" name="id_sopir" value="{{ $data->id_sopir }}">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga"value="{{ $data->harga }}">
            </div>
            <div class="mb-3">
                <label for="tgl_rental" class="form-label">Tanggal Rental</label>
                <input type="date" class="form-control" id="tgl_rental" name="tgl_rental" value="{{ $data->tgl_rental }}">
            </div>
            <div class="mb-3">
                <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="{{ $data->tgl_kembali }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Ubah" />
            </div>
        </form>
    </div>
</div>
@stop