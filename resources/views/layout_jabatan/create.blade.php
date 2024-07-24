@extends('layout.main')

@section('judul')
Form Data Jabatan
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
            <h5 class="card-title">Form Data Jabatan</h5>
            <!-- Form Jabatan -->
            <form action="store" method="POST">
                @csrf
                <div class="col-md-12">
                    <label class="form-label">Nama Jabatan</label>
                    <div class="input-group">
                        <input type="text" class="form-control
                        @error('nama_jabatan')
                        is-invalid
                        @enderror" placeholder="Masukkan nama jabatan" name="nama_jabatan" id="nama_jabatan">
                        @error('nama_jabatan')
                        <div class="invalid-feedback" id="invalidCheck3Feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3" style="margin-top: 20px;">
                    <div class="col-sm-10">
                        <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                        <button type="submit" name="submit" value="Save" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form><!-- Form Jabatan -->

        </div>
    </div>

</section>  
@endsection