@extends('layouts.app')

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
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
                        Tambahkan Profil Saya
                    </button>
                </div>

                <div  class="card-body" style="overflow-x:auto;">
                    <table id="warga-table" class="table">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Usia</th>
                                <th>Tanggal Lahir</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>Pekerjaan</th>
                                <th>Nomor Hp</th>
                                <th>Status</th>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambahkan Profil</h5>
            <button type="button" id="close_btn" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ url('/simpan_data_warga') }}">
            @csrf
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input required class="form-control" value="{{ old('nama') }}" type="text" name="nama" id="nama" placeholder="...">
                </div>
                <div class="form-group">
                    <label for="">Usia</label>
                    <input required class="form-control" value="{{ old('usia') }}" type="number" name="usia" id="usia" placeholder="...">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Lahir</label>
                    <input required class="form-control" value="{{ old('tanggal_lahir') }}" type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="...">
                </div>
                <div class="form-group">
                    <label for="">RT</label>
                    <input required class="form-control" value="{{ old('rt') }}" type="number" name="rt" id="rt" placeholder="...">
                </div>
                <div class="form-group">
                    <label for="">RW</label>
                    <input required class="form-control" value="{{ old('rw') }}" type="number" name="rw" id="rw" placeholder="...">
                </div>
                <div class="form-group">
                    <label for="">Pekerjaan</label>
                    <input required class="form-control" value="{{ old('pekerjaan') }}" type="text" name="pekerjaan" id="pekerjaan" placeholder="...">
                </div>
                <div class="form-group">
                    <label for="">Nomor Hp</label>
                    <input required class="form-control" value="{{ old('nomor_hp ') }}" type="number" name="nomor_hp" id="nomor_hp" placeholder="...">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <input required class="form-control" value="{{ old('id_status') }}" type="text" name="id_status" id="id_status" placeholder="...">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </div>
        </div>
            </form>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="form-group">

            <form action="{{ url ('update_data/') }}" method="post">
            @csrf
                <div>
                    <input  class="form-control" type="hidden" name="eid" id="eid">
                </div>
                <div>
                    <label for="">Nama Lengkap</label>
                    <input required class="form-control" type="text" name="nama" id="enama">
                </div>
                <div class="form-group">
                    <label for="">Usia</label>
                    <input required class="form-control" type="number" name="usia" id="eusia" >
                </div>
                <div class="form-group">
                    <label for="">Tanggal Lahir</label>
                    <input required class="form-control" type="date" name="tanggal_lahir" id="etanggal_lahir" >
                </div>
                <div class="form-group">
                    <label for="">RT</label>
                    <input required class="form-control" type="text" name="rt" id="ert" >
                </div>
                <div class="form-group">
                    <label for="">RW</label>
                    <input required class="form-control" type="text" name="rw" id="erw" >
                </div>
                <div class="form-group">
                    <label for="">Pekerjaan</label>
                    <input required class="form-control" type="text" name="pekerjaan" id="epekerjaan" >
                </div>
                <div class="form-group">
                    <label for="">Nomor Hp</label>
                    <input required class="form-control" type="text" name="nomor_hp" id="enomor_hp" >
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <input required class="form-control" type="text" name="id_status" id="eid_status" >
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
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
    var table = $('#warga-table').DataTable({
        
        processing: true,
        serverSide: true,
        ajax: "{{url ('/json') }}",
        columns: [
            { data: 'nama', name: 'nama' },
            { data: 'usia', name: 'usia' },
            { data: 'tanggal_lahir', name: 'tanggal_lahir' },
            { data: 'rt', name: 'rt' },
            { data: 'rw', name: 'rw' },
            { data: 'pekerjaan', name: 'pekerjaan' },
            { data: 'nomor_hp', name: 'nomor_hp' },
            { data: 'id_status', name: 'id_status' },
            { data: 'aksi', name: 'aksi',"searchable": false }
        ]
    });
});
</script>
<script type="text/javascript">
  function reply_click(clicked_id)
  {
    console.log(clicked_id)

    $.ajax({
        url : '../public/get/'+clicked_id,
        method :"get",
        success(a,b,c){
            console.log(
                {a,b,c}
            )

            let id = a.data.id;
            $('#eid').val(id);
            let nama = a.data.nama;
            $('#enama').val(nama);
            let usia = a.data.usia;
            $('#eusia').val(usia);
            let tanggal_lahir = a.data.tanggal_lahir;
            $('#etanggal_lahir').val(tanggal_lahir);
            let rt = a.data.rt;
            $('#ert').val(rt);
            let rw = a.data.rw;
            $('#erw').val(rw);
            let pekerjaan = a.data.pekerjaan;
            $('#epekerjaan').val(pekerjaan);
            let nomor_hp = a.data.nomor_hp;
            $('#enomor_hp').val(nomor_hp);
            let status = a.data.id_status;
            $('#eid_status').val(status);

        },
        error(){
            console.log("something worng")
        }
        
    })

  }
</script>
<!-- <script>
    $(document).ready(function(){

        $('#data_warga').on('submit',function(e){
            e.preventDefault();

            $.ajax({
                type : "POST",
                url : "../public/simpan_data_warga",
                data :$('#data_warga').serialize(),
                success : function(response){

                    console.log(response)

                   
                    $("#close_btn").trigger("click");
                    
                    alert("Data Berhasil Disimpan");
                    // location.reload();
                    // setInterval( function () {
                    //     this.table.ajax.reload();
                    // }, 2000 );
                },
                error : function(error){
                    console.log(error);
                }
            });
        });
    });
</script> -->
@endsection
