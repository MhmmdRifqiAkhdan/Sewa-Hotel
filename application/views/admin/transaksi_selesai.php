<div class="page-header">
	<h3>Transaksi Sewa Selesai</h3>
</div>
<?php foreach($penyewaan as $p){ ?>
<form action="<?php echo base_url().'admin/transaksi_selesai_act' ?>" method="post">
	<input type="hidden" name="id" value="<?php echo $p->id_sewa ?>">
	<input type="hidden" name="kamar" value="<?php echo $p->id_kamar ?>">
	<input type="hidden" name="tgl_cekout" value="<?php echo $p->tgl_cekout ?>">
	<input type="hidden" name="tgl_cekin" value="<?php echo $p->tgl_cekin ?>">
	<input type="hidden" name="extend" value="<?php echo $p->extend ?>">
	<div class="form-group">
		<label>Nama Pelanggan</label>
		<select class="form-control" name="pelanggan" disabled>
			<option value="">-Pilih Nama Pelanggan-</option>
			<?php foreach($pelanggan as $k){ ?>
				<option <?php if($p->id_pelanggan == $k->id_pelanggan){echo "selected='selected'";} ?> value="<?php echo $k->id_pelanggan; ?>"><?php echo $k->nama_pelanggan; ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label>Nama Kamar</label>
		<select class="form-control" name="kamar" disabled>
			<option value="">-Pilih Nama Kamar-</option>
			<?php foreach($kamar as $m){ ?>
			<option <?php if($p->id_kamar == $m->id_kamar){echo "selected='selected'";} ?> value="<?php echo $m->id_kamar; ?>"><?php echo $m->nama_kamar; ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label>Tanggal Check-in</label>
		<input class="form-control" type="date" name="tgl_cekin" value="<?php echo $p->tgl_cekin ?>" disabled>
	</div>

	<div class="form-group">
		<label>Tanggal Check-out</label>
		<input class="form-control" type="date" name="tgl_cekout" value="<?php echo $p->tgl_cekout ?>" disabled>
	</div>

	<div class="form-group">
		<label>Harga Sewa Kamar per Hari</label>
			<input class="form-control" type="text" name="extend" value="<?php echo $p->extend ?>" disabled>
	</div>

	<div class="form-group">
		<label>Tanggal Akhir Check-out</label>
		<input class="form-control" type="date" name="tgl_akhir">
		<?php echo form_error('tgl_akhir'); ?>
	</div>
	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btnprimary btn-sm">
	</div>
</form>
<?php } ?>