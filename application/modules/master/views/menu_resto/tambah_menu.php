<!--<?php
//mengambil dari address bar segmen ke 4 dari base_url
$param = $this->uri->segment(4);
//jika terdapat segmen maka tampilkan view_user berdasar id sesuai value segmen
if (!empty($param)) {
 $get_menu = $this->db->get_where('master_produk' , array('kode_produk' => $param));
 $hasil_edit_menu = $get_menu->row();
}
?>-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <i class="fa fa-home"></i>
          <a href="#">Master</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <a href="#">Produk</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <a href="#">Daftar Produk</a>
        </li>
      </ul>

    </div>
  </section>
  <style type="text/css">
  .ombo{
    width: 600px;
  } 

  </style>    
  <!-- Main content -->
  <section class="content">             
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        

        

        <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'master/menu_resto/tambah'; ?>">
          <i class="fa fa-plus"></i> Tambah Produk
        </a>

        <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'master/menu_resto/daftar_menu'; ?>">
          <i class="fa fa-list"></i> Daftar Produk
        </a>

        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              Tambah Produk
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

            <?php 
            $get_unit = $this->db->get('setting_gudang');
            $hasil_unit = $get_unit->row(); 
            ?>
            <div class="box-body">            
              <div class="sukses" ></div>
              <div class="loading" style="z-index:9999999999999999; background:rgba(255,255,255,0.8); width:100%; height:100%; position:fixed; top:0; left:0; text-align:center; padding-top:25%; display:none" >
                <img src="<?php echo base_url() . '/public/img/loading.gif' ?>" >
              </div>

              <form id="data_form" action="" method="post">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                        <label>Kode Produk</label>
                        <input <?php if(!empty($param)){ echo "readonly='true'"; } ?> type="text" class="form-control" name="kode_produk" id="kode_produk" value="<?php echo @$hasil_edit_menu->kode_produk;?>"/>
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo @$hasil_edit_menu->id;?>" required/>
                       
                      </div>
  <div class="form-group">
                        <label class="gedhi">Satuan</label>
                        
                        <?php
                        $satuan = $this->db->get('master_satuan');
                        $hasil_satuan = $satuan->result();
                        ?>
                        <select class="form-control select2" name="satuan_stok" id="kode_satuan_stok" required>
                        <option value="" selected="true">-- Pilih Satuan --</option>
                          <?php foreach($hasil_satuan as $item){ ?>
                          <option value="<?php echo $item->kode ?>" <?php if (@$hasil_edit_menu->kode_satuan_stok == $item->kode){echo'selected="true"';} ?> ><?php echo $item->nama ?></option>
                          <?php } ?>
                        </select>
                      </div> 
                      
<div class="form-group">
                      <label>HPP</label>
                      <div class="input-group">
                        <span id="dibayar">
                          <input onkeyup="hpp()" type="text" value="<?php echo @$hasil_edit_menu->hpp;?>" class="form-control" name="harga_hpp" id="harga_hpp" />
                        </span>
                        <span id="hpp_rp" class="input-group-addon">Rp.</span>
                      </div>
                    </div>

                     


                    </div>



                    <div class="col-md-6">


                      <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?php echo @$hasil_edit_menu->nama_produk;?>"/>
                      </div>

                      

 
                     
<div class="form-group">
                      <label>Harga Jual</label>
                      <div class="input-group">
                        <span id="dibayar">
                          <input onkeyup="rupiah()" type="text" value="<?php echo @$hasil_edit_menu->harga_jual;?>" class="form-control" name="harga_jual" id="harga_jual" />
                        </span>
                        <span id="rupiah" class="input-group-addon">Rp.</span>
                      </div>
                    </div>


                  </div>
                 
                 
                </div>


                  
                 
                </div>

              </div>

              <div class="box-footer">
                 <a style="padding: 10px; " onclick="addMenu()" class="btn btn-success "><i class="fa fa-save"></i> Simpan</a>

              </div>
            </form>


          </div>

          <!------------------------------------------------------------------------------------------------------>

        </div>
      </div>









    </section><!-- /.Left col -->      
  </div><!-- /.row (main row) -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<style type="text/css" media="screen">
  .btn-back
  {
    position: fixed;
    bottom: 10px;
    left: 10px;
    z-index: 999999999999999;
    vertical-align: middle;
    cursor:pointer
  }
  </style>
  <img class="btn-back" src="<?php echo base_url().'component/img/back_icon.png'?>" style="width: 70px;height: 70px;">

  <script>
  $('.btn-back').click(function(){
$(".tunggu").show();
    window.location = "<?php echo base_url().'master/menu_resto/daftar_menu'; ?>";
  });
  </script>
<script>
$('#kode_menu').on('change',function(){
  var kode_menu = $('#kode_menu').val();
  var url = "<?php echo base_url() . 'master/menu_resto/get_kode' ?>";
  $.ajax({
    type: 'POST',
    url: url,
    data: {kode_menu:kode_menu},
success: function(msg){
      if(msg == 1){
        $(".sukses").html('<div class="alert alert-warning">Kode_Telah_dipakai</div>');
        setTimeout(function(){
          $('.sukses').html('');
        },1700);              
        $('#kode_menu').val('');

      }
      else{

      }
    }
  });
});

function addMenu(){
  var id = $('#id').val();
  var kode_produk = $('#kode_produk').val();
  var nama_produk = $('#nama_produk').val();
  var harga_jual = $('#harga_jual').val();
  var kode_satuan_stok = $('#kode_satuan_stok').val();
  var hpp = $("#harga_hpp").val();

  var form_data = {
    id:id,
    kode_produk: kode_produk,
    nama_produk:nama_produk,
    harga_jual: harga_jual,
    kode_satuan_stok: kode_satuan_stok,
    hpp:hpp
  };
  $.ajax({
    type: "POST",
    <?php
    $param = $this->uri->segment(4); 
    if (empty($param)) {
      ?>
        //jika tidak terdapat segmen maka simpan di url berikut
        url : "<?php echo base_url() . 'master/menu_resto/simpan_tambah_menu'; ?>",
        <?php }
        else { ?>
        //jika terdapat segmen maka simpan di url berikut
        url : "<?php echo base_url() . 'master/menu_resto/simpan_edit_menu'; ?>",
        <?php }
        ?> 
        
        data: form_data,
         beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) { 
          $(".sukses").html(data);   
         setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'master/menu_resto/daftar_menu' ?>";},1500);              
        },  
        error : function() {  
          alert("Data gagal dimasukkan.");  
        }
      });
}

function rupiah(){
  var rupiah = $("#harga_jual").val();
  var url = "<?php echo base_url().'kasir/diskon_all' ?>";
  $.ajax({
    type:"post",
    url:url,
    data:{rupiah:rupiah},
    success:function(data){
      $("#rupiah").text(data);
    }
  })
}

function hpp(){
  var rupiah = $("#harga_hpp").val();
  var url = "<?php echo base_url().'kasir/diskon_all' ?>";
  $.ajax({
    type:"post",
    url:url,
    data:{rupiah:rupiah},
    success:function(data){
      $("#hpp_rp").text(data);
    }
  })
}
</script>