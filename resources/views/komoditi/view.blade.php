    <input type="hidden" name="id" value="{{$ide}}">
    <!-- <input type="submit"> -->
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Nama Komoditi</label>
        <div class="col-lg-9">
            <input type="text" name="nama_komoditi" value="{{$data->nama_komoditi}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Tipe Komoditi</label>
        <div class="col-lg-3">
            <select class="form-control form-control-sm" name="tipe_komoditi">
                
                <option value="">Pilih</option>
                <option value="1" @if($data->tipe_komoditi==1) selected @endif >Barang</option>
                <option value="2" @if($data->tipe_komoditi==2) selected @endif >Jasa</option>
               
            </select>
        </div>
        
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Deskripsi Komoditi</label>
        <div class="col-lg-9">
            <input type="text" name="deskripsi_komoditi" value="{{$data->deskripsi_komoditi}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    
    <script>
        
        $('#tgl_lahir').datepicker({format:"yyyy-mm-dd"});
        $('.default-select2').select2();
        $("#maskeddatetime1").mask("99:99:99");
        $("#maskeddatetime2").mask("99:99:99");
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
    </script>