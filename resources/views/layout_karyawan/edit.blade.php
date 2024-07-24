@extends('layout.main')

@section('judul')
Master Data
@endsection

@section('subjudul')
Form Edit Data Karyawan
@endsection

@section('isi')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Data Karyawan</h5>
            <!-- Form Identitas Karyawan -->
            <form action="/karyawan/{{$karyawan->id}}" method="POST">
            @csrf
            @method('put')
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$karyawan->nama}}" name="nama"> 
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$karyawan->tempat_lahir}}" name="tempat_lahir">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" value="{{$karyawan->tanggal_lahir}}" name="tanggal_lahir">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$karyawan->alamat}}" name="alamat">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" value="{{$karyawan->jenis_kelamin}}" name="jenis_kelamin">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki" @if ($karyawan->jenis_kelamin == "Laki-Laki") selected @endif>Laki-Laki</option>
                    <option value="Perempuan"@if ($karyawan->jenis_kelamin == "Perempuan") selected @endif>Perempuan</option>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Departemen</label>
                <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example"name="departemen_id" id="departemen_id">
                    <option selected>Pilih Departemen</option>
                    @foreach ($departemen as $dpv)
                    <option value="{{$dpv->id}}" {{ $dpv->id === $karyawan->departemen_id ? "selected" : "" }}>{{ $dpv->nama }}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                    <button type="submit" name="submit" value="Update" class="btn btn-primary">Update</button>
                </div>
            </div>

            </form><!-- Form Identitas Karyawan -->

        </div>
    </div>

</section>
@endsection