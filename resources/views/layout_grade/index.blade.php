@extends('layout.main')

@section('judul')
Master Data
@endsection

@section('subjudul')
Data Grade
@endsection

@section('isi')
<a href="grade/create" class="btn btn-primary"><i class="fa-solid fa-plus"></i><span>    Tambah Grade</span></a>

<div class="row">
    <div class="col-md">
        <div class="table-responsive">
        <h1 class="card-title">Data Grade</h1>
    <table id="grade" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Grade</th>
                <th>Jabatan</th>
                <th>Biaya</th>
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
    $('#grade').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('grade') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_grade', name: 'nama_grade' },
            { data: 'jabatan', name: 'jabatan' },
            { data: 'biaya', name: 'biaya' },
            { data: 'action', name: 'action' },
        ]
    });

     $('#grade').on('click', '.delete-button', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda Akan menghapus data grade ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('grade.destroy', '') }}" + '/' + id,
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