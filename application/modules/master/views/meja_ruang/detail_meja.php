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
                              <a href="#">Meja & Ruangan</a>
                              <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                              <a href="#">Detail Meja</a>
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
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'master/meja_ruang/tambah'; ?>">
              <i class="fa fa-plus"></i> Tambah Ruangan
            </a>
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'master/meja_ruang/'; ?>">
              <i class="fa fa-list"></i> Daftar Ruangan
            </a>
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'master/meja/tambah'; ?>">
              <i class="fa fa-plus"></i> Tambah Meja
            </a>
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'master/meja/'; ?>">
              <i class="fa fa-list"></i> Daftar Meja
            </a>
            <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          Detail Meja
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
          <?php
                    $param = $this->uri->segment(4);
                    if(!empty($param)){
                        $meja = $this->db->get_where('master_meja',array('id'=>$param));
                        $hasil_meja = $meja->row();
                    }
                ?>
                    <form id="data_form" action="<?php echo base_url('admin/master/simpan_meja'); ?>" method="post">  
                        <div class="box-body">            
                          <div class="row">
                            <div class="form-group  col-xs-5">
                              <label>No Meja</label>
                              <input readonly="true" value="<?php echo @$hasil_meja->no_meja; ?>" type="text" class="form-control" name="no_meja" />
                              <input type="hidden" class="form-control" value="<?php echo @$hasil_meja->id; ?>" name="id" />
                            </div>
                            <div class="form-group  col-xs-5">
                              <label>Nama Ruangan</label>
                              <?php
                                $ruangan = $this->db->get('master_ruang');
                                $hasil_ruangan = $ruangan->result();
                              ?>
                              <select disabled="true" class="form-control select2" name="kode_ruang">
                                <option selected="true" value="">--Pilih Ruangan--</option>
                                <?php foreach($hasil_ruangan as $daftar){ ?>
                                <option <?php if(@$hasil_meja->kode_ruang==$daftar->kode_ruang){ echo "selected"; } ?> value="<?php echo $daftar->kode_ruang; ?>" ><?php echo $daftar->nama_ruang; ?></option>
                                <?php } ?>
                              </select> 
                            </div>
                            <div class="form-group ombo" style="margin-left: 18px;">
                              <label>Keterangan</label>
                              <input readonly="true" type="text" value="<?php echo @$hasil_meja->keterangan; ?>" class="form-control" name="keterangan" />
                            </div>
                          </div>
                          
                        </div>
                    </form>
                      
          
        </div>
        
        <!------------------------------------------------------------------------------------------------------>

      </div>
    </div>
                <!-- /.row (main row) -->
    </section><!-- /.content -->
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
    window.location = "<?php echo base_url().'master/meja/'; ?>";
  });
  </script>
</div><!-- /.content-wrapper -->
<script type="text/javascript">
$(document).ready(function(){
  $(".select2").select2();
});
</script>