
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Layanan <?php echo form_error('layanan') ?></label>
            <input type="text" class="form-control" name="layanan" id="layanan" placeholder="Layanan" value="<?php echo $layanan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Harga <?php echo form_error('harga') ?></label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
        </div>
	    <input type="hidden" name="id_layanan" value="<?php echo $id_layanan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('layanan') ?>" class="btn btn-default">Cancel</a>
	</form>
   