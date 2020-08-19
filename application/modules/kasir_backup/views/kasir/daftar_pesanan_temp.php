<?php
if(@$kode){
	$order = $this->db->get_where('opsi_transaksi_penjualan_temp',array('kode_meja'=>$kode,'status !='=>'personal'));
	$list_order = $order->row();
    
	$jual = $this->db->get_where('opsi_transaksi_penjualan_temp',array('kode_penjualan'=>@$list_order->kode_penjualan,
		'status_meja'=>'digabung','kode_meja'=>$kode));
	$hasil_jual = $jual->result();
    #echo $this->db->last_query();
	$jml_jual = count($hasil_jual);
#echo "NN".$jml_jual ;
	if($jml_jual >=1){
			$this->db->group_by('kode_menu');
	    $dft_order = $this->db->get_where('opsi_transaksi_penjualan_temp',array('kode_penjualan'=>@$list_order->kode_penjualan,
	    'status !='=>'personal','status_meja'=>'digabung'));
	    $hasil_order = $dft_order->result();
        echo $this->db->last_query();
		$nomor = 1;  
		foreach($hasil_order as $daftar){ 
			?> 
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo @$daftar->nama_menu; ?></td>
				<td align="center"><?php echo @$daftar->jumlah; ?></td>
				<td><?php echo format_rupiah(@$daftar->harga_satuan); ?></td>
				<td><?php echo format_rupiah(@$daftar->subtotal); ?></td>
				<td align="center"><?php echo @$daftar->diskon_item; ?></td>
				<td align="center"><?php echo get_del_id(@$daftar->id); ?></td>
			</tr>
			<?php 
			$nomor++; 
		} }
		 else{
			$this->db->group_by('kode_menu');
	    $dft_order = $this->db->get_where('opsi_transaksi_penjualan_temp',array('kode_penjualan'=>@$list_order->kode_penjualan,
	    'status !='=>'personal','kode_meja'=>$kode));
	    $hasil_order = $dft_order->result();
        #echo $this->db->last_query();
		$nomor = 1;  
		foreach($hasil_order as $daftar){ 
			?> 
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo @$daftar->nama_menu; ?></td>
				<td align="center"><?php echo @$daftar->jumlah; ?></td>
				<td><?php echo format_rupiah(@$daftar->harga_satuan); ?></td>
				<td><?php echo format_rupiah(@$daftar->subtotal); ?></td>
				<td align="center"><?php echo @$daftar->diskon_item; ?></td>
				<td align="center"><?php echo get_del_id(@$daftar->id); ?></td>
			</tr>
			<?php 
			$nomor++; 
		} } }
		?>
	

    