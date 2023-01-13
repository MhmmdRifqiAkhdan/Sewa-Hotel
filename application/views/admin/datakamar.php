<div class="page-header">
	<h3>Data Kamar</h3>
</div>
<a href="<?php echo base_url().'admin/tambah_kamar'; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Kamar Baru</a>
<br/><br/>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Foto Kamar</th>
				<th>Nama Kamar</th>
				<th>No. Kamar</th>
				<th>Tipe Kasur</th>
				<th>Harga Kamar</th>
				<th>Lokasi</th>
				<th>Status Kamar</th>
				<th>Ubah/Hapus</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no = 1;
				foreach($kamar as $k){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><img src="<?php echo base_url().'/assets/upload/'.$k->gambar; ?>" width="100" height="70" alt="gambar tidak tersedia"></td>
				<td><?php echo $k->nama_kamar ?></td>
				<td><?php echo $k->no_kamar ?></td>
				<td><?php echo $k->tipe_kasur ?></td>
				<td><?php echo "Rp. ".number_format($k->harga_kamar).",-" ?></td>
				<td><?php echo $k->lokasi ?></td>
				<td>
					<?php
						if($k->status_kamar == "1"){
							echo "Tersedia";
						}else if($k->status_kamar == "0"){
							echo "Isi";
						}
					?>
				</td>
				<td nowrap="nowrap">
					<a class="btn btn-primary btn-xs" href="<?php echo base_url().'admin/edit_kamar/'.$k->id_kamar; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
					<a class="btn btn-warning btn-xs" href="<?php echo base_url().'admin/hapus_kamar/'.$k->id_kamar; ?>"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>