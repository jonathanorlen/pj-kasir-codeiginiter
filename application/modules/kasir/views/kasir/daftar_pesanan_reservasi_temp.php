<?php
    $kode_reservasi = $this->uri->segment(3);
    if(!empty($kode_reservasi)){
        $edit = $this->uri->segment(4);
        $this->db->group_by('kode_menu');
        $reservasi_temp= $this->db->get_where('opsi_transaksi_reservasi_temp',array('kode_reservasi'=>$kode_reservasi));
    $hasil_temp = $reservasi_temp->result();
        
    }else{
        $reservasi_temp= $this->db->get('opsi_transaksi_reservasi_temp');
    $hasil_temp = $reservasi_temp->result();
    }
    
    
    
?>

<?php $no=1; foreach($hasil_temp as $daftar){ ?>
<tr>
<td><?php echo $no; ?></td>
<td><?php echo @$daftar->nama_menu; ?></td>
<td><?php echo @$daftar->jumlah; ?></td>
<td><?php echo format_rupiah(@$daftar->harga_satuan); ?></td>
<td><?php echo format_rupiah(@$daftar->subtotal); ?></td>
<td><?php echo @$daftar->diskon_item; ?></td>
<td><?php echo get_edit_del_id(@$daftar->id); ?></td>
</tr>
<?php $no++; } ?>
