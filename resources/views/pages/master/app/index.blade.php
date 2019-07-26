@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="card" style="margin-top:20px">
            <div class="card-header">Aplikasi</div>

            <div class="card-body">
                <div class="button-group" style="margin-bottom: 20px">
                    <button class="btn btn-light" id="tambah" data-toggle="modal" data-target="#myModal">Tambah Aplikasi</button>
                </div>

                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                <table id="aplikasi" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Aplikasi</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; ?>
                    @foreach($aplikasi as $p)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $p->nama_app }}</td>
                            <td>
                                <button class="btn btn-light edit-modal" data-id="{{$p->app_id}}" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-light delete-modal" data-id="{{$p->app_id}}" data-title="{{ $p->nama_app }}" ><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="teksact">Ubah</span> Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" method="post" action="{{ route('app.store') }}">
                        <span id="err"></span>
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="idform" value="0">
                        <input type="hidden" name="action" id="idact" value="add">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="fnama" name="nama" value="" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn_save" value="add">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <!-- Datatables -->
        <script src="{{ asset('assets/vendor/DataTables-1.10.18/dataTables.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#aplikasi').dataTable();
            });
        </script>

        <!-- Fontawesome -->
        <script src="{{ asset('assets/vendor/fontawesome-free-5.9.0-web/js/fontawesome.min.js') }}"></script>

        <!-- Delete button -->
        <script>
            $(document).on('click', '.delete-modal', function() {
                $.ajax({
                    type: 'post',
                    url: '{{ route('app.destroy') }}',
                    data: {
                        '_token' : $('input[name=_token]').val(),
                        'id' : $(this).attr("data-id")
                    },
                    beforeSend:function () {
                        return confirm("Apakah anda yakin akan menghapus data ini?");
                    },
                    success: function (data) {
                        location.reload();
                    }
                })
            });
        </script>

        <!-- Tambah button -->
        <script>
            $(document).on('click', '#tambah', function () {
                $('#teksact').text('Tambah');
                $('#btn_save').text("Tambah");
                $('#idact').val("add");
                $('#fnama').val("");

            })
        </script>

        <!-- Edit button -->
        <script>
            $(document).on('click','.edit-modal', function () {
                $('#btn_save').text("Update");
                $('#teksact').text('Ubah');

                $.ajax({
                    type: 'post',
                    url : '{{ route('app.edit') }}',
                    data : {
                        '_token' : $('input[name=_token]').val(),
                        'id': $(this).attr("data-id")
                    },
                    success: function (data) {
                        console.log(data);
                        $('#idform').val(data.app_id);
                        $('#idact').val("edit");
                        $('#fnama').val(data.nama_app);
                    }
                })
            })
        </script>
    </div>

@endsection




