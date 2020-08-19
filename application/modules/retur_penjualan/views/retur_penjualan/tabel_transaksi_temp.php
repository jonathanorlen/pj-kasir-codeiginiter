<style>
  .pull-right {
    cursor:pointer;
  }
</style>
<div class="notif_stok_retur" ></div>
<table id="tabel_daftar" class="table table-bordered table-striped" style="font-size: 1.5em;">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Produk</th>
      <th>Qty</th>
      <th>Qty Retur</th>
      <th>Harga</th>
      <th>Harga Retur</th>
      <th>Diskon (%)</th>
      <th>Subtotal</th>
      <th>Subtotal Retur</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="tabel_temp_data_transaksi">
    <?php
    if($kode){
      $penjualan = $this->db->get_where('opsi_transaksi_penjualan',array('kode_penjualan'=>$kode));
      $list_penjualan = $penjualan->result();
                $nomor = 1; #$total = 0;
                foreach($list_penjualan as $daftar){ 
                  $qty_retur = $this->db->get_where('opsi_transaksi_retur_penjualan_temp',array('kode_penjualan'=>$kode,
                    'kode_produk'=>$daftar->kode_menu));
                  $hasil_qty_retur = $qty_retur->row();

                  ?> 
                  <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $daftar->nama_menu; ?></td>
                    <td align="center"><?php echo $daftar->jumlah; ?></td>
                    <td align="center"><?php echo @$hasil_qty_retur->jumlah; ?></td>
                    <td align="right"><?php echo format_rupiah($daftar->harga_satuan); ?></td>
                    <td align="right"><?php echo format_rupiah(@$hasil_qty_retur->harga_satuan); ?></td>
                    <td align="center"><?php echo $daftar->diskon_item; ?></td>
                    <td align="right"><?php echo format_rupiah($daftar->subtotal); ?></td>
                    <td align="right"><?php echo format_rupiah(@$hasil_qty_retur->subtotal); ?></td>
                    <td id="act"><?php
                      $cek_retur = $this->db->get_where('opsi_transaksi_retur_penjualan_temp',array('kode_penjualan'=>$kode,
                        'kode_produk'=>$daftar->kode_menu));
                      $hasil_cek = $cek_retur->row();
                      if(count($hasil_cek)>0){
                        echo batal_retur($daftar->kode_menu);
                      }else{
                        echo get_retur($daftar->id);
                      }
                      ?></td>
                    </tr>
                    <tr id="tr<?php echo $daftar->id; ?>"  style="display:none" class="detail">
                      <td colspan="10">
                        <span class="closedet pull-right"><strong><h3>X</h3></strong></span><div id="detail<?php echo $daftar->id; ?>" ></div>
                      </td>
                    </tr>
                    <?php 
                  #$total += $daftar->subtotal;
                    $nomor++; 
                  } }
                  ?>

                </tbody>
                <tfoot>
                </tfoot>
              </table>
              <script>

               $(".adetail").click(function(){
                 $(".detail").fadeOut(); 
                 var id = $(this).attr('id');
                 if($("#detail"+id).html()!=""){
                  $("#tr"+id).fadeIn("slow");
                  return;
                }
                var url = "<?php echo base_url().'retur_penjualan/get_form'?>";
                $.ajax({
                  type: "POST",
                  url: url,
                  data: {id:id},
                  success: function(html)
                  {
                    $("#detail"+id).html(html);
                    $("#tr"+id).fadeIn("slow");
                  }
                });	
              });

               $(".batal").click(function(){
                var kode_penjualan = $("#kode_penjualan").val();
                var kode_produk = $(this).attr('id');
                var url = "<?php echo base_url().'retur_penjualan/batal_retur'?>";
                $.ajax({
                  type: "POST",
                  url: "http://admin-pj.cloud-astro.com/reloader/batal_retur",
                  data: {kode_produk:kode_produk,kode_penjualan:kode_penjualan},
                  success: function(html)
                  {
                    
                  }
                });	

                $.ajax({
                  type: "POST",
                  url: url,
                  data: {kode_produk:kode_produk,kode_penjualan:kode_penjualan},
                  success: function(html)
                  {
                    $("#tabel_temp_data_transaksi").load("<?php echo base_url().'retur_penjualan/get_retur_penjualan/'; ?>"+kode_penjualan);
                  }
                }); 
              });


               $(".closedet").click(function(){
                 $(this).parent().parent().closest('tr').fadeOut();
               });

               function actDelete(Object) {
                $('#id-delete').val(Object);
                $('#modal-confirm').modal('show');
              }

              function delData() {
                var id = $('#id-delete').val();
                var kode_penjualan = $('#kode_penjualan').val();
                var url = '<?php echo base_url().'retur_penjualan/hapus_bahan_temp'; ?>/delete';
                $.ajax({
                  type: "POST",
                  url: url,
                  data: {
                    id:id
                  },
                  success: function(msg) {
                    $('#modal-confirm').modal('hide');
                    $("#tabel_temp_data_transaksi").load("<?php echo base_url().'retur_penjualan/get_retur_penjualan/'; ?>"+kode_penjualan);

                  }
                });
                return false;
              }

            </script>
