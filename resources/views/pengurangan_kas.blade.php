@extends('layouts.app')

@section('content')
<!-- Modal -->
<div class="modal fade" id="pengurangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Gunakan Kas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ url ('/pengeluaran_kas') }}" method="post">
            @csrf
                <div class="form-group">
                    <label for="">Untuk Keperluan</label>
                    <textarea required name="for" id="for" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Nominal Keperluan</label>
                    <input required type="number" name="nominal_pengeluaran" id="nominal_pengeluaran" class="form-control"></input type="number">
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
                    @if(Auth::user()->role == 1)
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pengurangan">
                    Gunakan Kas
                    </button>
                    @endif
                </div>

                <div class="card-body" style="overflow-x:auto;">
                    <table id="data-pengeluaran-kas" class="table">
                        <thead>
                            <tr>
                                <th>Atas Nama</th>
                                <th>Untuk Keperluan</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Di Buat</th>
                                <th><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
$(function() {
    $('#data-pengeluaran-kas').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url ('/json_pengeluaran') }}",
        columns: [
            { data: 'id_user', name: 'id_user' },
            { data: 'for', name: 'for' },
            { data: 'nominal_pengeluaran', name: 'nominal_pengeluaran' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'aksi', name: 'aksi',"searchable": false }
        ]
    });
});
</script>
<!-- <script>
    $(document).ready(function(){

        $('#form-pengurangan').on('submit',function(e){
            e.preventDefault();

            $.ajax({
                type : "POST",
                url : "../public/pengeluaran_kas",
                data :$('#form-pengurangan').serialize(),
                success : function(response){
                    console.log(response)
                    $('#pengurangan').modal('hide')
                    alert("Data Berhasil Disimpan");
                },
                error : function(error){
                    console.log(error);
                }
            });
        });
    });
</script> -->
@endsection