    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="vendor_id" value="{{$mst->id}}">
    <input type="hidden" name="users_id" value="{{$mst->users_id}}">
    <!-- <input type="submit"> -->
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Pemilik Rekening</label>
        <div class="col-lg-7">
            <input type="text" name="pemilik" value="{{$pemilik}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">BANK & Kode BANK</label>
        <div class="col-lg-3">
            <select class="default-select2 form-control form-control-sm" name="bank_id">
                
                <option value="">Pilih</option>
                @foreach(get_bank() as $bank)
                    <option value="{{$bank->id}}" @if($data->bank_id==$bank->id) selected @endif >{{$bank->bank}}</option>
                @endforeach
               
            </select>
        </div>
        <div class="col-lg-5">
            <input type="text" name="kode_bank" value="{{$data->kode_bank}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Nomor Rekening</label>
        <div class="col-lg-7">
            <input type="text" name="no_rekening" value="{{$data->no_rekening}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Alamat Bank</label>
        <div class="col-lg-9">
            <input type="text" name="alamat_bank" value="{{$data->alamat_bank}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Cabang / KCP</label>
        <div class="col-lg-5">
            <input type="text" name="cabang" value="{{$data->cabang}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <script>
        
        $('.default-select2').select2();
        $("#maskeddatetime1").mask("99:99:99");
        $("#maskeddatetime2").mask("99:99:99");
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
    </script>