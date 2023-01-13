<div class="page-header">
	<h3>Data Transaksi Sewa Kamar</h3>
</div>
<a href="<?php echo base_url().'admin/tambah_penyewaan'; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Transaksi Sewa Baru</a>
<br/><br/>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pelanggan</th>
				<th>Nama Kamar</th>
				<th>Nomor Kamar</th>
				<th>Tgl. Check-in</th>
				<th>Tgl. Check-out</th>
				<th>Harga Kamar</th>
				<th>Tgl. Akhir Check-out</th>
				<th>Total Bayar</th>
				<th>Status Kamar</th>
				<th>Status Bayar</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no = 1;
				foreach($penyewaan as $p){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $p->nama_pelanggan; ?></td>
				<td><?php echo $p->nama_kamar; ?></td>
				<td><?php echo $p->no_kamar; ?></td>
				<td><?php echo date('d/m/Y',strtotime($p->tgl_cekin)); ?></td>
				<td><?php echo date('d/m/Y',strtotime($p->tgl_cekout)); ?></td>
				<td><?php echo "Rp. ".number_format($p->extend).",-"; ?></td>
				<td>
					<?php
					if($p->tgl_extend =="0000-00-00"){
						echo "-";
					}else{
						echo date('d/m/Y',strtotime($p->tgl_extend));
					}
					?>
				</td>
				<td><?php echo "Rp. ". number_format($p->total_extend).",-";	?> </td>
				<td>
					<?php
					if($p->status_penyewaan == "1"){
						echo "Checkout";
					}else{
						echo "Belum Checkout";
					}
					?>
				</td>
				<td>
					<?php
					if($p->status_pembayaran == "1"){
						echo "Sudah Bayar";
					}else{ ?>
						<a class="btn btn-sm btn-success" href="<?php echo base_url().'admin/transaksi_selesai/'.$p->id_sewa; ?>"><span class="glyphicon glyphicon-credit-card"></span> Bayar</a>
							<br/>
					<a class="btn btn-sm btn-danger" href="<?php echo base_url().'admin/hapus_penyewaan/'.$p->id_sewa; ?>"><span class="glyphicon glyphicon-remove"></span> Batalkan</a>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
