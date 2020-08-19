<?php
if(@$id){
  $get_produk = $this->db->get_where('opsi_transaksi_penjualan',array('id'=>$id));
  $hasil_get = $get_produk->row();
}
?>

<div class="box-body">
  <div class="row">
    <div class="col-md-12">

      <div class="col-md-2">
        <label>Nama Produk</label>
        <input type="hidden" name="id_item" id="id_item" value="<?php echo $hasil_get->id; ?>"/>
        <input readonly="true" type="text" class="form-control" value="<?php echo $hasil_get->nama_menu; ?>" placeholder="QTY" name="nama_menu" id="nama_menu" />
        <input type="hidden" class="form-control" value="<?php echo $hasil_get->kode_menu; ?>" name="kode_menu" id="kode_menu" />
        <input type="hidden" class="form-control" value="<?php echo $hasil_get->kode_penjualan; ?>" name="kode_penjualan" id="kode_penjualan" />
      </div>

      <div class="col-md-2">
        <label>Qty yang diretur</label>
        <input type="text" class="form-control" placeholder="QTY" name="jumlah" id="jumlah" value="<?php echo @$hasil_get->jumlah; ?>"/>
      </div>
      
      <div style="margin-top: 25px;" class="col-md-2">
        <a href="#" onclick="update_item()" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</a>
      </div>

    </div>
  </div>
</div>
<script>
  $(".tgl").datepicker();

  function update_item(){
    var kode_penjualan = $("#kode_penjualan").val();
    var kode_menu = $("#kode_menu").val();
    var nama_menu = $("#nama_menu").val();
    var jumlah = $("#jumlah").val();
    var jumlah_konversi = $("#jumlah_konversi").val();
    var harga_satuan = $("#harga_satuan").val();
    var diskon_item = $("#diskon_item").val();
    var id_item = $("#id_item").val();
    var kode_retur = $("#kode_retur").val();
    var kode_kasir = $("#kode_kasir").val();
    var url = "<?php echo base_url().'retur_penjualan/update_item_temp'?> ";

    $.ajax({
      type: "POST",
      url: "http://admin-pj.cloud-astro.com/reloader/update_item_temp_retur",
      data: { kode_menu:kode_menu,
        nama_menu:nama_menu,
        jumlah:jumlah,kode_penjualan:kode_penjualan,
        jumlah_konversi:jumlah_konversi,
        harga_satuan:harga_satuan,
        diskon_item:diskon_item,kode_retur:kode_retur,
        kode_kasir:kode_kasir,
        id:id_item
      },
      success: function(data)
      {
       alert("Berhasil Mengunggah Online"); 
     }
   });

    $.ajax({
      type: "POST",
      url: url,
      data: { kode_menu:kode_menu,
        nama_menu:nama_menu,
        jumlah:jumlah,kode_penjualan:kode_penjualan,
        jumlah_konversi:jumlah_konversi,
        harga_satuan:harga_satuan,
        diskon_item:diskon_item,kode_retur:kode_retur,
        kode_kasir:kode_kasir,
        id:id_item
      },
      success: function(data)
      {
        if(data == 'tidak cukup'){
          $(".notif_stok_retur").html('<div class="alert alert-warning">Stok yang di retur Melebihi quantity produk</div>');
          setTimeout(function(){
            $('.notif_stok_retur').html('');
          },1700);              
        }else{
          $(".detail").fadeOut();
          $("#tabel_temp_data_transaksi").load("<?php echo base_url().'retur_penjualan/get_retur_penjualan/'; ?>"+kode_penjualan);
        }
        
      }
    });

  }

</script>