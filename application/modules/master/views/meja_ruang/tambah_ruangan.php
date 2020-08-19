

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
                              <a href="#">Tambah Ruangan</a>
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
          Tambah Ruangan
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
          <form id="data_form" action="<?php echo base_url('admin/master/simpan_ruangan'); ?>" method="post">
                        <div class="box-body">            
                          <div class="row">
        <?php
            $param = $this->uri->segment(4);
            if(!empty($param)){
                $ruangan = $this->db->get_where('master_ruang',array('kode_ruang'=>$param));
                $hasil_ruangan = $ruangan->row();
            }
        
        ?>
                            
                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Kode Ruangan</label>
                              <input type="hidden" name="id" value="<?php echo @$hasil_ruangan->kode_ruang; ?>" />
                              <input <?php if(!empty($param)){ echo "readonly='true'"; } ?> type="text" class="form-control" value="<?php echo @$hasil_ruangan->kode_ruang; ?>" name="kode_ruang" id="kode_ruang" />
                            </div>
                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Nama Ruangan</label>
                              <input type="hidden" name="id" value="<?php echo @$hasil_ruangan->id; ?>" />
                              <input type="text" class="form-control" value="<?php echo @$hasil_ruangan->nama_ruang; ?>" name="nama_ruang" />
                            </div>
                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Keterangan</label>
                              <input type="text" class="form-control" value="<?php echo @$hasil_ruangan->keterangan; ?>" name="keterangan" />
                            </div>
                          </div>

                          <div class="box-footer">
                              <button type="submit" class="btn btn-primary">Simpan</button>
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
    window.location = "<?php echo base_url().'master/meja_ruang/'; ?>";
  });
  </script>
<script>
$(function(){

    $('#kode_ruang').on('change',function(){
      var kode_ruang = $('#kode_ruang').val();
      var url = "<?php echo base_url() . 'master/meja_ruang/get_kode' ?>";
      $.ajax({
          type: 'POST',
          url: url,
          data: {kode_ruang:kode_ruang},
success: function(msg){
              if(msg == 1){
                $(".sukses").html('<div class="alert alert-warning">Kode_Telah_dipakai</div>');
                  setTimeout(function(){
                    $('.sukses').html('');
                },1700);              
                $('#kode_ruang').val('');
              }
              else{

              }
          }
      });
    });


    $("#data_form").submit( function() {
       /* var vv = $(this).serialize();
       alert(vv);*/
       <?php if(!empty($param)){ ?>
          var url = "<?php echo base_url(). 'master/meja_ruang/simpan_edit_ruang'; ?>";  
       <?php }else{ ?>
            var url = "<?php echo base_url(). 'master/meja_ruang/simpan_ruang'; ?>";
       <?php } ?>
       $.ajax( {
       type:"POST", 
        url : url,  
        cache :false,  
        data :$(this).serialize(),
        beforeSend: function(){
         $(".loading").show(); 
       },
        beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  
        if(data=="sukses"){
           $(".sukses").html('<div class="alert alert-success">Data Berhasil Disimpan</div>');
           setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'master/meja_ruang/' ?>";},1000);  
        }
        else{
           $(".sukses").html('<div class="alert alert-success">Data Berhasil Disimpan</div>');
           setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'master/meja_ruang/' ?>";},1000);  
        }
        $(".loading").hide();            
      },  
      error : function(data) {  
        alert(data);  
      }  
    });
       return false;                    
     });
})

</script>