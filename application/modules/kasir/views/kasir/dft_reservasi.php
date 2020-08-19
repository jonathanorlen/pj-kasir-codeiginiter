

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
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
            <a style="margin-left: 17px; padding: 15px; height: 75px;width: auto;" id="kembali" class="icon-btn btn blue-steel">
													<i class="fa fa-arrow-left"></i>
													<div style="color: white;">
														 Kembali
													</div>
													</a><br /><br />
            <div style="margin-left: 15px;margin-right: 15px;" class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          Daftar Reservasi
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
                            $this->db->group_by('kode_reservasi');
                            $reservasi = $this->db->get_where('transaksi_reservasi',array('tanggal_reservasi >='=>date("Y-m-d"),'status'=>''));
                            $hasil_reservasi = $reservasi->result();
                        ?>
                                <table style="font-size: 1.5em;" id="tabel_daftar" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>No Meja Dipesan</th>
                        <th>Tanggal dan Waktu Reservasi</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor=1;
                        foreach($hasil_reservasi as $daftar){
                        ?>
                        <tr class="<?php if($daftar->tanggal_reservasi==date("Y-m-d")){ echo "danger"; } ?>">
                          <td><?php echo $nomor; ?></td>
                          <td><?php echo $daftar->nama_pelanggan; ?></td>
                          <?php $meja = $this->db->get_where('transaksi_reservasi',array('kode_reservasi'=>$daftar->kode_reservasi)); 
                                $hasil_meja = $meja->result();
                          ?>
                          <td><?php foreach($hasil_meja as $daftar){ echo $daftar->kode_meja.","; } ?></td>
                          <td><?php echo TanggalIndo($daftar->tanggal_reservasi)."/ ".$daftar->jam_reservasi; ?></td>
                          <td>
                          
                          <?php echo get_detail_edit_delete_reservasi($daftar->kode_reservasi); ?>
                          </td>
                        </tr>
                       <?php $nomor++; } ?>
                    </tbody>
                      <tfoot>
                        <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>No Meja Dipesan</th>
                        <th>Tanggal dan Waktu Reservasi</th>
                        <th>Action</th>
                      </tr>
                     </tfoot>
                   </table>

            </section><!-- /.Left col -->      
        </div>
        
        <!------------------------------------------------------------------------------------------------------>

      </div>
    </div>
            
                <!-- /.content-wrapper -->
<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:grey">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color:#fff;">Konfirmasi Pembatalan Reservasi</h4>
            </div>
            <div class="modal-body">
                <span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan membatalkan reservasi tersebut ?</span>
                <input id="id-delete" type="hidden">
            </div>
            <div class="modal-footer" style="background-color:#eee">
                <button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
                <button onclick="delData()" class="btn red">Ya</button>
            </div>
        </div>
    </div>
</div>
<script>
function actDelete(Object) {
    $('#id-delete').val(Object);
    $('#modal-confirm').modal('show');
}

function delData() {
    var id = $('#id-delete').val();
    var url = '<?php echo base_url().'kasir/batal'; ?>';
    $.ajax({
        type: "POST",
        url: url,
        data: {
            kode_reservasi: id
        },
        success: function(msg) {
            $('#modal-confirm').modal('hide');
            // alert(id);
            window.location.reload();
        }
    });
    return false;
}

function status_reservasi(kode_reservasi) {
    var kode_reservasi = kode_reservasi
     var url = "<?php echo base_url().'kasir/buka_reservasi'; ?>";
    $.ajax({
        type:"post",
        url:url,
        data:{kode_reservasi:kode_reservasi},
        success:function(data){
           setTimeout(function(){ window.location="<?php echo base_url().'kasir/menu_kasir/'; ?>"+data; },1500);
        }
    })
    return false;
}

function buka_reservasi(){
    //alert("AA");
    var url = "<?php echo base_url().'kasir/buka_reservasi'; ?>";
    var kode_reservasi = $('.buka').attr('kode');
    $.ajax({
        type:"post",
        url:url,
        data:{kode_reservasi:kode_reservasi},
        success:function(data){
           setTimeout(function(){ window.location="<?php echo base_url().'kasir/menu_kasir/'; ?>"+data; },1500);
        }
    })
}
$(document).ready(function(){
  $("#tabel_daftar").dataTable();
  $("#kembali").click(function(){
    window.location = "<?php echo base_url() . 'kasir/' ?>";
})
})
   
</script>