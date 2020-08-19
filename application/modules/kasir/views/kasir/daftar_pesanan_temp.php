<?php


#echo "NN".$jml_jual ;

	#	$this->db->group_by('kode_menu');
$dft_order = $this->db->get_where('opsi_transaksi_penjualan_temp',array('kode_kasir'=>@$kode));
$hasil_order = $dft_order->result();
        #echo $this->db->last_query();
$nomor = 1;  
foreach($hasil_order as $daftar){ 
	?> 
	<tr>
		<td><?php echo $nomor; ?></td>
		<td><?php echo @$daftar->nama_menu; ?></td>
		<td align="center"><?php echo @$daftar->jumlah." ".@$daftar->nama_satuan; ?></td>
		<td><?php echo format_rupiah(@$daftar->harga_satuan); ?></td>
		<td><?php echo format_rupiah(@$daftar->subtotal); ?></td>
		<td align="center">
			<?php
			if($daftar->jenis_diskon=='persen'){
				echo @$daftar->diskon_item.' %';
			} else {
				echo format_rupiah(@$daftar->diskon_rupiah);
			}
			
			?>
		</td>
		<td align="center"><?php echo get_del_id(@$daftar->id); ?></td>
	</tr>
	<?php 
	$nomor++; 
} 

?>


