

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
                              <a href="#">Member</a>
                              <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                              <a href="#">Detail Member</a>
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
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'master/member/tambah/'; ?>">
              <i class="fa fa-plus"></i> Tambah
            </a>
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'master/member/'; ?>">
              <i class="fa fa-list"></i> Daftar
            </a>
            <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          Detail Member
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
          <form id="data_form"  method="post">
                        <div class="box-body">            
                          <div class="row">
                            <?php
                                $uri = $this->uri->segment(4);
                                if(!empty($uri)){
                                    $data = $this->db->get_where('master_member',array('id'=>$uri));
                                    $hasil_data = $data->row();
                                }
                            ?>
                            <!--<div class="form-group  col-xs-5">
                              <label>ID Member</label>
                              <input type="text" class="form-control" name="id_member" readonly="" />
                            </div>-->

                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Kode Member</label>
                              <input type="hidden" name="id" value="<?php echo @$hasil_data->id ?>" />
                              <input type="text" class="form-control" value="<?php echo @$hasil_data->kode_member; ?>" name="kode_member" readonly />
                            </div>

                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Nama Member</label>
                              <input type="text" class="form-control" value="<?php echo @$hasil_data->nama_member; ?>" name="nama_member" readonly/>
                            </div>

                            <div class="form-group  col-xs-5">
                              <label class="gedhi">No. Hp Member</label>
                              <input type="text" class="form-control" value="<?php echo @$hasil_data->telp_member; ?>" name="telp_member" readonly/>
                            </div>

                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Alamat Member</label>
                              <input type="text" class="form-control" value="<?php echo @$hasil_data->alamat_member; ?>" name="alamat_member" readonly/>
                            </div>

                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Status</label>
                              <select class="form-control" name="status_member" readonly disabled="">
                                <option selected="true" value="">--Pilih Status--</option>
                                <option <?php echo "1" == @$hasil_data->status_member ? 'selected' : '' ?> value="1" >Aktif</option>
                                <option <?php echo "0" == @$hasil_data->status_member ? 'selected' : '' ?> value="0" >Tidak Aktif</option>
                              </select>
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
    window.location = "<?php echo base_url().'master/member/'; ?>";
  });
  </script>