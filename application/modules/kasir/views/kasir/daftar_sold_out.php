<?php
    
    $sold_out= $this->db->get_where('master_menu',array('status'=>'0'));
    $hasil_sold_out = $sold_out->result();
    
    
?>

<?php $no=1; foreach($hasil_sold_out as $daftar){ ?>
<tr>
<td><?php echo $no; ?></td>
<td><?php echo @$daftar->kode_menu; ?></td>
<td><?php echo @$daftar->nama_menu; ?></td>
<td><?php echo @$daftar->kategori_menu; ?></td>
<td><?php echo @$daftar->status_menu; ?></td>
<td><?php echo format_rupiah(@$daftar->hpp); ?></td>
<td><?php echo format_rupiah(@$daftar->harga_jual); ?></td>
<td>
    <div class="btn-group">
    <a style="padding:3.5px;" onclick="tersedia('<?php echo @$daftar->kode_menu ?>')" data-toggle="tooltip" title="Hapus" class="btn btn-small btn-danger"><i class="fa fa-trash"> Hapus</i></a>
    </div>
</td>
</tr>
<?php $no++; } ?>