<div class="page-header">
	<h3>Kamar Baru</h3>
</div>
<?= validation_errors('<p style="color:red;">','</p>'); ?>
<?php
if($this->session->flashdata())
	{
		echo "<div class='alert alert-danger alert-message'>";
		echo $this->session->flashdata('alert');
		echo "</div>";
	}
?>
<form action="<?php echo base_url().'admin/tambah_kamar_act' ?>" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label>Tipe Kamar</label>
		<select name="id_tipe" class="form-control">
			<option value="">-Pilih Tipe Kamar-</option>
			<?php foreach($tipekamar as $t){ ?>
			<option value="<?php echo $t->id_tipe; ?>"><?php echo $t->tipe_kamar; ?></option>
			<?php } ?>
		</select>
		<?php echo form_error('id_tipe'); ?>
	</div>

	<div class="form-group">
		<label>Nama Kamar</label>
		<input type="text" name="nama_kamar" class="form-control">
		<?php echo form_error('nama_kamar'); ?>
	</div>

	<div class="form-group">
		<label>Nomor Kamar</label>
		<input type="text" name="no_kamar" class="form-control">
	</div>

	<div class="form-group">
		<label>Tipe Kasur</label>
		<select name="tipe_kasur" class="form-control">
			<option value="">-Pilih Tipe Kasur-</option>
			<option value="Single Bed">Single Bed</option>
			<option value="Twin Bed">Twin Bed</option>
			<option value="Double Bed">Double Bed</option>
		</select>
	</div>

	<div class="form-group">
		<label>Harga Kamar</label>
		<input type="text" name="harga_kamar" class="form-control">
	</div>

	<div class="form-group">
		<label>Lokasi</label>
		<select name="lokasi" class="form-control">
			<option value="">-Pilih Lokasi Kamar-</option>
			<option value="Lantai 1">Lantai 1</option>
			<option value="Lantai 2">Lantai 2</option>
			<option value="Lantai 3">Lantai 3</option>
		</select>
	</div>

	<div class="form-group">
		<label>Status Kamar</label>
		<select name="status_kamar" class="form-control">
			<option value="1">Tersedia</option>
			<option value="0">Isi</option>
		</select>
		<?php echo form_error('status_kamar'); ?>
	</div>

	<div class="form-group">
		<label>Foto Kamar</label>
		<input name="fotokamar" type="file" class="form-control">	
	</div>
	
	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btnprimary">
	</div>
</div>
</form>