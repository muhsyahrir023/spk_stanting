@extends('layout.main')

@section('judul')
Master Data
@endsection

@section('subjudul')
Form Edit Data Departemen
@endsection

@section('isi')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Data Departemen</h5>
            <!-- Form Identitas Departemen -->
            <form action="/departemen/{{$departemen->id}}" method="POST">
            @csrf
            @method('put')
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$departemen->nama}}" name="nama"> 
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                    <button type="submit" name="submit" value="Update" class="btn btn-primary">Update</button>
                </div>
            </div>

            </form><!-- Form Identitas Departemen -->

        </div>
    </div>

</section>
@endsection