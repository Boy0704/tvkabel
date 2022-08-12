<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #dedede">
            <ul class="nav nav-pills">
                <!-- <li role="presentation" class="">
                    <a href="https://mistiktech.com/tvkabel/admin/pendapatan">Pendapatan Harian</a>
                </li>
                <li role="presentation" class="active">
                    <a href="https://mistiktech.com/tvkabel/admin/statistik">Statistik Bulanan</a>
                </li>
                <li role="presentation">
                    <a href="https://mistiktech.com/tvkabel/admin/statistik2">Statistik Tahunan</a>
                </li> -->
            </ul>
        </div>
        <div class="col-md-12">
            <form action="" method="GET">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <span>Wilayah</span>
                        <select class="form-control select2" name="id_wilayah">
                            <option value="">Semua Wilayah</option>
                            <?php foreach ($this->db->get('wilayah')->result() as $rw): ?>
                            <option value="<?php echo $rw->id_wilayah ?>" <?php echo ( isset($_GET['id_wilayah']) AND
                                $_GET['id_wilayah']==$rw->id_wilayah ) ? 'selected' : '' ?>>
                                <?php echo $rw->wilayah ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <span>Bulan</span>
                        <select class="form-control select2" name="bulan">
                            <?php
                            for ($i=1; $i<=12; $i++) { 
                            ?>
                             <option value="<?php echo $i ?>" <?php echo ( isset($_GET['bulan']) AND $_GET['bulan']==$i ) ? 'selected' : '' ?> ><?php echo bulan($i) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <span>Tahun</span>
                        <select class="form-control select2" name="tahun">
                            <option value="">Tahun</option>
                            <?php foreach ($this->db->get('tahun')->result() as $rw): ?>
                            <option value="<?php echo $rw->tahun ?>" <?php echo ( isset($_GET['tahun']) AND
                                $_GET['tahun']==$rw->tahun ) ? 'selected' : '' ?>>
                                <?php echo $rw->tahun ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-2" style="margin-top:10px">
                        <br>
                        <button class="btn btn-info">
                            <i class="material-icons">search</i>
                        </button>
                    </div>
            </form>

            <?php 
           
            $sudah_bayar = 0;
            $belum_bayar = 0;
            $id_wilayah = $this->input->get('id_wilayah');
            $wilayah = get_data('wilayah','id_wilayah',$id_wilayah,'wilayah');
            $tahun = $this->input->get('tahun');
            $bulan = $this->input->get('bulan');
            $cari_wilayah = "";
            if ($id_wilayah != '') {
              $cari_wilayah = "a.id_wilayah = '$id_wilayah' and";
            } 

            $total_pelanggan = $this->db->query("SELECT a.id_pelanggan FROM pelanggan as a where $cari_wilayah aktif='y' ")->num_rows();

            $pelanggan_menunggak = $this->db->query("

                SELECT
                  a.kd_pelanggan, a.nama, c.wilayah, a.telp, b.layanan, a.tanggal_daftar
                FROM
                  pelanggan AS a
                  INNER JOIN layanan AS b ON a.id_layanan = b.id_layanan 
                  INNER JOIN wilayah as c ON a.id_wilayah = c.id_wilayah
                WHERE
                  $cari_wilayah a.id_pelanggan not in (SELECT a.id_pelanggan as total FROM pelanggan as a
              inner join tagihan as b on a.id_pelanggan=b.id_pelanggan
              WHERE $cari_wilayah id_bulan='$bulan' and tahun='$tahun' ) and a.aktif='y'

              ");

            $sudah_bayar = $this->db->query(" 
              SELECT a.id_pelanggan as total FROM pelanggan as a
              inner join tagihan as b on a.id_pelanggan=b.id_pelanggan
              WHERE $cari_wilayah id_bulan='$bulan' and tahun='$tahun' 
            ")->num_rows();
            $belum_bayar = $total_pelanggan - $sudah_bayar;

            $total_tagihan = $this->db->query("
                SELECT sum(b.harga) as total from pelanggan as a
                inner join layanan as b on a.id_layanan=b.id_layanan
                where $cari_wilayah a.aktif='y'
              ")->row()->total;

            $total_dibayar = $this->db->query("
                SELECT sum(b.harga) as total from pelanggan as a
                inner join layanan as b on a.id_layanan=b.id_layanan
                inner join tagihan as c on a.id_pelanggan=c.id_pelanggan
                where 
                $cari_wilayah
                c.id_bulan='$bulan'
                and c.tahun='$tahun' 
                and a.aktif = 'y'
              ")->row()->total;

            $total_belum_dibayar = $total_tagihan - $total_dibayar;
            $persen_dibayar = ($total_dibayar / $total_tagihan) * 100;
            $persen_belum_dibayar = ($total_belum_dibayar / $total_tagihan) * 100;

             ?>

            <div class="row">
                <div class="col-md-7">
                    <canvas id="myChart" width="80%" height="42"></canvas>
                </div>

                <div class="col-md-4" style="padding-top:28px">

                    <table class="table table-sm table-bordered">

                        <tr>
                            <td>Bulan</td>
                            <td><?php echo bulan($bulan).' '.$tahun ?> </td>
                        </tr>

                        <tr>
                            <td>Wilayah</td>
                            <td><?php echo ( $wilayah != '' ) ? $wilayah : 'Semua wilayah' ?></td>
                        </tr>


                        <tr>
                            <td>Total Tagihan</td>
                            <td>Rp <?php echo number_format($total_tagihan) ?></td>
                        </tr>


                        <tr>
                            <td>Total Pembayaran</td>
                            <td>Rp <?php echo number_format($total_dibayar) ?> <b>(<?php echo number_format($persen_dibayar,2) ?> %)</b></td>
                        </tr>

                        <tr>
                            <td>Total Belum Dibayar</td>
                            <td>Rp <?php echo number_format($total_belum_dibayar) ?> <b>(<?php echo number_format($persen_belum_dibayar,2) ?> %)</b></td>
                        </tr>
                    </table>


                </div>

                <div class="col-md-12">

                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Tampilkan pelanggan menunggak
                    </a>

                    <div class="collapse" id="collapseExample">
                        <div class="well">

                            <table class="table table-bordered" id="example">
                                <thead class="text-primary">
                                    <th>No</th>
                                    <th>ID PLGN</th>
                                    <th>Nama Pelanggan</th>
                                    <th>RT/RW/Wilayah</th>
                                    <th>Telp/Hp</th>
                                    <th>Layanan</th>
                                </thead>
                                <tbody>
                                <?php 
                                $no = 1;
                                foreach ($pelanggan_menunggak->result() as $rw): ?>
                                  
                                
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $rw->kd_pelanggan ?></td>
                                        <td><?php echo $rw->nama ?></td>
                                        <td><?php echo $rw->wilayah ?></td>
                                        <td><?php echo $rw->telp ?></td>
                                        <td><?php echo $rw->layanan ?></td>
                                    </tr>
                                <?php $no++; endforeach ?>
                                </tbody>
                            </table>

                        </div>
                    </div>



                </div>

            </div>
        </div>


        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var jan = [12, 10];
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Grafik',],
                    datasets: [{
                        label: 'Total Pelanggan',
                        data: [<?php echo $total_pelanggan ?>],
                        backgroundColor: [
                            '#9c27b0'
                        ]
                    },
                    {
                        label: 'Sudah Bayar',
                        data: [<?php echo $sudah_bayar ?>],
                        backgroundColor: [
                            '#46ff33'
                        ]
                    },
                    {
                        label: 'Belum Bayar',
                        data: [<?php echo $belum_bayar ?>],
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


<script src="assets/grafik/chartist.min.js"></script>