 <section class="content-header">
  <div class="page-bar">
    <ul class="page-breadcrumb">
      <li>
        <i class="fa fa-home"></i>
        <a href="#">List Pengiriman</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="#">Daftar Pengiriman</a>
        <i class="fa fa-angle-right"></i>
      </li>
    </ul>
  </div>
</section>

<div class="row">      
  <div class="col-xs-12">
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          List Pengiriman 
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse">
          </a>
          <a href="javascript:;" class="reload">
          </a>
        </div>
      </div>
      <div class="portlet-body">
        <div class="box-body">            
          <div class="sukses" ></div>
          <form id="data_form" method="post">
            <div class="box-body">            
              <div class="row">
                <div class="col-md-4">
                  <label>Tanggal Awal</label>
                  <input type="date" name="tgl_awal" id="tgl_awal" class="form-control tgl">
                </div>
                <div class="col-md-4">
                  <label>Tanggal Akhir</label>
                  <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control tgl">
                </div>
                <div class="col-md-4">
                  <br><br>
                  <button style="width: 100px" type="button" class="btn btn-warning " id="cari"><i class="fa fa-search"></i> Cari</button>  </div>    
                </div> 

              </div>
            </div>
          </form>
          <br><br>

<div id="cari_transaksi">
          <table  class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.5em;">
            <?php
            $bulan = date('Y-m');
            $pengiriman = $this->db->query("SELECT * from transaksi_penjualan where status_penerimaan = 'dikirim' and  tanggal_pengiriman like '$bulan%' ");
            $list_pengiriman = $pengiriman->result();
            //echo $this->db->last_query();
            ?>
            <thead>
              <tr width="100%">
                <th>No. Nota</th>
                <th>Tanggal Pengiriman</th>
                <th>Nama Customer</th>
                <th>Jenis Transaksi</th>
                <th>Total</th>
                <th>Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $nomor=1;
              foreach($list_pengiriman as $list){
               if($list->jenis_transaksi == "cod"){
                echo "<tr style='background-color: #ffd6d6'>";
              } else if($list->jenis_transaksi == "kredit"){
                echo "<tr style='background-color: #d6e3ff'>";
              } else if($list->jenis_transaksi == "tunai"){
                echo "<tr style='background-color: #d6ffd9'>";
              }
              ?>

              <td><?php echo $list->kode_penjualan; ?></td>
              <td><?php echo TanggalIndo($list->tanggal_pengiriman); ?></td>
              <td><?php echo $list->nama_penerima; ?></td>
              <td><?php echo cek_jenis_transaksi($list->jenis_transaksi); ?></td>
              <td><?php echo format_rupiah($list->total_nominal); ?></td>
              <td><?php echo cek_status_pengiriman($list->status); ?></td>
              <td><?php echo get_detail($list->id); ?></td>
            </tr>
            <?php $nomor++; } ?>
          </tbody>
          <tfoot>
            <tr width="100%">
              <th>No. Nota</th>
              <th>Tanggal Pengiriman</th>
              <th>Nama Customer</th>
              <th>Jenis Transaksi</th>
              <th>Total</th>
              <th>Status</th>
              <th width="10%">Action</th>
            </tr>
          </tfoot>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>    
</div>  
<script type="text/javascript">
  $(document).ready(function(){
    $('#cari').click(function(){

      var tgl_awal =$("#tgl_awal").val();
      var tgl_akhir =$("#tgl_akhir").val();
     

      $.ajax( {  
        type :"post",  
        url : "<?php echo base_url().'list_pengiriman/cari_pengiriman'; ?>",  
        cache :false,

        data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
        beforeSend:function(){
          $(".tunggu").show();  
        },
        success : function(data) {
         $(".tunggu").hide();  
         $("#cari_transaksi").html(data);
       },  
       error : function(data) {  

       }  
     });

    });
  });
</script>
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
    window.location = "<?php echo base_url().'admin/template'; ?>";
  });
</script>
