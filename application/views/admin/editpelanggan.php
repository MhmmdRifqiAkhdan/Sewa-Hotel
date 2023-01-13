<div class="page-header">
	<h3>Ubah Pelanggan</h3>
</div>
<?php foreach($pelanggan as $p){ ?>
<form action="<?php echo base_url().'admin/update_pelanggan' ?>" method="post">
	<div class="form-group">
		<label>Nama Pelanggan</label>
		<input type="hidden" name="id" value="<?php echo $p->id_pelanggan; ?>">
		<input class="form-control" type="text" name="nama_pelanggan" value="<?php echo $p->nama_pelanggan; ?>">
		<?php echo form_error('nama_pelanggan'); ?>
	</div>

	<div class="form-group">
		<label>Jenis Kelamin</label>
		<input class="form-control" type="text" name="gender" value="<?php echo $p->gender; ?>">
		<?php echo form_error('gender'); ?>
	</div>

	<div class="form-group">
		<label>No Telepon</label>
		<input class="form-control" type="text" name="notelp" value="<?php echo $p->no_telp; ?>">
		<?php echo form_error('notelp'); ?>
	</div>

	<div class="form-group">
		<label>Alamat</label>
		<input class="form-control" type="text" name="alamat" value="<?php echo $p->alamat; ?>">
		<?php echo form_error('alamat'); ?>
	</div>

	<div class="form-group">
		<label>Email</label>
		<input class="form-control" type="text" name="email" value="<?php echo $p->email; ?>" >
		<?php echo form_error('email'); ?>
	</div>

	<div class="form-group">
		<input type="submit" value="Perbaharui" class="btn btnprimary">
	</div>
</form>
<?php } ?>