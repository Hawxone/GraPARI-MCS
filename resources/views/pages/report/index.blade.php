@extends('layouts.layout')

@section('content')

    <div class="container" style="margin-top: 20px;">
        <table class="table table-bordered table-striped" id="report">
            <thead>
                <tr>
                   <th>No</th>
                    <th>Nama Perangkat</th>
                    <th>Tanggal</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
               @foreach($check as $p)

                   <tr>

                       <td></td>
                       <td>{{ $p->nama_checklist }}</td>
                        <td>{{ $p->created_at }}</td>
                       <td>{{ $p->status }}</td>


                   </tr>

                   @endforeach

            </tbody>
        </table>
    </div>

     @foreach($data['perangkat'] as $p)
         {{ $p }}
         @endforeach

    <!-- Datatables -->
    <script src="{{ asset('assets/vendor/DataTables-1.10.18/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#report').dataTable();
        });
    </script>
@endsection
