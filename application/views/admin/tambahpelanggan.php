<div class="page-header">
	<h3>Pelanggan Baru</h3>
</div>
<form action="<?php echo base_url().'admin/tambah_pelanggan_act' ?>" method="post">
	<div class="form-group">
		<label>Nama Pelanggan</label>
		<input class="form-control" type="text" name="nama_pelanggan">
		<?php echo form_error('nama_pelanggan'); ?>
	</div>

	<div class="form-group">
		<label>Masukan Password</label>
		<input class="form-control" type="password" name="password">
	</div>

	<div class="form-group">
		<label>Ulangi Masukan Password</label>
		<input class="form-control" type="password" name="repassword">
	</div>

	<div class="form-group">
		<label>Jenis Kelamin</label><br>
		<input type="radio" name="gender" value="Laki-Laki"> Laki-Laki<br>
		<input type="radio" name="gender" value="Perempuan"> Perempuan
	</div>

	<div class="form-group">
		<label>No Telepon</label>
		<input class="form-control" type="text" name="notelp">
	</div>

	<div class="form-group">
		<label>Alamat</label>
		<input class="form-control" type="textarea" name="alamat">
	</div>

	<div class="form-group">
		<label>Email</label>
		<input class="form-control" type="text" name="email">
		<?php echo form_error('email'); ?>
	</div>

	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btnprimary">
	</div>
</div>
</form>