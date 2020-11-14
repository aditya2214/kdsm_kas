@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div  class="card-body">
                    @include('sidebar')
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
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    Tambah Kas
                    </button>
                </div>

                <div class="card-body"  style="overflow-x:auto;">
                    <table id="data-penambahan-kas" class="table">
                        <thead>
                            <tr>
                                <th>Nama Donatur</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Di Buat</th>
                                <th><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Kas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{url ('tambah_kas') }}" method="post">
            @csrf
                <div class="form-group">
                    <label for="">Nama Donatur</label>
                    <input required type="text" class="form-control" name="nama" id="nama">
                </div>
                <div class="form-group">
                    <label for="">Nominal</label>
                    <input required type="number" class="form-control" name="nominal_pemasukan" id="nama">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(function() {
    $('#data-penambahan-kas').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url ('/json_pemasukan') }}",
        columns: [
            { data: 'nama', name: 'nama' },
            { data: 'nominal_pemasukan', name: 'nominal_pemasukan' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'aksi', name: 'aksi',"searchable": false }
        ]
    });
});
</script>
@endsection