    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="vendor_id" value="{{$mst->id}}">
    <input type="hidden" name="users_id" value="{{$mst->users_id}}">
    <!-- <input type="submit"> -->
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Nama Personil</label>
        <div class="col-lg-7">
            <input type="text" name="nama" value="{{$data->nama}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">No KTP & Upload KTP</label>
        <div class="col-lg-5">
            <input type="text" name="no_ktp" value="{{$data->no_ktp}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
        <div class="col-lg-3">
            <input type="file" name="file_ktp" value="{{$data->no_ktp}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Tempat Tangga Lahir</label>
        <div class="col-lg-3">
            <input type="text" name="tempat_lahir" value="{{$data->tempat_lahir}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
        <div class="col-lg-2">
            <input type="text" name="tgl_lahir" value="{{$data->tgl_lahir}}" id="tgl_lahir"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Alamat</label>
        <div class="col-lg-9">
            <input type="text" name="alamat" value="{{$data->alamat}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Jabatan</label>
        <div class="col-lg-3">
            <select class="form-control form-control-sm" name="jabatan_id">
                
                <option value="">Pilih</option>
                @foreach(get_jabatan() as $bank)
                    <option value="{{$bank->id}}" @if($data->jabatan_id==$bank->id) selected @endif >{{$bank->jabatan}}</option>
                @endforeach
               
            </select>
        </div>
        
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Email Personil</label>
        <div class="col-lg-5">
            <input type="text" name="email" value="{{$data->email}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Telepon Personil</label>
        <div class="col-lg-3">
            <input type="text" name="telepon" value="{{$data->telepon}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    
    <script>
        
        $('#tgl_lahir').datepicker({format:"yyyy-mm-dd"});
        $('.default-select2').select2();
        $("#maskeddatetime1").mask("99:99:99");
        $("#maskeddatetime2").mask("99:99:99");
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
    </script>