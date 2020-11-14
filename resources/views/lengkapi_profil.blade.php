@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div  class="card-body">
                    <a href="{{ url ('data-warga') }}" class="btn btn-primary btn-sm">
                    <i style="font-size: 20px;" class="fas fa-users"></i>
                    </a>
                    <a href="{{ url ('penambahan_kas') }}" class="btn btn-primary btn-sm">
                    <i style="font-size: 20px;" class="far fa-plus-square"></i>
                    </a>
                    <a href="{{ url ('pengurangan_kas') }}" class="btn btn-primary btn-sm">
                    <i style="font-size: 20px;" class="far fa-minus-square"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div style="text-align:center;" class="card-body ">
                    <p>Rp. {{number_format($kas->nominal,2) }}</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Riwayat Penambahan Kas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection