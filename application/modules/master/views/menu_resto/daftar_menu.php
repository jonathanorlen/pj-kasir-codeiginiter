

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
          <a href="#">Menu</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <a href="#">Daftar Menu</a>
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
    <div class="col-xs-12">
      <!-- /.box -->
      <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'master/menu_resto/tambah'; ?>">
        <i class="fa fa-plus"></i> Tambah Produk
      </a>

      <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'master/menu_resto/daftar_menu'; ?>">
        <i class="fa fa-list"></i> Daftar Produk
      </a>
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption">
           Daftar Produk
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
            <table style="font-size:1.5em;" id="tabel_daftar" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>HPP</th>
                  <th>Harga Jual</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                
                //echo $hasil_unit->kode_unit;
                                  //ambil data dari db lalu tampilkan dibawah foreach 
                $get_menu = $this->db->get('master_produk');
                $hasil_menu = $get_menu->result_array();
                $i = 0;
                foreach ($hasil_menu as $item) {
                  $i++;
                  ?>   
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $item['kode_produk'];?></td>
                    <td><?php echo $item['nama_produk'];?></td>
                    <td align="right"><?php echo format_rupiah($item['hpp']);?></td>
                    <td align="right"><?php echo format_rupiah($item['harga_jual']);?></td>
                    <td align="center"><?php echo get_detail_edit_delete_string($item['kode_produk']); ?></td>
                  </tr>

                  <?php } ?>

                </tbody>
                <tfoot>
                  <tr>
                  <th>No</th>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>HPP</th>
                  <th>Harga Jual</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>


            </div>

            <!------------------------------------------------------------------------------------------------------>

          </div>
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
          <span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus data produk tersebut ?</span>
          <input id="id-delete" type="hidden">
        </div>
        <div class="modal-footer" style="background-color:#eee">
          <button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
          <button onclick="delData()" class="btn red">Ya</button>
        </div>
      </div>
    </div>
  </div>
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
    window.location = "<?php echo base_url().'master/daftar/'; ?>";
  });
  </script>

  <script>
  $(document).ready(function(){
    $("#tabel_daftar").dataTable();
  })

  function actDelete(Object) {
    $('#id-delete').val(Object);
    $('#modal-confirm').modal('show');
  }

  function delData() {
    var id = $('#id-delete').val();
    var url = '<?php echo base_url().'master/menu_resto/hapus_produk'; ?>/delete';
    $.ajax({
      type: "POST",
      url: url,
      data: {
        id: id
      },
      success: function(msg) {
        $('#modal-confirm').modal('hide');
            // alert(id);
            window.location.reload();
          }
        });
    return false;
  }

  </script>