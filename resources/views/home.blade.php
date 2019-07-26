@extends('layouts.layout')

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <p>
                      Selamat datang di aplikasi Grapari MCS,<br>
                      untuk sementara aplikasi sedang dalam tahap pembangunan.<br>
                      <br>
                      Job 15/7/2019 : Base Laravel, Master Data <br>
                      Job 16/7/2019 : Checklist Base<br>
                      Job 17/7/2019 : Ajax Implementation to Checklist Base <br>
                  </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
