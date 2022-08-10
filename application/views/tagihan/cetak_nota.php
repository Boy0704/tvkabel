<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body onload="window.print();	">
	<center>
	<h4>PT. NMV NIPAH PANJANG</h4>
	</center>
	<hr style="border-bottom:3px dashed black;">

	
	<?php 
		$x = 0;
		$id_pelanggan = $this->uri->segment(3);
		$tahun = $this->uri->segment(4);
		$bulan = $this->uri->segment(5);
		$rw = $this->db->get_where('tagihan', array('id_pelanggan'=>$id_pelanggan, 'tahun'=>$tahun, 'id_bulan'=>$bulan))->row();
		 ?>
		<table width="100%">
			<tr>
				<td>ID PLGN</td>
				<td>: <?php echo strtoupper(get_data('pelanggan','id_pelanggan',$rw->id_pelanggan,'kd_pelanggan')) ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>: <?php echo strtoupper(get_data('pelanggan','id_pelanggan',$rw->id_pelanggan,'nama')) ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>: <?php echo strtoupper(get_data('pelanggan','id_pelanggan',$rw->id_pelanggan,'alamat')) ?></td>
			</tr>
			<tr>
				<td>No HP</td>
				<td>: <?php echo strtoupper(get_data('pelanggan','id_pelanggan',$rw->id_pelanggan,'telp')) ?></td>
			</tr>
			<tr>
				<td>Paket</td>
				<td>: <?php 
				$id_layanan = get_data('pelanggan','id_pelanggan',$rw->id_pelanggan,'id_layanan');
				$layanan = $this->db->get_where('layanan', array('id_layanan'=>$id_layanan))->row();
				echo strtoupper($layanan->layanan); 
			?></td>
			<tr>
				<td>Periode</td>
				<td>: <?php echo strtoupper(bulan($rw->id_bulan).' '.$tahun); ?></td>
			</tr>
			<tr>
				<td>Tagihan</td>
				<td>: <?php echo number_format($rw->tagihan); ?></td>
			</tr>
			<tr>
				<td>Denda</td>
				<td>: <?php echo number_format($rw->denda); ?></td>
			</tr>
			<tr>
				<td>Total Bayar</td>
				<td>: <?php echo number_format($rw->total_bayar); ?></td>
			</tr>
		</table>
		
	<hr style="border-bottom:3px dashed black;">

	<table>
		<tr>
			<td style="padding: 2px;">
				

				<table>
					<?php 
				for ($i=1; $i <= 6; $i++) { 
					?>
					<tr>
						<td style="padding: 2px;"><?php echo bulan($i) ?></td>
						<td style="border: solid 1px black; text-align: center;"><?php echo (cek_tagihan_lunas($rw->id_pelanggan, $tahun, $i)) ? "LUNAS" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?></td>
					</tr>
					<?php
				}
				 ?>
				</table>

					
			</td>
			<td style="padding: 2px;">
				<table>
					<?php 
				for ($i=7; $i <= 12; $i++) { 
					?>
					<tr>
						<td style="padding: 2px;"><?php echo bulan($i) ?></td>
						<td style="border: solid 1px black;text-align: center;"><?php echo (cek_tagihan_lunas($rw->id_pelanggan, $tahun, $i)) ? "LUNAS" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?></td>
					</tr>
					<?php
				}
				 ?>
				</table>
				
			</td>
		</tr>
		<tr>
			<td>Petugas : <?php echo strtoupper(get_data('a_user','id_user',$rw->created_by,'nama_lengkap')) ?></td>
		</tr>
	</table>
	
	

	<p>
		<center>
			Terima Kasih <br>
			Kami ucapkan kepada semua pelanggan 	<br>
			NMV NIPAH PANJANG <br>
			yang sudah bergabung dengan kami
		</center>
	</p>


	<script type="text/javascript">

	</script>
	
		
</body>
</html>