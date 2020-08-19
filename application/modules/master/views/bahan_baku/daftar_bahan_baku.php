
<div class="row">      

  <div class="col-xs-12">
    <!-- /.box -->
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          Produk
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
          <table  class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.5em;">

            <?php
            $kode_default = $this->db->get('setting_gudang');
            $hasil_unit =$kode_default->row();
            $param=$hasil_unit->kode_unit;
            $bahan_baku = $this->db->get_where('master_bahan_baku',array('kode_unit' => $param));
            $hasil_bahan_baku = $bahan_baku->result();
            ?>

            <thead>
              <tr width="100%">
                <th>No</th>
                <th>Kode Bahan</th>
                <th>Nama Produk</th>
                <th>Jenis Bahan</th>
                <th>Unit</th>
                <th>Block</th>
                <th>Satuan Pembelian</th>
                <th>Satuan Stok</th>
                <th style="width:50px">Isi Dalam 1 <br>(Satuan Pembelian)</th>
                <th>Stok Minimal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $nomor=1;
              foreach($hasil_bahan_baku as $daftar){
                ?>
                <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo $daftar->kode_bahan_baku; ?></td>
                  <td><?php echo $daftar->nama_bahan_baku; ?></td>
                  <td><?php echo $daftar->jenis_bahan; ?></td>
                  <td><?php echo $daftar->nama_unit; ?></td>
                  <td><?php echo $daftar->nama_rak; ?></td>
                  <td><?php echo $daftar->satuan_pembelian; ?></td>
                  <td><?php echo $daftar->satuan_stok; ?></td>
                  <td><?php echo $daftar->jumlah_dalam_satuan_pembelian; ?></td>
                  <td><?php echo $daftar->stok_minimal; ?></td>
                  <td><?php echo get_detail_edit_delete_string($daftar->id); ?></td>
                </tr>
                <?php $nomor++; } ?>
              </tbody>
              <tfoot>
                <tr>
                 <th>No</th>
                 <th>Kode Produk</th>
                 <th>Nama Produk</th>
                 <th>Jenis Bahan</th>
                 <th>Unit</th>
                 <th>Block</th>
                 <th>Satuan Pembelian</th>
                 <th>Satuan Stok</th>
                 <th style="width:50px">Isi Dalam 1<br> (Satuan Pembelian)</th>
                 <th>Stok Minimal</th>
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
