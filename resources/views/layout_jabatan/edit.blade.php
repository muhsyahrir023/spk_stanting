@extends('layout.main')

@section('judul')
Master Data
@endsection

@section('subjudul')
Form Edit Data Jabatan
@endsection

@section('isi')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Data jabatan</h5>
            <!-- Form Identitas Jabatan -->
            <form action="/jabatan/{{$jabatan->id}}" method="POST">
            @csrf
            @method('put')
            <div class="col-md-12">
                <label class="form-label">Nama Jabatan</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{$jabatan->nama_jabatan}}" name="nama_jabatan"> 
                </div>
            </div>

            <div class="row mb-3" style="margin-top: 20px;">
                <div class="col-sm-10">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                    <button type="submit" name="submit" value="Update" class="btn btn-primary">Update</button>
                </div>
            </div>

            </form><!-- Form Identitas Jabatan -->

        </div>
    </div>

</section>
@endsection