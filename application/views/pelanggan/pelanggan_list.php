<div class="row" style="margin-bottom: 10px">
	<form action="" method="GET">
		<div class="col-md-3">
			<select class="form-control select2" name="id_layanan">
	            <option value="">Semua Layanan</option>
	            <?php foreach ($this->db->get('layanan')->result() as $rw): ?>
	                <option value="<?php echo $rw->id_layanan ?>" <?php echo ( isset($_GET['id_layanan']) AND $_GET['id_layanan'] == $rw->id_layanan ) ? 'selected' : '' ?>><?php echo $rw->layanan ?></option>
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
		</div>
		<div class="col-md-3">
			<select class="form-control select2" name="status">
	            <option value="">Semua Status</option>
	            <option value="y" <?php echo ( isset($_GET['status']) AND $_GET['status'] == 'y' ) ? 'selected' : '' ?>>Aktif</option>
	            <option value="t" <?php echo ( isset($_GET['status']) AND $_GET['status'] == 't' ) ? 'selected' : '' ?>>NonAktif</option>
	        </select>
		</div>
		<div class="col-md-3"><button type="submit" class="btn btn-warning">Cari</button></div>
	</form>
</div>
<hr>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('pelanggan/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <!-- <form action="<?php echo site_url('pelanggan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pelanggan'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form> -->
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px" id="example1">
        	<thead>
            <tr>
                <th>No</th>
		<th>ID Pelanggan</th>
		<th>Foto Rumah</th>
		<th>Nama</th>
		<th>Wilayah</th>
		<th>Rt</th>
		<th>Rw</th>
		<th>Alamat</th>
		<th>Telp</th>
		<th>Biaya Daftar</th>
		<th>Layanan</th>
		<th>Tahun Tagihan Aktif</th>
		<th>Bulan Tagihan Aktif</th>
		<th>Tanggal Daftar</th>
		<th>Tanggal Nonaktif</th>
		<th>Aktif</th>
		<th>Ket</th>
		<th>Created At</th>
		<th>Created By</th>
		<th>Updated At</th>
		<th>Updated By</th>
		<th>Action</th>
            </tr>
            </thead>
            <tbody><?php
            $no = 1;
            if ( isset($_GET['id_layanan']) AND !empty($_GET['id_layanan']) ) {
            	$this->db->where('id_layanan', $this->input->get('id_layanan'));
            }
            if ( isset($_GET['id_wilayah']) AND !empty($_GET['id_wilayah']) ) {
            	$this->db->where('id_wilayah', $this->input->get('id_wilayah'));
            }
            if ( isset($_GET['status']) AND !empty($_GET['status']) ) {
            	$this->db->where('aktif', $this->input->get('status'));
            }
            $pelanggan_data = $this->db->get('pelanggan');
            foreach ($pelanggan_data->result() as $pelanggan)
            {
                ?>
                <tr>
			<td width="80px"><?php echo $no; ?></td>
			<td><?php echo $pelanggan->kd_pelanggan ?></td>
			<td>
				<?php 
				if ($pelanggan->foto_rumah != "") {
					echo '<a class="lihat-gambar btn btn-info btn-xs" onclick="openModal(
					\''.$pelanggan->id_pelanggan.'\',\''.$pelanggan->foto_rumah.'\')">View IMG</a>';
				} else {
					echo  '<a class="lihat-gambar btn btn-danger btn-xs" onclick="openModal(
					\''.$pelanggan->id_pelanggan.'\',\''.$pelanggan->foto_rumah.'\')">No IMG</a>';
				}

				 ?>
			</td>
			<td><?php echo $pelanggan->nama ?></td>
			<td><?php echo get_data('wilayah','id_wilayah',$pelanggan->id_wilayah,'wilayah') ?></td>
			<td><?php echo get_data('rt','id_rt',$pelanggan->id_rt,'rt') ?></td>
			<td><?php echo get_data('rw','id_rw',$pelanggan->id_rw,'rw') ?></td>
			<td><?php echo $pelanggan->alamat ?></td>
			<td><?php echo $pelanggan->telp ?></td>
			<td><?php echo number_format($pelanggan->biaya_daftar) ?></td>
			<td><?php echo get_data('layanan','id_layanan',$pelanggan->id_layanan,'layanan') ?></td>
			<td><?php echo $pelanggan->tahun_tagihan_aktif ?></td>
			<td><?php echo $pelanggan->bulan_tagihan_aktif ?></td>
			<td><?php echo $pelanggan->tanggal_daftar ?></td>
			<td><?php echo $pelanggan->tanggal_nonaktif ?></td>
			<td><?php echo $retVal = ($pelanggan->aktif == 'y') ? '<span class="label label-success">Aktif</span>' : '<span class="label label-danger">NonAktif</span>' ; ?></td>
			<td><?php echo $pelanggan->ket ?></td>
			<td><?php echo $pelanggan->created_at ?></td>
			<td><?php echo get_data('a_user','id_user',$pelanggan->created_by,'nama_lengkap') ?></td>
			<td><?php echo $pelanggan->updated_at ?></td>
			<td><?php echo get_data('a_user','id_user',$pelanggan->updated_by,'nama_lengkap') ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pelanggan/update/'.$pelanggan->id_pelanggan),'<span class="label label-info">Ubah</span>'); 
				echo ' | '; 
				echo anchor(site_url('pelanggan/delete/'.$pelanggan->id_pelanggan),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
                $no++;
            }
            ?>
            </tbody>
        </table>
        </div>
        <!-- <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div> -->

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
      <form action="pelanggan/upload_foto_rumah?<?php echo param_get() ?>" method="POST" enctype="multipart/form-data">
      	<div class="form-group">
      		<input type="hidden" name="id_pelanggan" id="id_pelanggan">
      		<input type="file" name="foto_rumah" accept="image/png, image/gif, image/jpeg" class="form-control">
      	</div>
      	<div class="form-group">
      		<button class="btn btn-primary">Update Foto</button>
      	</div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
	function openModal(id_pelanggan, foto_rumah) {
		$('#modal-default').modal('show');
		$("#id_pelanggan").val(id_pelanggan);
		if (foto_rumah == '') {
			$("#foto_rumah").html("<h2>Tidak ada foto</h2>");
		} else {
			$("#foto_rumah").html('<img src="image/foto_rumah/'+foto_rumah+'" style="width: 100%;">');
		}
	}
</script>