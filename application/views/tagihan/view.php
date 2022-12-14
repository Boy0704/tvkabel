<div class="row" style="margin-bottom: 10px">
	<form action="" method="GET">
		<div class="col-md-3">
			<span>Wilayah</span>
			<select class="form-control select2" name="id_wilayah">
	            <option value="">Semua Wilayah</option>
	            <?php foreach ($this->db->get('wilayah')->result() as $rw): ?>
	                <option value="<?php echo $rw->id_wilayah ?>" <?php echo ( isset($_GET['id_wilayah']) AND $_GET['id_wilayah'] == $rw->id_wilayah ) ? 'selected' : '' ?>><?php echo $rw->wilayah ?></option>
	            <?php endforeach ?>
	        </select>
		</div>

		<div class="col-md-3">
			<span>Jumlah Data</span>
			<select class="form-control select2" name="limit">
	            <option value="20" <?php echo ( isset($_GET['limit']) AND $_GET['limit'] == 20 ) ? 'selected' : '' ?> >20 Data</option>
	            <option value="30" <?php echo ( isset($_GET['limit']) AND $_GET['limit'] == 30 ) ? 'selected' : '' ?> >30 Data</option>
	            <option value="40" <?php echo ( isset($_GET['limit']) AND $_GET['limit'] == 40 ) ? 'selected' : '' ?>>40 Data</option>
	            <option value="all" <?php echo ( isset($_GET['limit']) AND $_GET['limit'] == 'all' ) ? 'selected' : '' ?>>Semua Data</option>
	        </select>
		</div>

		<div class="col-md-3">
			<span>Nama Pelanggan</span>
			<select class="form-control select2" name="id_pelanggan">
	            <option value="">Semua Pelanggan</option>
	            <?php foreach ($this->db->get('pelanggan')->result() as $rw): ?>
	                <option value="<?php echo $rw->id_pelanggan ?>" <?php echo ( isset($_GET['id_pelanggan']) AND $_GET['id_pelanggan'] == $rw->id_pelanggan ) ? 'selected' : '' ?>><?php echo $rw->nama ?> - <?php echo get_data('wilayah','id_wilayah',$rw->id_wilayah,'wilayah') ?></option>
	            <?php endforeach ?>
	        </select>
		</div>
		<!-- <div class="col-md-3">
			<select class="form-control select2" name="tahun">
	            <option value="">Tahun</option>
	            <?php foreach ($this->db->get('tahun')->result() as $rw): ?>
	                <option value="<?php echo $rw->tahun ?>" <?php echo ( isset($_GET['tahun']) AND $_GET['tahun'] == $rw->tahun ) ? 'selected' : '' ?>><?php echo $rw->tahun ?></option>
	            <?php endforeach ?>
	        </select>
		</div>
		<div class="col-md-3">
			<select class="form-control select2" name="id_wilayah">
	            <option value="">Semua Wilayah</option>
	            <?php foreach ($this->db->get('wilayah')->result() as $rw): ?>
	                <option value="<?php echo $rw->id_wilayah ?>" <?php echo ( isset($_GET['id_wilayah']) AND $_GET['id_wilayah'] == $rw->id_wilayah ) ? 'selected' : '' ?>><?php echo $rw->wilayah ?></option>
	            <?php endforeach ?>
	        </select>
		</div> -->
		<div class="col-md-3"><br><button type="submit" class="btn btn-warning">Cari</button></div>
	</form>
