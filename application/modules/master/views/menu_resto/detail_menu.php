<!--<?php
//mengambil dari address bar segmen ke 4 dari base_url
$param = $this->uri->segment(4);
//jika terdapat segmen maka tampilkan view_user berdasar id sesuai value segmen
if (!empty($param)) {
 $get_menu = $this->db->get_where('master_menu' , array('kode_menu' => $param));
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
  width: 600px;
 } 

</style>    
    <!-- Main content -->
    <section class="content">             
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'master/kategori_menu/tambah'; ?>">
              <i class="fa fa-plus"></i> Tambah Kategori Menu
            </a>
            
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'master/kategori_menu/daftar_kategori_menu'; ?>">
              <i class="fa fa-list"></i> Daftar Kategori Menu
            </a>
            
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'master/menu_resto/tambah'; ?>">
              <i class="fa fa-plus"></i> Tambah Menu
            </a>
            
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'master/menu_resto/daftar_menu'; ?>">
              <i class="fa fa-list"></i> Daftar Menu
            </a>
            
            <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          Tambah Menu
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
                          <div class="row">
                            <div class="col-md-6">

                              <div class="form-group">
                                <label>Kode Menu</label>
                                <input <?php if(!empty($param)){ echo "readonly='true'"; } ?> type="text" class="form-control" name="kode_menu" id="kode_menu" value="<?php echo @$hasil_edit_menu->kode_menu;?>"/>
                                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo @$hasil_edit_menu->id;?>" required/>
                              </div>

                              <div class="form-group">
                                <label>Status</label>
                                <select disabled="true" class="form-control select2" name="status_menu" id="status_menu" required>
                                <option value="">--Pilih Status Menu--</option>
                                  <option value="reguler" <?php if (@$hasil_edit_menu->status_menu == 'reguler'){echo'selected="true"';} ?> >Reguler</option>
                                  <option value="konsinyasi" <?php if (@$hasil_edit_menu->status_menu == 'konsinyasi'){echo'selected="true"';} ?> >Konsinyasi</option>
                                
                                </select>
                                
                              </div>

                              <div class="form-group">
                                <label class="gedhi">Satuan</label>
                                <?php
                                  $satuan = $this->db->get_where('master_satuan',array('alias' => 'porsi'));
                                  $hasil_satuan = $satuan->result();
                                ?>
                                <select disabled="true" class="form-control select2" name="satuan_stok" id="satuan_stok" required>
                                  <?php foreach($hasil_satuan as $item){ ?>
                                  <option value="<?php echo $item->kode ?>" <?php if (@$hasil_edit_menu->kode_satuan_stok == $item->kode){echo'selected="true"';} ?> ><?php echo $item->nama ?></option>
                                  <?php } ?>
                                </select>
                              </div> 
                              <div class="form-group">
                      <label>HPP</label>
                     
                       
                          <input readonly="true" onkeyup="hpp()" type="text" value="<?php echo @$hasil_edit_menu->hpp;?>" class="form-control" name="harga_hpp" id="harga_hpp" />
                      
                    </div>
                              
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nama Menu</label>
                                <input readonly="true" type="text" class="form-control" name="nama_menu" id="nama_menu" value="<?php echo @$hasil_edit_menu->nama_menu;?>"/>
                              </div>
                              
                              <div class="form-group">
                                <label>Kategori Menu</label>
                                <?php
                                  $kategori = $this->db->get('master_kategori_menu');
                                  $kategori = $kategori->result();
                                ?>
                                <select disabled="true" class="form-control select2" name="kode_kategori_menu" id="kode_kategori_menu">
                                   <option selected="true" value="">--Pilih Kategori--</option>
                                   <?php foreach($kategori as $daftar){ ?>
                                    <option value="<?php echo $daftar->kode_kategori_menu ?>" <?php if (@$hasil_edit_menu->kode_kategori_menu == $daftar->kode_kategori_menu){echo'selected="true"';} ?> ><?php echo $daftar->nama_kategori_menu ?></option>
                                    <?php } ?>
                                </select> 
                              </div>

                              <div class="form-group">
                                <label>Harga Jual</label>
                                <input readonly="true" type="text" class="form-control" name="harga_jual" id="harga_jual" value="<?php echo @$hasil_edit_menu->harga_jual;?>"/>
                              </div>
                              
                                                           

                           
                            </div>

                          </div>
                        
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
