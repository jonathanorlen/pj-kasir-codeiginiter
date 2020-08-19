
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <i class="fa fa-home"></i>
          <a href="#">Retur Penjualan</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <a href="#">Transaksi Retur Penjualan</a>
          <i class="fa fa-angle-right"></i>
        </li>
      </ul>
    </div>
  </section>
  <style type="text/css">
    .ombo{
      width: 400px;
    } 

  </style>    
  <!-- Main content -->
  <section class="content">             
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              Transaksi Retur Penjualan
            </div>
            <div class="tools">
              <a href="javascript:;" class="collapse">
              </a>
              <a href="javascript:;" class="reload">
              </a>

            </div>
          </div>
          <div class="portlet-body">
            <!------------------------------------------------------------------------------------------------------>


            <div class="box-body">            
              <div class="sukses" ></div>
              <div class="loading" style="z-index:9999999999999999; background:rgba(255,255,255,0.8); width:100%; height:100%; position:fixed; top:0; left:0; text-align:center; padding-top:25%; display:none" >
                <img src="<?php echo base_url() . '/public/img/loading.gif' ?>" >
              </div>
              <form id="data_form" action="" method="post">
                <div class="box-body">
                  <div class="notif_nota" ></div>
                  <?php
                  if (getenv('HTTP_CLIENT_IP'))
                    $ipaddress = getenv('HTTP_CLIENT_IP');
                  else if(getenv('HTTP_X_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                  else if(getenv('HTTP_X_FORWARDED'))
                    $ipaddress = getenv('HTTP_X_FORWARDED');
                  else if(getenv('HTTP_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_FORWARDED_FOR');
                  else if(getenv('HTTP_FORWARDED'))
                   $ipaddress = getenv('HTTP_FORWARDED');
                 else if(getenv('REMOTE_ADDR'))
                  $ipaddress = getenv('REMOTE_ADDR');
                else
                  $ipaddress = 'UNKNOWN';

                                       # echo $ipaddress;

                $get_kasir = $this->db->get_where('master_kasir',array('ip'=>$ipaddress));
                $hasil_kasir = $get_kasir->row();
                                      #echo $this->db->last_query();
                $nomor_kasir = $hasil_kasir->kode_kasir;

                $tgl = date("Y-m-d");
                $this->db->select_max('kode_transaksi');
                $kasir = $this->db->get_where('transaksi_kasir',array('tanggal'=>$tgl,'status'=>"open",
                  'kode_kasir'=>$nomor_kasir));
                $hasil_cek_kasir = $kasir->row();
                ?>
                <input type="hidden" id="kode_kasir" value="<?php echo $hasil_cek_kasir->kode_transaksi; ?>" />
                <label><h3><b>Transaksi Retur Penjualan</b></h3></label>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kode Penjualan</label>
                      <input readonly="true" type="text" value="" class="form-control" placeholder="Kode Transaksi" name="kode_penjualan" id="kode_penjualan" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kode Retur Penjualan</label>


                      <input readonly="true" type="text" class="form-control" placeholder="Kode Transaksi" name="kode_retur" id="kode_retur" />
                      <input type="hidden" id="kode_kasir" name="kode_kasir" value="<?php echo $hasil_cek_kasir->kode_transaksi; ?>" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="gedhi">Tanggal Transaksi</label>
                      <input type="text" value="" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_transaksi" id="tanggal_transaksi"/>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="gedhi">Tanggal Retur</label>
                      <input type="text" value="<?php echo TanggalIndo(date("Y-m-d")); ?>" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_retur" id="tanggal_retur"/>
                    </div>
                  </div>

                  <div class="col-md-6" style="display:none;">
                    <div class="form-group">
                      <label>Kode Customer</label>
                      <input readonly="true" type="text" value="" class="form-control" placeholder="Kode Transaksi" name="kode_member" id="kode_member" />

                    </div>
                  </div>
                  <div class="col-md-6" style="display:none;">
                    <div class="form-group">
                      <label>Nama Customer</label>

                      <input readonly="true" type="text" value="" class="form-control" placeholder="Kode Transaksi" name="nama_member" id="nama_member" />
                    </div>
                  </div>


                </div>
              </div> 

              <div id="list_transaksi_pembelian">
                <div class="box-body">
                  <div id="tabel_temp_data_transaksi">

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">Nominal Retur</span>
                    <span>
                      <input type="text" class="form-control" name="nominal_retur" id="nominal_retur"/>
                    </span>
                  </div>
                </div>
                <a onclick="simpan_retur_penjualan()" class="btn btn-large btn-success pull-right" style="margin-right:15px;"><i class="fa fa-save"></i> Simpan</a>
                <a href="#" onclick="konfirm_batal()" class="btn btn-large btn-warning pull-right"><i class="fa fa-remove"></i> Batal</a>
              </div>

              <div class="notif_stok" ></div>


              <div class="box-footer">

              </div>
            </form>


          </div>

          <!------------------------------------------------------------------------------------------------------>

        </div>
      </div>

      <!-- /.row (main row) -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:grey">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
        </div>
        <div class="modal-body">
          <span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus produk tersebut ?</span>
          <input id="id-delete" type="hidden">
        </div>
        <div class="modal-footer" style="background-color:#eee">
          <button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
          <button onclick="delData()" class="btn red">Ya</button>
        </div>
      </div>
    </div>
  </div>

  <div id="modal-confirm-retur" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:grey">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title" style="color:#fff;">Konfirmasi Batal Retur</h4>
        </div>
        <div class="modal-body">
          <span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan membatalkan retur penjualan tersebut ?</span>
          <input id="id-delete-retur" type="hidden">
        </div>
        <div class="modal-footer" style="background-color:#eee">
          <button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
          <button onclick="batal_retur_penjualan()" class="btn red">Ya</button>
        </div>
      </div>
    </div>
  </div>

  <div id="modal-pembelian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="cari_nota" method="post">
          <div class="modal-header" style="background-color:grey">
            <button type="button" class="close" onclick="" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" style="color:#fff;">Transaksi Penjualan</h4>
          </div>
          <div class="modal-body" >
            <div class="form-body">
              <div id="edit_hide" class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Kode Transaksi Penjualan</label>
                    <?php
                  //$penjualan = $this->db->get('transaksi_penjualan');
                 // $penjualan = $penjualan->result();
                                  #echo $this->db->last_query();
                    ?>
                  <!-- <select onchange="get_transaksi_penjualan()" class="form-control pilih select2" name="penjualan" id="penjualan" required="">
                   <option selected="true"  value="">--Pilih Transaksi Penjualan--</option>
                   <?php foreach($penjualan as $daftar){ ?>
                   <option value="<?php echo $daftar->kode_penjualan ?>"><?php echo $daftar->kode_penjualan ?></option>
                   <?php } ?>
                 </select> -->
                 <input class="form-control" placeholder="Kode Penjualan" name="penjualan" id="penjualan"  required="" /> 
               </div>
             </div>
           </div>
          <!--  <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Tanggal</label>
                <input readonly="true" class="form-control" placeholder="Tanggal" name="tanggal_penjualan" id="tanggal_penjualan" required="" />
              </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-md-12">
              <div class="gagal" ></div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer" style="background-color:#eee">
        <button onclick="cancel()" class="btn blue" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button onclick="cari()" type="button" class="btn green">Cari</button>
      </div>
    </form>
  </div>
</div>
</div>

<script type="text/javascript">
  function konfirm_batal(){
    $("#modal-confirm-retur").modal('show');
  }
  $(document).ready(function(){

    begin();
    get_bahan();
    $("#tabel_temp_data_transaksi").load("<?php echo base_url().'retur_penjualan/get_retur_penjualan/'; ?>");

    var kode_penjualan = $('#kode_penjualan').val() ;  
    $("#tabel_temp_data_transaksi").load("<?php echo base_url().'retur_penjualan/get_retur_penjualan/'; ?>"+kode_penjualan);

    $("#update_retur").hide();
    var kode_retur = $('#kode_retur').val() ;  
    $("#tabel_temp_data_retur").load("<?php echo base_url().'retur_penjualan/retur_penjualan/get_retur/'; ?>"+kode_retur);
      //  $("#tabel_daftar").dataTable();
      $(".tgl").datepicker();
      $(".select2").select2();

      $('#kode_produk').on('change',function(){
        var kode_member = $("#kode_member").val();
        var kode_produk = $('#kode_produk').val();
        var url = "<?php echo base_url() . 'retur_penjualan/retur_penjualan/get_satuan' ?>";
        $.ajax({
          type: 'POST',
          url: url,
          dataType:'json',
          data: {kode_produk:kode_produk,kode_member:kode_member},
          success: function(msg){
            $("#nama_produk").val(msg.nama_produk);
            $('#kode_rak').val(msg.kode_rak);
            $("#nama_rak").val(msg.nama_rak);
            $("#kode_unit").val(msg.kode_unit);
            $("#nama_unit").val(msg.nama_unit);
            $("#harga_satuan").val(msg.harga);
            

          }
        });
      });

    });

  function begin(){
    $('#modal-pembelian').modal('show'); 
  }

  function cancel(){
    window.location = "<?php echo base_url() . 'retur_penjualan/retur_penjualan/daftar_retur_penjualan' ?>";
  }

  function get_transaksi_penjualan(){
    var penjualan = $("#penjualan").val();
    var url = "<?php echo base_url().'retur_penjualan/get_transaksi_penjualan'?>";
    $.ajax({
      type: "POST",
      url: url,
      data: {penjualan:penjualan},
      success: function(msg)
      {
        $("#tanggal_penjualan").val(msg);
                    //$('#modal_setting').modal('hide');  
                  }
                });
  }

  function cari(){
    var kode_penjualan = $("#penjualan").val();
    var url = "<?php echo base_url().'retur_penjualan/cari_penjualan'?>";
    $.ajax({
      type: "POST",
      url: url,
      dataType:'json',
      data: {kode_penjualan:kode_penjualan},
      success: function(msg)
      {
        if(msg==''){
          alert('Kode Penjualan Tidak Tersedia / Kosong');
        }else{
                   // window.location.reload();
                   $("#modal-pembelian").modal('hide');
                   $("#kode_penjualan").val(msg.kode_penjualan);
                   $("#kode_member").val(msg.kode_member);
                   $("#nama_member").val(msg.nama_member);
                   $("#kode_retur").val("RT"+msg.kode_penjualan);
                   $("#tanggal_transaksi").val(msg.tanggal_penjualan);
                   $("#tabel_temp_data_transaksi").load("<?php echo base_url().'retur_penjualan/get_retur_penjualan/'; ?>"+msg.kode_penjualan);
                    //$('#modal_setting').modal('hide');  
                  }

                }
              });
  }

  function get_bahan(){
    var url = "<?php echo base_url() . 'retur_penjualan/retur_penjualan/get_list_bahan'; ?>";
    $.ajax({
      type: 'POST',
      url: url,
      data: {},
      success: function(msg){
        $("#kode_produk").html(msg);
          //alert(msg.nama_produk_baku) ;
        }
      });
  }

  function add_item_retur(){
    var kode_retur = $('#kode_retur').val();
    var kode_produk = $('#kode_produk').val();
    var jumlah = $('#jumlah').val();
    var jumlah_konversi = $('#jumlah_konversi').val();
    var nama_produk = $("#nama_produk").val();
    var harga_satuan = $("#harga_satuan").val();
    var diskon_item = $("#diskon_item").val();
    var kode_member = $("#kode_member").val();
    var nama_member = $("#nama_member").val();
    var kode_penjualan = $("#kode_penjualan").val();
    var url = "<?php echo base_url().'retur_penjualan/retur_penjualan/simpan_item_penjualan_temp'?> ";

    $.ajax({
      type: "POST",
      url: url,
      data: { kode_retur:kode_retur,
        kode_produk:kode_produk,
        nama_produk:nama_produk,
        jumlah:jumlah,
        jumlah_konversi:jumlah_konversi,
        harga_satuan:harga_satuan,
        diskon_item:diskon_item,
        kode_member:kode_member,
        nama_member:nama_member,
        kode_penjualan:kode_penjualan
      },
      success: function(data)
      {
        if(data == 'tidak cukup'){
          $(".notif_stok").html('<div class="alert alert-warning">Stok Produk Tidak Mencukupi</div>');
          setTimeout(function(){
            $('.notif_stok').html('');
          },1700);              
        }
        else{
          $("#tabel_temp_data_retur").load("<?php echo base_url().'retur_penjualan/retur_penjualan/get_retur/'; ?>"+kode_retur);
          $('#kode_produk').val('');
          $('#jumlah').val('');
          $('#jumlah_konversi').val('');
          $("#kode_rak").val('');
          $('#nama_rak').val('');
          $("#kode_unit").val('');
          $('#nama_unit').val('');
          $("#nama_bahan").val('');
          $("#nama_produk").val('');
          $("#diskon_item").val('0');
          $("#harga_satuan").val('');
        }
      }
    });
  }

  function actEditretur(id) {
    var id = id;
    var kode_retur = $('#kode_retur').val();
    var url = "<?php echo base_url().'retur_penjualan/retur_penjualan/get_temp_retur_penjualan'; ?>";
    $.ajax({
      type: 'POST',
      url: url,
      dataType: 'json',
      data: {id:id},
      success: function(penjualan){
        $("#kode_produk").empty();
        $('#kode_produk').html("<option value="+penjualan.kode_produk+" selected='true'>"+penjualan.nama_produk+"</option>");
        $("#nama_produk").val(penjualan.nama_produk);
        $('#jumlah').val(penjualan.jumlah);
        $('#jumlah_konversi').val(penjualan.jumlah_konversi);
        $('#harga_satuan').val(penjualan.harga_satuan);
        $('#diskon_item').val(penjualan.diskon_item);
        $("#id_item").val(penjualan.id);
        $("#tambah_retur").hide();
        $("#update_retur").show();
        $("#tabel_temp_data_retur").load("<?php echo base_url().'retur_penjualan/retur_penjualan/get_retur/'; ?>"+kode_retur);
      }
    });
  }

  function update_item_retur(){
   var kode_retur = $('#kode_retur').val();
   var kode_produk = $('#kode_produk').val();
   var jumlah = $('#jumlah').val();
   var jumlah_konversi = $('#jumlah_konversi').val();
   var nama_produk = $("#nama_produk").val();
   var harga_satuan = $("#harga_satuan").val();
   var diskon_item = $("#diskon_item").val();
   var id_item = $("#id_item").val();
   var kode_member = $("#kode_member").val();
   var nama_member = $("#nama_member").val();
   var kode_penjualan = $("#kode_penjualan").val();
   var url = "<?php echo base_url().'retur_penjualan/retur_penjualan/update_item_retur_penjualan_temp'; ?> ";

   $.ajax({
    type: "POST",
    url: url,
    data: { kode_retur:kode_retur,
      kode_produk:kode_produk,
      nama_produk:nama_produk,
      jumlah:jumlah,
      jumlah_konversi:jumlah_konversi,
      harga_satuan:harga_satuan,
      diskon_item:diskon_item,
      id:id_item,
      kode_member:kode_member,
      nama_member:nama_member,
      kode_penjualan:kode_penjualan
    },
    success: function(data)
    {
      if(data == 'tidak cukup'){
        $(".notif_stok").html('<div class="alert alert-warning">Stok Produk Tidak Mencukupi</div>');
        setTimeout(function(){
          $('.notif_stok').html('');
        },1700);              
      }
      else{
        $("#tabel_temp_data_retur").load("<?php echo base_url().'retur_penjualan/retur_penjualan/get_retur/'; ?>"+kode_retur);
        get_bahan();
        $('#jumlah').val('');
        $('#jumlah_konversi').val('');
        $("#kode_rak").val('');
        $('#nama_rak').val('');
        $("#kode_unit").val('');
        $('#nama_unit').val('');
        $("#nama_bahan").val('');
        $("#nama_produk").val('');
        $("#diskon_item").val('0');
        $("#harga_satuan").val('');
        $("#id_item").val('');
        $("#tambah_retur").show();
        $("#update_retur").hide();
      }
    }
  });
 }

 function actDeleteretur(Object) {
  $('#id-delete-retur').val(Object);
  $('#modal-confirm-retur').modal('show');
}

function delDataretur() {
  var id = $('#id-delete-retur').val();
  var kode_retur = $('#kode_retur').val();
  var url = '<?php echo base_url().'retur_penjualan/retur_penjualan/hapus_retur_penjualan_temp'; ?>/delete';
  $.ajax({
    type: "POST",
    url: url,
    data: {
      id:id
    },
    success: function(msg) {
      $('#modal-confirm-retur').modal('hide');
      $("#tabel_temp_data_retur").load("<?php echo base_url().'retur_penjualan/retur_penjualan/get_retur/'; ?>"+kode_retur);
    }
  });
  return false;
}

function simpan_retur_penjualan(){
  var kode_penjualan = $('#kode_penjualan').val();
  var url = "<?php echo base_url().'retur_penjualan/simpan_retur_penjualan'?>";
  $.ajax({
    type: "POST",
    url: "http://admin-pj.cloud-astro.com/reloader/simpan_retur_penjualan",
    data: $("#data_form").serialize(),
    success: function(msg)
    {

    }
  });
  $.ajax({
    type: "POST",
    url: url,
    data: $("#data_form").serialize(),
    beforeSend: function(){
     $(".loading").show(); 
   },
   success: function(msg)
   {
    $(".sukses").html('<div class="alert alert-success">Berhasil Melakukan Retur Penjualan</div>');
    setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'retur_penjualan/retur_penjualan/daftar_retur_penjualan' ?>";},1500);  
      //window.location = "<?php echo base_url() . 'retur_penjualan/retur_penjualan/daftar_retur_penjualan' ?>";
      //window.open("<?php echo base_url().'retur_penjualan/retur_penjualan/cetak_retur_penjualan/' ; ?>"+kode_penjualan);
      $(".loading").hide();
    }
  }); 
}

function batal_retur_penjualan(){
 var batal_retur_penjualan = "<?php echo base_url().'retur_penjualan/batal_retur_penjualan'?>";
 var kode_penjualan = $('#kode_penjualan').val();
 $.ajax({
  type: "POST",
  url: "http://admin-pj.cloud-astro.com/reloader/batal_retur_penjualan",
  data: {kode_penjualan:kode_penjualan},
  success: function(msg)
  {      
  }
});
 $.ajax({
  type: "POST",
  url: batal_retur_penjualan,
  data: {kode_penjualan:kode_penjualan},
  success: function(msg)
  {
    $(".sukses").html('<div class="alert bg-gray">Berhasil Batal Retur Penjualan</div>');   
    setTimeout(function(){$('.sukses').html('');
      window.location = "<?php echo base_url() . 'retur_penjualan/retur_penjualan/daftar_retur_penjualan' ; ?>";
    },1500);        
  }
});
}


</script>