</div>
<hr>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-stripped" id="example1">
				<thead>
					<tr class="alert-warning">
						<th>No.</th>
						<th>ID PLGN</th>
						<th>NAMA PLGN</th>
						<th>WILAYAH/ALAMAT</th>
						<th>TAGIHAN BULANAN</th>
						<th>TAHUN</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					$tahun = date('Y');
					if ( isset($_GET['id_pelanggan']) AND !empty($_GET['id_pelanggan']) ) {
		            	$id_pelanggan = $this->input->get('id_pelanggan');
		            	$this->db->where('id_pelanggan', $id_pelanggan);
		            }
		            if ( isset($_GET['id_wilayah']) AND !empty($_GET['id_wilayah']) ) {
		            	$id_wilayah = $this->input->get('id_wilayah');
		            	$this->db->where('id_wilayah', $id_wilayah);
		            }
		            $this->db->order_by('id_pelanggan', 'desc');
		            if ( isset($_GET['limit']) AND !empty($_GET['limit']) ) {
		            	$limit = $this->input->get('limit');
		            	if ($limit == 'all') {
		            		// code...
		            	} else {
		            		$this->db->limit($limit);
		            	}
		            	
		            } else {
		            	$this->db->limit(20);
		            }
		            $this->db->where('aktif', 'y');
					$data_tagihan = $this->db->get('pelanggan');
					foreach ($data_tagihan->result() as $rw): ?>
						
					
					<tr>
						<td><?php echo $no ?></td>
						<td><?php echo $rw->kd_pelanggan ?></td>
						<th><?php echo strtoupper($rw->nama) ?></th>
						<td>
							<a onclick="openModal('<?php echo $rw->foto_rumah ?>')">
								<?php echo get_data('wilayah','id_wilayah',$rw->id_wilayah,'wilayah').' '.$rw->alamat ?>
							</a>
						</td>
						<td>
							<?php 
							$success = "success";
							if ($this->session->userdata('id_user') == '6') {
								$success = "warning";
							}
							for ($i=1; $i <= 12; $i++) { 
								if ($i > 1) {
									//echo "&nbsp; &nbsp;";
								}
								$cek_tagihan_lunas = cek_tagihan_lunas($rw->id_pelanggan, $tahun, $i);
								$sts_warna = ($cek_tagihan_lunas) ? $success : 'danger';
								?>

								<a class="btn btn-<?php echo $sts_warna ?>" data-toggle="modal" data-target="#modal-<?php echo $rw->id_pelanggan ?>-<?php echo $i ?>"><?php echo $i ?></a>

								<div class="modal fade" id="modal-<?php echo $rw->id_pelanggan ?>-<?php echo $i ?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Bayar Tagihan</h4> </div>
										<form action="app/simpan_tagihan/<?php echo $rw->id_pelanggan.'/'.$tahun.'/'.$i ?>" target="_blank" method="POST">
										<div class="modal-body">
											
												<table class="table">
													<tr>
														<td>ID PLGN</td>
														<td>: <?php echo $rw->kd_pelanggan ?></td>
													</tr>
													<tr>
														<td>Nama</td>
														<td>: <?php echo strtoupper($rw->nama) ?></td>
													</tr>
													<tr>
														<td>Wilayah RT/RW</td>
														<td>: <?php echo get_data('wilayah','id_wilayah',$rw->id_wilayah,'wilayah').' '.$rw->alamat ?></td>
													</tr>
													<tr>
														<td>Layanan</td>
														<td>: <?php echo get_data('layanan','id_layanan',$rw->id_layanan,'layanan') ?></td>
													</tr>
													<tr>
														<td><b>Tagihan Bulan</b> <span style="font-weight: bold; color: red;"><?php echo bulan($i).' '.$tahun ?></span></td>
														<td>: <b>Rp. <?php echo number_format(get_data('layanan','id_layanan',$rw->id_layanan,'harga')) ?></b></td>
													</tr>
													<tr>
														<td>Denda</td>
														<td>: <input type="number" name="denda" class="form-control" value="0" autofocus>
															<input type="hidden" name="biaya" value="<?php echo get_data('layanan','id_layanan',$rw->id_layanan,'harga') ?>">
														</td>
													</tr>
													<?php
													$level = $this->session->userdata('level'); 
													 ?>
													<?php if ($level == 'admin'): ?>
													<tr>
														<td>Kolektor</td>
														<td>: 
															
															<select class="form-control select2" name="kolektor" required>
																<?php foreach ($this->db->get('a_user')->result() as $br): 
																	$selected = ($br->id_user == $this->session->userdata('id_user')) ? 'selected' : '';
																?>
																	<option value="<?php echo $br->id_user ?>" <?php echo $selected ?>><?php echo $br->nama_lengkap ?></option>
																<?php endforeach ?>
															</select>
														</td>
													</tr>
													<?php endif ?>
													<tr>
														<td>Bayar VIA</td>
														<td>: 
															<select class="form-control select2" name="bayar_via" required>
																<option value="Kolektor">Kolektor</option>
																<option value="Kantor">Kantor</option>
															</select>
														</td>
													</tr>
												</table>
											
										</div>
										<div class="modal-footer">
											<?php if ($cek_tagihan_lunas): ?>
												<a href="app/cetak_nota/<?php echo $rw->id_pelanggan.'/'.$tahun.'/'.$i ?>" class="btn btn-warning">CETAK NOTA</a>
											<?php endif ?>
											<button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
											<?php if ($level == 'admin' AND $cek_tagihan_lunas): ?>
												<a href="app/batalkan_tagihan/<?php echo $rw->id_pelanggan.'/'.$tahun.'/'.$i ?>" class="btn btn-danger">BATALKAN PEMBAYARAN</a>
											<?php endif ?>
											<?php if (!$cek_tagihan_lunas): ?>
												<button type="submit" class="btn btn-info">BAYAR & CETAK NOTA</button>
											<?php endif ?>
										</div>
										</form>
									</div>
								</div>
							</div>


								<?php
							}
							 ?>
						</td>
						<td>
							<b><?php echo $tahun ?></b>
						</td>
					</tr>
					<?php $no++; endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-default">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title">Foto Rumah</h4>
    </div>
    <div class="modal-body">
      <span id="foto_rumah"></span>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
	function openModal(foto_rumah) {
		$('#modal-default').modal('show');
		if (foto_rumah == '') {
			$("#foto_rumah").html("<h2>Tidak ada foto</h2>");
		} else {
			$("#foto_rumah").html('<img src="image/foto_rumah/'+foto_rumah+'" style="width: 100%;">');
		}
	}
</script>