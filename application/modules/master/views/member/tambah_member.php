

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
          <a href="#">Tambah Member</a>
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
            Tambah Member
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
                              <input <?php if(!empty($uri)){ echo "readonly='true'"; } ?> type="text" class="form-control" value="<?php echo @$hasil_data->kode_member; ?>" name="kode_member" id="kode_member" />
                            </div>

                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Nama Member</label>
                              <input type="text" class="form-control" value="<?php echo @$hasil_data->nama_member; ?>" name="nama_member" />
                            </div>

                            <div class="form-group  col-xs-5">
                              <label class="gedhi">No. Hp Member</label>
                              <input type="text" class="form-control" value="<?php echo @$hasil_data->telp_member; ?>" name="telp_member" />
                            </div>

                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Alamat Member</label>
                              <input type="text" class="form-control" value="<?php echo @$hasil_data->alamat_member; ?>" name="alamat_member" />
                            </div>

                            <div class="form-group  col-xs-5">
                              <label class="gedhi">Status</label>
                              <select class="form-control select2" name="status_member">
                                <option selected="true" value="">--Pilih Status--</option>
                                <option <?php echo "1" == @$hasil_data->status_member ? 'selected' : '' ?> value="1" >Aktif</option>
                                <option <?php echo "0" == @$hasil_data->status_member ? 'selected' : '' ?> value="0" >Tidak Aktif</option>
                              </select>
                            </div>
                          </div>

                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
            <script type="text/javascript">

              $(document).ready(function(){
                $(".select2").select2();
              });

              $(function () {

                $('#kode_member').on('change',function(){
                  var kode_member = $('#kode_member').val();
                  var url = "<?php echo base_url() . 'master/member/get_kode' ?>";
                  $.ajax({
                    type: 'POST',
                    url: url,
                    data: {kode_member:kode_member},
                    beforeSend:function(){
                      $(".tunggu").show();  
                    },
                    success: function(msg){
                       $(".tunggu").hide();
                      if(msg == 1){
                        $(".sukses").html('<div class="alert alert-warning">Kode_Telah_dipakai</div>');
                        setTimeout(function(){
                          $('.sukses').html('');
                        },1700);              
                        $('#kode_member').val('');
                      }
                      else{

                      }
                    }
                  });
                });

      //jika tombol Send diklik maka kirimkan data_form ke url berikut
      $("#data_form").submit( function() { 

        $.ajax( {  
          type :"post", 
          <?php 
          if (empty($uri)) {
            ?>
            //jika tidak terdapat segmen maka simpan di url berikut
            url : "<?php echo base_url() . 'master/member/simpan_tambah_member'; ?>",
            <?php }
            else { ?>
            //jika terdapat segmen maka simpan di url berikut
            url : "<?php echo base_url() . 'master/member/simpan_edit_member'; ?>",
            <?php }
            ?>  
            cache :false,  
            data :$(this).serialize(),
            beforeSend:function(){
              $(".tunggu").show();  
            },
            success : function(data) {  
              if(data="sukses"){
               $(".sukses").html('<div style="font-size:1.5em" class="alert alert-success">Data Berhasil Disimpan</div>');
               setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'master/member/' ?>";},1000);  
             }
             else{
              $(".sukses").html(data);
            }
            $(".loading").hide();               
          },  
          error : function() {  
            alert("Data gagal dimasukkan.");  
          }  
        });
        return false;                          
      });   

    });

  </script>