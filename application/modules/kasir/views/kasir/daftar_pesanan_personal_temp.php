<?php
    $no_meja = $this->uri->segment(3);
    $penjualan_temp= $this->db->get_where('opsi_transaksi_penjualan_temp',array('kode_meja'=>$no_meja,'status'=>'personal'));
    $hasil_temp = $penjualan_temp->result();
    
    
?>

<?php $no=1; foreach($hasil_temp as $daftar){ ?>
<tr>
<td><?php echo $no; ?></td>
<td><?php echo @$daftar->nama_menu; ?></td>
<td align="center"><?php echo @$daftar->jumlah; ?></td>
<td><?php echo format_rupiah(@$daftar->harga_satuan); ?></td>
<td><?php echo format_rupiah(@$daftar->subtotal); ?></td>
<td align="center"><?php echo @$daftar->diskon_item; ?></td>
<td align="center"><?php echo get_edit_del_id(@$daftar->id); ?></td>
</tr>
<?php $no++; } ?>
