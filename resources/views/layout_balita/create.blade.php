@extends('layout.main')

@section('judul')
Form Data Balita
@endsection

@section('isi')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning  alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Perhatian!!</h4>
                <p>1. Mohon pastikan bahwa seluruh data telah diisi dengan lengkap sebelum disimpan. Hal ini penting untuk memastikan kelengkapan informasi</p>
                <p>2.   Silakan gunakan tanda "-" pada kolom yang bersangkutan jika data tidak ada atau tidak tersedia.  Hal ini akan membantu memahami bahwa kolom tersebut sengaja kosong dan bukan karena kesalahan pengisian.</p>
                <hr>
                <p class="mb-0">Terima kasih atas perhatiannya dalam pengisian data   <i class="fa-solid fa-face-smile"></i></p>
            </div>
        </div>
    </div>
</section>


<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <h5 class="card-title">Form Data Karyawan</h5>
            <!-- Form Karyawan -->
            <form action="store" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 required-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control
                        @error('nama')
                        is-invalid
                        @enderror" placeholder="Masukkan nama" name="nama" id="nama">
                        @error('nama')
                        <div class="invalid-feedback" id="invalidCheck3Feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 required-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control
                        @error('tempat_lahir')
                        is-invalid
                        @enderror" placeholder="Masukkan tempat_lahir" name="tempat_lahir" id="tempat_lahir">
                        @error('tempat_lahir')
                        <div class="invalid-feedback" id="invalidCheck3Feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 required-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control
                        @error('tanggal_lahir')
                        is-invalid
                        @enderror
                        " placeholder="Masukkan Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 required-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control
                        @error('alamat')
                        is-invalid
                        @enderror
                        " placeholder="Masukkan Alamat Nama Jalan" name="alamat"  id="alamat">
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 required-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-select
                        @error('jenis_kelamin')
                        is-invalid
                        @enderror" aria-label="Default select example" name="jenis_kelamin" id="jenis_kelamin">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 required-label">Departemen</label>
                    <div class="col-sm-10">
                        <select class="form-select
                        @error('departemen_id')
                        is-invalid
                        @enderror" name="departemen_id" aria-label="Default select example">
                            <option value="">Pilih departemen</option>
                            @foreach ($departemen as $dp)
                            <option value="{{$dp->id}}">{{ $dp->nama }}</option>
                            @endforeach
                        </select>
                        @error('departemen_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                        <button type="submit" name="submit" value="Save" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form><!-- Form Karyawan -->

        </div>
    </div>

</section>  
@endsection