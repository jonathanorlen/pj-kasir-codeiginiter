

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Meja & Ruangan </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin').'/dasboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
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
          Daftar Meja
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
                            $meja = $this->db->get('master_meja');
                            $hasil_meja = $meja->result();
                        ?>
          <table style="font-size: 1.5em;" id="tabel_daftar" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Nomor Meja</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor = 1;
                                    foreach($hasil_meja as $daftar){
                                ?>
                                <tr>
                                  <td><?php echo $nomor; ?></td>
                                  <td><?php echo $daftar->nama_ruang; ?></td>
                                  <td><?php echo $daftar->no_meja; ?></td>
                                  <td><?php echo $daftar->keterangan; ?></td>
                                  <td><?php echo cek_status_meja($daftar->status); ?></td>
                                  <td align="center"><?php echo get_detail_edit_delete($daftar->id); ?></td>
                                </tr>
                               <?php $nomor++; } ?>
                            </tbody>
                              <tfoot>
                                <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Nomor Meja</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                             </tfoot>
                        </table>
        </div>
        
        <!------------------------------------------------------------------------------------------------------>

      </div>
    </div>
                <div class="box box-info">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools"></div><!-- /. tools -->
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
                <span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus data meja tersebut ?</span>
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
function actDelete(Object) {
    $('#id-delete').val(Object);
    $('#modal-confirm').modal('show');
}

function delData() {
    var id = $('#id-delete').val();
    var url = '<?php echo base_url().'master/meja/hapus'; ?>/delete';
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
$(document).ready(function(){
  $("#tabel_daftar").dataTable();
})
   
</script>