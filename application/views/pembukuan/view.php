<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="GET">
            <div class="col-md-12" style="margin-top:12px">
                <div class="col-md-2">
                    <span>Tanggal Awal</span>
                    <input type="date" name="tgl1" value="<?php echo ( isset($_GET['tgl1']) AND !empty($_GET['tgl1']) ) ? $_GET['tgl1'] : date('Y-m-d') ?>" class="form-control">
                </div>
                <div class="col-md-2">
                    <span>Tanggal Akhir</span>
                    <input type="date" name="tgl2" value="<?php echo ( isset($_GET['tgl2']) AND !empty($_GET['tgl2']) ) ? $_GET['tgl2'] : date('Y-m-d') ?>" class="form-control">
                </div>
                <!-- <div class="col-md-3">
                    <span>Periode Jam</span>
                    <select class="form-control" name="jam">
                        <option value="0">Semua Periode Jam</option>
                        <option value="1">Pagi (00.00-12.59)</option>
                        <option value="2">Sore (13:00-23.59)</option>
                    </select>
                </div> -->
                <div class="col-md-3">
                    <span>Sorting Berdasarkan</span>
                    <select class="form-control" name="sorting">
                        <option value="created_at" <?php echo ( isset($_GET['sorting']) AND $_GET['sorting']=='created_at' ) ? 'selected' : '' ?>>Tanggal Bayar</option>
                        <option value="total_bayar" <?php echo ( isset($_GET['sorting']) AND $_GET['sorting']=='total_bayar' ) ? 'selected' : '' ?>>Tagihan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <span>Pilih Wilayah</span>
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
                    <span>Pilih Kolektor</span>
                    <select class="form-control select2" name="kolektor">
                        <option value="">Semua Kolektor</option>
                        <?php foreach ($this->db->get('a_user')->result() as $br): 
                        ?>
                            <option value="<?php echo $br->id_user ?>" <?php echo ( isset($_GET['kolektor']) AND
                            $_GET['kolektor']==$br->id_user ) ? 'selected' : '' ?>><?php echo $br->nama_lengkap ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-3" style="padding-top: 33px;padding-bottom: 12px;">
                    <button class="btn btn-info">
                        <i class="fa fa-search">search</i>
                    </button>
                    <a href="app/excel_pembukuan?<?php echo param_get() ?>" target="_blank" class="btn btn-warning"><i class="fa fa-print"></i> Export Excel</a>
                </div>
            </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">

                <table class="table table-bordered">
                    <thead class="text-primary">
                        <th>No</th>
                        <th>ID Plgn</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Paket</th>
                        <th>Tagihan Bulan</th>
                        <th>Total</th>
                        <th>Denda</th>
                        <th>Tanggal Dibayar</th>
                        <th>Kolektor</th>
                    </thead>
                    <tbody>

                        <?php 
                        $no = 1;
                        $total1 = 0;
                        $total2 = 0;
                        $tgl1 = $this->input->get('tgl1');
                        $tgl2 = $this->input->get('tgl2');
                        $sorting = $this->input->get('sorting');
                        $id_wilayah = $this->input->get('id_wilayah');
                        $kolektor = $this->input->get('kolektor');

                        $cari_wilayah = "";
                        $cari_kolektor = "";
                        if ($id_wilayah != '') {
                            $cari_wilayah = "a.id_wilayah = '$id_wilayah' and";
                        }
                        if ($kolektor != "") {
                            $cari_kolektor = "d.created_by = '$kolektor' and";
                        }

                        $data = $this->db->query("

                                 SELECT
                                    a.id_pelanggan,
                                    a.kd_pelanggan,
                                    a.nama,
                                    c.wilayah,
                                    b.layanan,
                                    d.id_bulan,
                                    d.tahun,
                                    d.total_bayar,
                                    d.denda,
                                    d.created_at,
                                    d.created_by
                                FROM
                                    pelanggan AS a
                                    INNER JOIN layanan AS b ON a.id_layanan = b.id_layanan
                                    INNER JOIN wilayah AS c ON a.id_wilayah = c.id_wilayah
                                    INNER JOIN tagihan AS d ON a.id_pelanggan = d.id_pelanggan
                                                    WHERE 
                                                    $cari_wilayah
                                                    $cari_kolektor
                                                    d.created_at BETWEEN '$tgl1 00:00:59' and '$tgl2 23:59:59'
                                                    ORDER BY $sorting DESC

                            ");
                        foreach ($data->result() as $rw): 
                            ?>
                            
                        
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $rw->kd_pelanggan ?></td>
                            <td><?php echo $rw->nama ?></td>
                            <td><?php echo $rw->wilayah ?></td>
                            <td><?php echo $rw->layanan ?></td>
                            <td><?php echo bulan($rw->id_bulan).' '.$rw->tahun ?></td>
                            <td>Rp. <?php echo number_format($rw->total_bayar,2); $total1 = $total1 + $rw->total_bayar ?></td>
                            <td>Rp. <?php echo number_format($rw->denda); $total2 = $total2 + $rw->denda ?></td>
                            <td><?php echo $rw->created_at ?></td>
                            <td><?php echo get_data('a_user','id_user',$rw->created_by,'nama_lengkap') ?></td>
                        </tr>
                        
                        <?php $no++; endforeach ?>
                        <tr class="text-primary">
                            <td colspan="6"><b>Total</b></td>
                            <td colspan="1"><b>Rp <?php echo number_format($total1) ?></b></td>
                            <td colspan="1"><b>Rp <?php echo number_format($total2) ?></b></td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>