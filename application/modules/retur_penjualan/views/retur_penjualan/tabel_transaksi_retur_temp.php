
<?php
if($kode){
  $order = $this->db->get_where('opsi_transaksi_retur_penjualan_temp',array('kode_retur'=>$kode));
  $list_order = $order->result();
  $nomor = 1;  

  foreach($list_order as $daftar){ 
    ?> 
    <tr>
      <td><?php echo $nomor; ?></td>
      <td><?php echo $daftar->nama_produk; ?></td>
      <td align="center"><?php echo $daftar->jumlah; ?></td>
      <td align="center"><?php echo $daftar->jumlah_konversi; ?></td>
      <td align="center"><?php echo round($daftar->jumlah_konversi/$daftar->jumlah,2); ?></td>
      <td align="right"><?php echo format_rupiah($daftar->harga_satuan); ?></td>
      <td align="center"><?php echo $daftar->diskon_item; ?></td>
      <td align="right"><?php echo format_rupiah($daftar->subtotal); ?></td>
      <td align="center"><?php echo get_edit_del_id_retur($daftar->id); ?></td>
    </tr>
    <?php 
    $nomor++; 
  } }
  ?>
