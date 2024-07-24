@extends('layout.main')

@section('judul')
Master Data
@endsection

@section('subjudul')
Data Karyawan
@endsection

@section('isi')
<a href="karyawan/create" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span>    Tambah Karyawan</span></a>

<div class="row">
    <div class="col-md">
        <div class="table-responsive">
        <h1 class="card-title">Data Karyawan</h1>
    <table id="karyawan1" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Departemen</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        </table>
    </div>
    </div>
</div>

<script>
   $(document).ready(function() {
    $('#karyawan1').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('karyawan') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'tempat_lahir', name: 'tempat_lahir' },
            { data: 'tanggal_lahir', name: 'tanggal_lahir' },
            { data: 'jenis_kelamin', name: 'jenis_kelamin' },
            { data: 'alamat', name: 'alamat' },
            { data: 'departemen', name: 'departemen' },
            { data: 'action', name: 'action' },
        ]
    });

     $('#karyawan1').on('click', '.delete-button', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda Akan menghapus data karyawan ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('karyawan.destroy', '') }}" + '/' + id,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            swal(response.success,{
                                icon: "success",
                            })
                            .then((result) => {
                                location.reload();
                            });
                        }
                    });
                }else{
                    swal("Data tidak jadi dihapus");
                }
            });
        });
    });
</script>
@endsection