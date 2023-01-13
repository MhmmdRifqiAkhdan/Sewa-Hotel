<div class="page-header">
	<h3>Ubah Password</h3>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php
			if(isset($_GET['pesan'])){
				if($_GET['pesan'] == "berhasil"){
					echo "<div class='alert alert-success'>Password berhasil di ubah.</div>";
				}
			}
		?>
		<form action="<?php echo base_url().'admin/ganti_password_act'; ?>" method="post">
			<div class="form-group">
				<label>Masukan Password Baru</label>
				<input class="form-control" type="password" name="pass_baru">
				<?php echo form_error('pass_baru'); ?>
			</div>

			<div class="form-group">
				<label>Ulangi Masukan Password Baru</label>
				<input class="form-control" type="password" name="ulang_pass">
				<?php echo form_error('ulang_pass'); ?>
			</div>

			<div class="form-group">
				<input class="btn btn-primary btn-sm" type="submit" value="Ubah">
			</div>
		</form>
	</div>
</div>