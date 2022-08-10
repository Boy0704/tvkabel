
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">ID Pelanggan <?php echo form_error('kd_pelanggan') ?></label>
            <input type="text" class="form-control" name="kd_pelanggan" id="kd_pelanggan" placeholder="Kd Pelanggan" value="<?php echo $kd_pelanggan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Wilayah <?php echo form_error('id_wilayah') ?></label>
            <select class="form-control select2" name="id_wilayah" required>
                <option value="<?php echo $id_wilayah ?>"><?php echo get_data('wilayah','id_wilayah',$id_wilayah,'wilayah'); ?></option>
                <?php foreach ($this->db->get('wilayah')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_wilayah ?>"><?php echo $rw->wilayah ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="int">Rt <?php echo form_error('id_rt') ?></label>
            <select class="form-control select2" name="id_rt" required>
                <option value="<?php echo $id_rt ?>"><?php echo get_data('rt','id_rt',$id_rt,'rt'); ?></option>
                <?php foreach ($this->db->get('rt')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_rt ?>"><?php echo $rw->rt ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="int">Id Rw <?php echo form_error('id_rw') ?></label>
            <select class="form-control select2" name="id_rw" required>
                <option value="<?php echo $id_rw ?>"><?php echo get_data('rw','id_rw',$id_rw,'rw'); ?></option>
                <?php foreach ($this->db->get('rw')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_rw ?>"><?php echo $rw->rw ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Telp <?php echo form_error('telp') ?></label>
            <input type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Biaya Daftar <?php echo form_error('biaya_daftar') ?></label>
            <input type="text" class="form-control" name="biaya_daftar" id="biaya_daftar" placeholder="Biaya Daftar" value="<?php echo $biaya_daftar; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Layanan <?php echo form_error('id_layanan') ?></label>
            <select class="form-control select2" name="id_layanan" required>
                <option value="<?php echo $id_layanan ?>"><?php echo get_data('layanan','id_layanan',$id_rt,'layanan'); ?></option>
                <?php foreach ($this->db->get('layanan')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_layanan ?>"><?php echo $rw->layanan.' | '.$rw->harga ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="year">Tahun Tagihan Aktif <?php echo form_error('tahun_tagihan_aktif') ?></label>
            <select class="form-control select2" name="tahun_tagihan_aktif" required>
                <option value="<?php echo $tahun_tagihan_aktif ?>"><?php echo $tahun_tagihan_aktif ?></option>
                <?php foreach ($this->db->get('tahun')->result() as $rw): ?>
                    <option value="<?php echo $rw->tahun ?>"><?php echo $rw->tahun ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="int">Bulan Tagihan Aktif <?php echo form_error('bulan_tagihan_aktif') ?></label>
            <select class="form-control select2" name="bulan_tagihan_aktif" required>
                <option value="<?php echo $bulan_tagihan_aktif ?>"><?php echo $bulan_tagihan_aktif ?></option>
                <?php 
                for ($i=1; $i <= 12 ; $i++) { 
                    ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php
                }
                 ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Daftar <?php echo form_error('tanggal_daftar') ?></label>
            <input type="date" class="form-control" name="tanggal_daftar" id="tanggal_daftar" placeholder="Tanggal Daftar" value="<?php echo $tanggal_daftar; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Nonaktif</label>
            <input type="date" class="form-control" name="tanggal_nonaktif" id="tanggal_nonaktif" placeholder="Tanggal Nonaktif" value="<?php echo $tanggal_nonaktif; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Aktif <?php echo form_error('aktif') ?></label>
            <select class="form-control select2" name="aktif" required>
                <option value="<?php echo $aktif ?>"><?php echo $aktif ?></option>
                <option value="y">y</option>
                <option value="t">t</option>
            </select>
        </div>
	    <div class="form-group">
            <label for="ket">Keterangan</label>
            <textarea class="form-control" rows="3" name="ket" id="ket" placeholder="Ket"><?php echo $ket; ?></textarea>
        </div>

	    <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pelanggan') ?>" class="btn btn-default">Cancel</a>
	</form>
   