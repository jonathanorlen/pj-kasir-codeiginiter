
<div class="row">      

  <div class="col-xs-12">
    <!-- /.box -->
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          List Taking Order
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
    <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'taking_order/tambah' ?>">
                <i class="fa fa-plus"></i> Tambah Taking Order
              </a>

        <div class="box-body">            
          <div class="sukses" ></div>
          <table  class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.5em;">

            

            <thead>
              <tr width="100%">
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Jenis Penerimaan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $taking_order = $this->db->get_where('taking_order',array('status !='=>'selesai'));
                $hasil_taking = $taking_order->result();
                
                $no = 1;
                foreach($hasil_taking as $daftar){
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $daftar->kode_transaksi; ?></td>
                <td><?php echo TanggalIndo($daftar->tanggal_transaksi); ?></td>
                <td><?php echo cek_status_penerimaan($daftar->status_penerimaan); ?></td>
                <td><?php echo get_detail($daftar->kode_transaksi); ?></td>
              </tr>
              <?php $no++; } ?>
                
                
              </tbody>
              <tfoot>
                <tr width="100%">
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Jenis Penerimaan</th>
                <th>Tanggal Transaksi</th>
                <th>Action</th>
              </tr>
             </tfoot>
           </table>


         </div>

         <!------------------------------------------------------------------------------------------------------>

       </div>
     </div>
   </div><!-- /.col -->
 </div>
</div>    
</div>  


<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:grey">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
      </div>
      <div class="modal-body">
        <span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus data bahan baku tersebut ?</span>
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
  var url = '<?php echo base_url().'master/bahan_baku/hapus'; ?>/delete';
  $.ajax({
    type: "POST",
    url: url,
    data: {
      id: id
    },
    beforeSend:function(){
          $(".tunggu").show();  
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
  $("#tabel_daftar").dataTable({
    "paging":   false,
    "ordering": true,
    "info":     false
  });
})

</script>
