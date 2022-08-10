<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<div class="container-fluid">
  <div class="row">
                <div class="col-md-12" style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #dedede">
                  <ul class="nav nav-pills">
                    <li role="presentation" class="">
                      <a href="https://mistiktech.com/tvkabel/admin/pendapatan">Pendapatan Harian</a>
                    </li>
                    <li role="presentation" class="active">
                      <a href="https://mistiktech.com/tvkabel/admin/statistik">Statistik Bulanan</a>
                    </li>
                    <li role="presentation">
                      <a href="https://mistiktech.com/tvkabel/admin/statistik2">Statistik Tahunan</a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-12">
                  <div class="row mb-4">
                    <div class="col-md-2">
                      <span>Wilayah</span>
                      <select name="kelurahan" id="kelurahan" class="form-control">
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
                      <span>Bulan</span>
                      <select class="form-control" id="bulan">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8" selected="">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <span>Tahun</span>
                      <select class="form-control" id="tahun">
                        <option>2020</option>
                        <option>2021</option>
                        <option selected="">2022</option>
                        <option>2023</option>
                        <option>2024</option>
                      </select>
                    </div>
                    <div class="col-md-2" style="margin-top:10px">
                      <br>
                      <button class="btn btn-info" onclick="getStatistik();">
                        <i class="material-icons">search</i>
                      </button>
                    </div>
                    
                        <div class="row">
      <div class="col-md-7">
          <canvas id="myChart" width="80%" height="42"></canvas>
      </div>

      <div class="col-md-4" style="padding-top:28px">

          <table class="table table-sm table-bordered">

              <tr>
                  <td>Bulan</td>
                  <td>August 2022</td>
              </tr>

              <tr>
                  <td>Wilayah</td>
                  <td>Semua wilayah</td>
              </tr>

              
              <tr>
                  <td>Total Tagihan</td>
                  <td>Rp 245,000</td>
              </tr>

              
              <tr>
                  <td>Total Pembayaran</td>
                                  <td>Rp 30,000 <b>(12.24 %)</b></td>
                              </tr>

              <tr>
                  <td>Total Belum Dibayar</td>
                                  <td>Rp 215,000 <b>(87.76  %)</b></td>
                              </tr>
          </table>
      

      </div>

      <div class="col-md-12">

      <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Tampilkan pelanggan menunggak
      </a>

      <div class="collapse" id="collapseExample">
          <div class="well">
              
              <table class="table table-bordered" id="example">
                  <thead class="text-primary">
                  <th>No</th>
                  <th>Id</th>
                  <th>Nama Pelanggan</th>
                  <th>RT/RW/Wilayah</th>
                  <th>Telp/Hp</th>
                  <th>Paket</th>
                  <th>Tanggal Daftar</th>
                  </thead>
                  <tbody>
                                      <tr>
                      <td>1</td>
                      <td>102010213</td>
                      <td>M Yamin</td>
                      <td>G dayaku 8, RT 1/ RW 0</td>
                      <td></td>
                      <td>TV 1</td>
                      <td>2020-08-21</td>
                      </tr>
                                      <tr>
                      <td>2</td>
                      <td>1003</td>
                      <td>HERMAN</td>
                      <td>G dayaku 8, RT 1/ RW 0</td>
                      <td></td>
                      <td>TV 1</td>
                      <td>2020-08-21</td>
                      </tr>
                                      <tr>
                      <td>3</td>
                      <td>1005</td>
                      <td>ATU</td>
                      <td>G dayaku 8, RT 0/ RW 0</td>
                      <td></td>
                      <td>TV 1</td>
                      <td>2020-08-21</td>
                      </tr>
                                      <tr>
                      <td>4</td>
                      <td>1008</td>
                      <td>SAHA</td>
                      <td>G dayaku 8, RT 0/ RW 0</td>
                      <td></td>
                      <td>TV 1</td>
                      <td>2020-08-21</td>
                      </tr>
                                      <tr>
                      <td>5</td>
                      <td>1010</td>
                      <td>LIA/SYARIF</td>
                      <td>G dayaku 8, RT 1/ RW 0</td>
                      <td></td>
                      <td>TV 1</td>
                      <td>2020-08-21</td>
                      </tr>
                                      <tr>
                      <td>6</td>
                      <td>T1</td>
                      <td>Indra</td>
                      <td>G dayaku 8, RT 1/ RW 0</td>
                      <td>082317152777</td>
                      <td>DIGITAL</td>
                      <td>2022-07-02</td>
                      </tr>
                                  
                  </tbody>
              </table>
              
          </div>
      </div>

          

      </div>

  </div>
</div>


<script>
var ctx = document.getElementById('myChart').getContext('2d');
var jan = [12,10];
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Grafik',],
    datasets: [{
        label: 'Total Member',
        data: [7],
        backgroundColor: [
          '#9c27b0'
        ]
      },
      {
        label: 'Sudah Bayar',
        data: [1],
        backgroundColor: [
          '#46ff33'
        ]
      },
      {
        label: 'Belum Bayar',
        data: [6],
        backgroundColor: [
          '#ff3333'
        ]
      }
      
    ]
  },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

                </div>
              </div>
            </div>

            
        <script src="https://mistiktech.com/tvkabel/dist/js/chartist.min.js"></script>