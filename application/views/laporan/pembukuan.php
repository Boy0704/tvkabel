<?php
$name_file = "pembukuan-".date('Y-m-d');
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$name_file.xls");
?>

<h4>Rekap Pembukuan</h4>
<hr>
<?php 
$tgl1 = $this->input->get('tgl1');
$tgl2 = $this->input->get('tgl2');
$sorting = $this->input->get('sorting');
$id_wilayah = $this->input->get('id_wilayah');
$kolektor = $this->input->get('kolektor');
 ?>
<table>
	<tr>
		<td>Tanggal</td><td>: <?php echo $tgl1.' / '.$tgl2 ?></td>
	</tr>
	<tr>
		<td>Wilayah</td><td>: <?php echo $retVal = ($id_wilayah !='') ? get_data('wilayah','id_wilayah',$id_wilayah,'wilayah') : 'Semua wilayah' ; ?></td>
	</tr>
	<tr>
		<td>Kolektor</td><td>: <?php echo $retVal = ($kolektor != '') ? get_data('a_user','id_user',$kolektor,'nama_lengkap') : 'Semua kolektor' ; ?></td>
	</tr>
	
</table>

<table class="table table-bordered" border="1">
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