@extends('layout.main')

@section('judul')
Master Data
@endsection

@section('subjudul')
Data Departemen
@endsection

@section('isi')
<a href="departemen/create" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span>    Tambah Departemen</span></a>

<div class="row">
    <div class="col-md">
        <div class="table-responsive">
        <h1 class="card-title">Data Departemen</h1>
    <table id="departemen1" class="table table-striped" style="width:100%">
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
    $('#departemen1').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('departemen') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'action', name: 'action' },
        ]
    });

     $('#departemen1').on('click', '.delete-button', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda Akan menghapus data departemen ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('departemen.destroy', '') }}" + '/' + id,
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