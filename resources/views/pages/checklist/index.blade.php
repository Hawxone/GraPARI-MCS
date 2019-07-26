@extends('layouts.layout')

@section('content')
    <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Layanan</div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Layanan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>



                            @foreach($data['layanan'] as $l)

                                <tr>
                                    <td>{{ $l->nama_layanan }}</td>
                                    <td>
                                        @foreach($data['cek'] as $c)
                                            @if($l->nama_layanan == $c->nama_checklist)
                                                <p id="pl{{ $l->layanan_id }}" class="text-success">Sudah dicek</p>
                                            @endif

                                        @endforeach
                                        <p id="pl2{{ $l->layanan_id }}" class="text-danger">Belum Dicek</p>
                                    </td>

                                        @csrf
                                        <input type="hidden" name="action" id="ni{{ $l->layanan_id }}" value="add">
                                        <input type="hidden" name="nama" id="nama{{ $l->layanan_id }}" value="{{ $l->nama_layanan }}">
                                        <input type="hidden" name="status" id="stat{{ $l->layanan_id }}" value="1">
                                        <td id="act{{ $l->layanan_id }}">


                                                    <button type="submit" id="b{{ $l->layanan_id }}" class="btn btn-light layanan"><i class="fas fa-check"></i></button>
                                                <button type="submit" id="bl{{ $l->layanan_id }}" class="btn btn-light layanan"><i class="fas fa-times"></i></button>
                                            <button style="display: none;"  id="bl2{{ $l->layanan_id }}" data-toggle="modal" data-id="{{ $l->nama_layanan }}" data-target="#myModal" class="btn btn-light layanan">edit</button>


                                                <script>

                                                    $(document).on('click','#b{{ $l->layanan_id }}', function (e) {
                                                        e.preventDefault();
                                                        $.ajax({
                                                            type : 'post',
                                                            url : '{{ route('checklist.store') }}',
                                                            data : {
                                                                '_token' : $('input[name=_token]').val(),
                                                                'nama': $('#nama{{ $l->layanan_id }}').val(),
                                                                'action' : $('#ni{{ $l->layanan_id }}').val(),
                                                                'status' : $('#stat{{ $l->layanan_id }}').val()
                                                            },

                                                            success : function (data) {
                                                                console.log(data.nama);
                                                                $('#bl{{ $l->layanan_id }}').hide();
                                                                $('#b{{ $l->layanan_id }}').hide();
                                                                $('#bl2{{ $l->layanan_id }}').show();
                                                                $('#pl2{{ $l->layanan_id }}').text('Sudah Dicek');

                                                            }

                                                        })
                                                    });


                                                    $(document).on('click','#bl{{ $l->layanan_id }}', function (e) {
                                                        e.preventDefault();
                                                        $.ajax({
                                                            type : 'post',
                                                            url : '{{ route('checklist.store') }}',
                                                            data : {
                                                                '_token' : $('input[name=_token]').val(),
                                                                'nama': $('#nama{{ $l->layanan_id }}').val(),
                                                                'action' : $('#ni{{ $l->layanan_id }}').val(),
                                                                'status' : 0
                                                            },

                                                            success : function (data) {
                                                                console.log(data.nama);
                                                                $('#bl{{ $l->layanan_id }}').hide();
                                                                $('#b{{ $l->layanan_id }}').hide();
                                                                $('#bl2{{ $l->layanan_id }}').show();
                                                                $('#pl2{{ $l->layanan_id }}').text('Sudah dicek');
                                                            }

                                                        })
                                                    });

                                                    $(document).on('click','#bl2{{ $l->layanan_id }}', function (e) {
                                                        e.preventDefault();
                                                        $.ajax({
                                                            type : 'post',
                                                            url : '{{ route('checklist.edit') }}',
                                                            data : {
                                                                '_token' : $('input[name=_token]').val(),
                                                                'nama' : $(this).attr("data-id")
                                                            },
                                                            success: function (data) {
                                                                $('#myModal').modal('show');
                                                                $('#idact').val("edit");
                                                                $('#fnama').val(data.nama_checklist);
                                                                $('#fstatus').val(data.status);
                                                            }
                                                        })
                                                    });

                                                    $(document).ready(function () {
                                                        var exist = document.getElementById('pl{{ $l->layanan_id }}');

                                                        if(exist){
                                                            $('#b{{ $l->layanan_id }}').hide();
                                                            $('#bl{{ $l->layanan_id }}').hide();
                                                            $('#bl2{{ $l->layanan_id }}').show();
                                                            $('#pl2{{ $l->layanan_id }}').hide();
                                                        }
                                                    })
                                                </script>


                                        </td>
                              

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="margin-top: 20px">
                    <div class="card-header">Perangkat</div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nama Perangkat</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['perangkat'] as $p)
                                <tr>
                                    <td>{{ $p->nama_perangkat }}</td>
                                    <td>
                                        @foreach($data['cek'] as $c)
                                            @if($p->nama_perangkat == $c->nama_checklist)
                                                <p id="pp{{ $p->perangkat_id }}" class="text-success">Sudah dicek</p>
                                            @else

                                            @endif
                                        @endforeach
                                            <p id="pp2{{ $p->perangkat_id }}" class="text-danger">Belum Dicek</p>
                                    </td>
                                    <form method="post" action="{{ route('checklist.store') }}">
                                        @csrf
                                        <input type="hidden" name="action" id="nip{{ $p->perangkat_id }}" value="add">
                                        <input type="hidden" name="nama" id="namap{{ $p->perangkat_id }}" value="{{ $p->nama_perangkat }}">
                                        <input type="hidden" name="status" id="statp{{ $p->perangkat_id }}" value="1">
                                        <td id="actp{{ $p->perangkat_id }}">

                                                <button type="submit" id="bp{{ $p->perangkat_id }}" class="btn btn-light"><i class="fas fa-check"></i></button>
                                                <button type="submit" id="bp2{{ $p->perangkat_id }}" class="btn btn-light"><i class="fas fa-times"></i></button>
                                                <button style="display: none;" type="submit" id="bp3{{ $p->perangkat_id }}" data-id="{{ $p->nama_perangkat }}" class="btn btn-light layanan">edit</button>
                                            <script>

                                                $(document).on('click','#bp{{ $p->perangkat_id }}', function (e) {
                                                    e.preventDefault();
                                                    $.ajax({
                                                        type : 'post',
                                                        url : '{{ route('checklist.store') }}',
                                                        data : {
                                                            '_token' : $('input[name=_token]').val(),
                                                            'nama': $('#namap{{ $p->perangkat_id }}').val(),
                                                            'action' : $('#nip{{ $p->perangkat_id }}').val(),
                                                            'status' : $('#statp{{ $p->perangkat_id }}').val()
                                                        },

                                                        success : function (data) {
                                                            console.log(data.nama);
                                                            $('#bp{{ $p->perangkat_id }}').hide();
                                                            $('#bp2{{ $p->perangkat_id }}').hide();
                                                            $('#bp3{{ $p->perangkat_id }}').show();
                                                            $('#pp2{{ $p->perangkat_id }}').text('Sudah dicek');

                                                        }

                                                    })
                                                });

                                                $(document).on('click','#bp2{{ $p->perangkat_id }}', function (e) {
                                                    e.preventDefault();
                                                    $.ajax({
                                                        type : 'post',
                                                        url : '{{ route('checklist.store') }}',
                                                        data : {
                                                            '_token' : $('input[name=_token]').val(),
                                                            'nama': $('#namap{{ $p->perangkat_id }}').val(),
                                                            'action' : $('#nip{{ $p->perangkat_id }}').val(),
                                                            'status' : 0
                                                        },

                                                        success : function (data) {
                                                            console.log(data.nama);
                                                            $('#bp{{ $p->perangkat_id }}').hide();
                                                            $('#bp2{{ $p->perangkat_id }}').hide();
                                                            $('#pp2{{ $p->perangkat_id }}').text('Sudah dicek');
                                                            $('#bp3{{ $p->perangkat_id }}').show();

                                                        }

                                                    })
                                                });

                                                $(document).on('click','#bp3{{ $p->perangkat_id }}', function (e) {
                                                    e.preventDefault();
                                                    $.ajax({
                                                        type : 'post',
                                                        url : '{{ route('checklist.edit') }}',
                                                        data : {
                                                            '_token' : $('input[name=_token]').val(),
                                                            'nama' : $(this).attr("data-id")
                                                        },
                                                        success: function (data) {
                                                            $('#myModal').modal('show');
                                                            $('#idact').val("edit");
                                                            $('#fnama').val(data.nama_checklist);
                                                            $('#fstatus').val(data.status);
                                                        }
                                                    })
                                                });


                                                $(document).ready(function () {
                                                   var exist = document.getElementById('pp{{ $p->perangkat_id }}');

                                                   if(exist){
                                                       $('#pp2{{ $p->perangkat_id }}').hide();
                                                       $('#bp{{ $p->perangkat_id }}').hide();
                                                       $('#bp2{{ $p->perangkat_id }}').hide();
                                                       $('#bp3{{ $p->perangkat_id }}').show();
                                                   }
                                                })
                                            </script>

                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Aplikasi</div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nama Aplikasi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['app'] as $a)
                                <tr>
                                    <td>{{ $a->nama_app }}</td>
                                    <td>

                                        @foreach($data['cek'] as $c)
                                            @if($a->nama_app == $c->nama_checklist)
                                                <p id="pa{{ $a->app_id }}" class="text-success">Sudah dicek</p>
                                            @else

                                            @endif
                                        @endforeach
                                            <p id="pa2{{ $a->app_id }}" class="text-danger">Belum Dicek</p>
                                    </td>
                                    <form method="post" action="{{ route('checklist.store') }}">
                                        @csrf
                                        <input type="hidden" name="action" id="nia{{ $a->app_id }}" value="add">
                                        <input type="hidden" name="nama" id="namaa{{ $a->app_id }}" value="{{ $a->nama_app }}">
                                        <input type="hidden" name="status" id="stata{{ $a->app_id }}" value="1">


                                    <td id="acta{{ $a->app_id }}">


                                        <button type="submit" id="ba{{ $a->app_id }}" class="btn btn-light"><i class="fas fa-check"></i></button>
                                            <button type="submit" id="ba2{{ $a->app_id }}" class="btn btn-light"><i class="fas fa-times"></i></button>
                                            <button style="display: none;" type="submit" id="ba3{{ $a->app_id }}" data-id="{{ $a->nama_app }}" class="btn btn-light layanan">edit</button>

                                    </td>
                                    </form>
                                    <script>

                                        $(document).on('click','#ba{{ $a->app_id }}', function (e) {
                                            e.preventDefault();
                                            $.ajax({
                                                type : 'post',
                                                url : '{{ route('checklist.store') }}',
                                                data : {
                                                    '_token' : $('input[name=_token]').val(),
                                                    'nama': $('#namaa{{ $a->app_id }}').val(),
                                                    'action' : $('#nia{{ $a->app_id }}').val(),
                                                    'status' : $('#stata{{ $a->app_id }}').val()
                                                },

                                                success : function (data) {
                                                    console.log(data.nama);
                                                    $('#ba{{ $a->app_id }}').hide();
                                                    $('#ba2{{ $a->app_id }}').hide();
                                                    $('#ba3{{ $a->app_id }}').show();
                                                    $('#pa2{{ $a->app_id }}').text('Sudah dicek');
                                                }

                                            })
                                        });

                                        $(document).on('click','#ba2{{ $a->app_id }}', function (e) {
                                            e.preventDefault();
                                            $.ajax({
                                                type : 'post',
                                                url : '{{ route('checklist.store') }}',
                                                data : {
                                                    '_token' : $('input[name=_token]').val(),
                                                    'nama': $('#namaa{{ $a->app_id }}').val(),
                                                    'action' : $('#nia{{ $a->app_id }}').val(),
                                                    'status' : 0
                                                },

                                                success : function (data) {
                                                    console.log(data.nama);
                                                    $('#ba{{ $a->app_id }}').hide();
                                                    $('#ba2{{ $a->app_id }}').hide();
                                                    $('#ba3{{ $a->app_id }}').show();
                                                    $('#pa2{{ $a->app_id }}').text('Sudah dicek');
                                                }

                                            })
                                        });

                                        $(document).on('click','#ba3{{ $a->app_id }}', function (e) {
                                            e.preventDefault();
                                            $.ajax({
                                                type : 'post',
                                                url : '{{ route('checklist.edit') }}',
                                                data : {
                                                    '_token' : $('input[name=_token]').val(),
                                                    'nama' : $(this).attr("data-id")
                                                },
                                                success: function (data) {
                                                    $('#myModal').modal('show');
                                                    $('#idact').val("edit");
                                                    $('#fnama').val(data.nama_checklist);
                                                    $('#fstatus').val(data.status);
                                                }
                                            })
                                        });

                                        $(document).ready(function () {
                                            var exist = document.getElementById('pa{{ $a->app_id }}');

                                            if(exist){
                                                $('#ba{{ $a->app_id }}').hide();
                                                $('#ba2{{ $a->app_id }}').hide();
                                                $('#ba3{{ $a->app_id }}').show();
                                                $('#pa2{{ $a->app_id }}').hide();
                                            }
                                        })
                                    </script>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="teksact">Ubah</span> Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmProducts" name="frmProducts" class="form-horizontal" method="post" action="{{ route('checklist.store') }}">
                    <span id="err"></span>
                    {{ csrf_field() }}
                    <input type="text" name="action" id="idact" value="edit">
                    <input type="text" name="nama" id="fnama" value="">
                    <input type="text" name="status" id="fstatus" value="1">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <button type="submit" id="btntrue" class="btn btn-light layanan"><i class="fas fa-check"></i></button>
                            <button type="submit" id="btnfalse" class="btn btn-light layanan"><i class="fas fa-times"></i></button>

                            <script>
                                $(document).on('click', '#btntrue', function (e) {
                                    e.preventDefault();
                                    $('#fstatus').val('true');

                                    $.ajax({
                                        type : 'post',
                                        url : '{{ route('checklist.store') }}',
                                        data : {
                                            '_token' : $('input[name=_token]').val(),
                                            'nama': $('#fnama').val(),
                                            'action' : $('#idact').val(),
                                            'status' : $('#fstatus').val()
                                        },

                                        success : function (data) {
                                            console.log(data.nama);

                                        }

                                    })

                                });

                                $(document).on('click', '#btnfalse', function (e) {
                                    e.preventDefault();
                                    $('#fstatus').val('false');
                                    $.ajax({
                                        type : 'post',
                                        url : '{{ route('checklist.store') }}',
                                        data : {
                                            '_token' : $('input[name=_token]').val(),
                                            'nama': $('#fnama').val(),
                                            'action' : $('#idact').val(),
                                            'status' : $('#fstatus').val()
                                        },

                                        success : function (data) {
                                            console.log(data.nama);

                                        }

                                    })
                                });
                            </script>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
