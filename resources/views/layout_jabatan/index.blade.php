@extends('layout.main')

@section('judul')
Master Data
@endsection

@section('subjudul')
Data Jabatan
@endsection

@section('isi')
<a href="jabatan/create" class="btn btn-primary"><i class="fa-solid fa-plus"></i><span>    Tambah Jabatan</span></a>

<div class="row">
    <div class="col-md">
        <div class="table-responsive">
        <h1 class="card-title">Data jabatan</h1>
    <table id="jabatan" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
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
    $('#jabatan').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('jabatan') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_jabatan', name: 'nama_jabatan' },
            { data: 'action', name: 'action' },
        ]
    });

     $('#jabatan').on('click', '.delete-button', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda Akan menghapus data jabatan ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('jabatan.destroy', '') }}" + '/' + id,
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