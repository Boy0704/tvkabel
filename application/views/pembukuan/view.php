<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12" style="margin-top:12px">
                    <div class="col-md-2">
                      <span>Tanggal Awal</span>
                      <input type="text" id="from_date" value="2022-08-01" class="form-control">
                    </div>
                    <div class="col-md-2">
                      <span>Tanggal Akhir</span>
                      <input type="text" id="to_date" value="2022-08-04" class="form-control">
                    </div>
                    <div class="col-md-3">
                      <span>Periode Jam</span>
                      <select class="form-control" id="jam">
                        <option value="0">Semua Periode Jam</option>
                        <option value="1">Pagi (00.00-12.59)</option>
                        <option value="2">Sore (13:00-23.59)</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <span>Sorting Berdasarkan</span>
                      <select class="form-control" id="sorting">
                        <option value="0">Tanggal Bayar</option>
                        <option value="1">Tagihan</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <span>Pilih Wilayah</span>
                      <select class="form-control" id="kelurahan">
                        <option value="">Semua Wilayah</option>
                        <option value="1">G dayaku 8</option>
                        <option value="2">Air Terjun</option>
                        <option value="3">G dayaku7</option>
                        <option value="4">Air Terjun2</option>
                        <option value="5">Gunung Batu</option>
                        <option value="6">G Dayaku6</option>
                        <option value="7">Gg Manggis</option>
                        <option value="8">MULAWARMAN</option>
                        <option value="9">G Dayaku5</option>
                        <option value="10">Gg Pelangi 5</option>
                        <option value="11">TARUNA</option>
                        <option value="12">GG SUKUN</option>
                        <option value="13">KAMP JAWA</option>
                        <option value="14">JL KESEHATAN</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <span>Pilih Kolektor</span>
                      <select class="form-control" id="kolektor">
                        <option value="">Semua Kolektor</option>
                        <option value="herman">Herman</option>
                        <option value="joko">joko</option>
                        <option value="kolektor">kolektor</option>
                        <option value="admin">Admin</option>
                      </select>
                    </div>
                    <div class="col-md-1" style="padding-top: 33px;padding-bottom: 12px;">
                      <button class="btn btn-info" onclick="getTablePembukuan();">
                        <i class="material-icons">search</i>
                      </button>
                    </div>
                  </div>
                  <div class="table-responsive">
                    
                    <table class="table table-bordered">
                      <tr>
                        <td>No</td>
                      </tr>
                      <tr>
                        <td>NA</td>
                      </tr>
                    </table>

                  </div>
    </div>
  </div>
</div>
