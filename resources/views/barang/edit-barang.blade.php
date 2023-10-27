@extends('partials.main')

@section('title')
Form Edit Data Barang
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12">
<div class="card">
    <div class="card-header">
      <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ route('data-barang') }}'">
         Kembali
      </button>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('update-barang', $barang->id_barang) }}">
            @csrf
            @method('PUT')
        <form>
            <div class="row mb-3">
              <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{old('nama_barang', $barang->nama_barang)}}">                @error('nama_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                  </div>
            @enderror
            </div>
            </div>
            <div class="row mb-3">
              <label for="jenis_barang" class="col-sm-2 col-form-label">Jenis Barang</label>
              <div class="col-sm-10">
                <select name="jenis_barang" class="form-control" id="jenis_barang" type="number">
                  @foreach ($jenis_barang as $item)
                  <option value="{{ $item->id_jenis_barang }}" @if($item->id_jenis_barang == old('id_jenis_barang', $barang->nama_jenis)) selected @endif>{{ $item->nama_jenis }}</option>

                  @endforeach
                </select>
            </div>
            </div>
            <div class="row mb-3">
              <label for="status" class="col-sm-2 col-form-label">Satuan</label>
                <div class="col-sm-3">
                    <select name="id_satuan" class="form-control" id="id_satuan" type="number">
                        @foreach ($satuans as $satuan)
                            <option value="{{ $satuan->id_satuan }}" @if($satuan->id_satuan == old('id_satuan', $barang->id_satuan)) selected @endif>{{ $satuan->nama_satuan }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
            <div class="row mb-3">
            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
              <div class="col-sm-3">
                <input type="text" class="form-control form-control-sm @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{old('harga', $barang->harga)}}">                @error('harga')
                <div class="invalid-feedback">
                    {{ $message }}
                  </div>
            @enderror
            </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-3">
                    <select name="status" class="form-control" id="status" type="number">
                        <option value="1" @if(old('status', $barang->status_barang) == 1) selected @endif>Aktif</option>
                        <option value="0" @if(old('status', $barang->status_barang) == 0) selected @endif>Tidak Aktif</option>
                    </select>
                  </div>
                </div>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-sm btn-success">
                            Simpan
                        </button>
                      </div>
                    </div>
              </div>
            </div>
          </form>
    </div>
  </div>
</div>

@endsection