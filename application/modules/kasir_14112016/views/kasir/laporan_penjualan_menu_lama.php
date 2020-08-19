

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
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption">
           Laporan Penjualan
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
          <form id="pencarian_form" method="post" style="margin-left: 18px;" class="form-horizontal" target="_blank">

            <div class="row">
              <div class="col-md-4" id="trx_penjualan">
                <div class="input-group">
                  <span class="input-group-addon">Tanggal Awal</span>
                  <input type="date" class="form-control tgl" id="tgl_awal" />
                </div>
              </div>
              <div class="col-md-4" id="trx_penjualan">
                <div class="input-group">
                  <span class="input-group-addon">Tanggal Akhir</span>
                  <input type="date" class="form-control tgl" id="tgl_akhir" />
                </div>
              </div>
              
              <div class=" col-md-4">
                <div class="input-group">
                  <button type="button" class="btn btn-success" onclick="cari_transaksi()"><i class="fa fa-search"></i> Cari</button>
                  
                </div>
              </div>
            </div>

            <br>

            
          </form>
          
          <div id="cari_penjualan">
            <div>
              <?php
              $this->db->select('*'); 
              $this->db->distinct();
              $this->db->select('kode_penjualan') ;
              $this->db->order_by('kode_penjualan','desc');
              //$this->db->group_by('kode_penjualan');
              $this->db->group_by('kode_kasir');
              $penjualan = $this->db->get('transaksi_penjualan');
              $hasil_penjualan = $penjualan->result();

           
              $keuangan = 0;
              foreach($hasil_penjualan as $total){
                $keuangan += $total->grand_total;
              }

              ?>
              <label><h4><strong>Total Transaksi Penjualan : <?php echo count($hasil_penjualan); ?></strong></h4></label><br />
              <span><label><h4><strong>Total Keuangan Penjualan :<?php echo format_rupiah($keuangan); ?></strong></h4></label></span>
            </div>
            <table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.5em;">
              
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Kode Kasir</th>
                  <th>Petugas</th>
                  <th>Total</th>
                  <th class="act">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $nomor = 1;
                $total = 0;

                foreach($hasil_penjualan as $daftar){
                    $total = $total + $daftar->grand_total;
                 ?> 
                <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo TanggalIndo(@$daftar->tanggal_penjualan);?></td>
                  <td><?php echo @$daftar->kode_kasir; ?></td>
                  <td><?php echo @$daftar->petugas; ?></td>
                  <td><?php echo $total; ?></td>
                  <td align="center" class="act"><?php echo get_detail_laporan_menu($daftar->kode_kasir); ?></td>
                </tr>
                <?php $nomor++; } ?>
                
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Kode Penjualan</th>
                  <th>Petugas</th>
                  <th>Total</th>
                  <th class="act">Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          
          <!------------------------------------------------------------------------------------------------------>

        </div>
      </div>
      
      <!-- /.row (main row) -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <script>
    function cari_transaksi(){
      var tgl_awal =$("#tgl_awal").val();
      var tgl_akhir =$("#tgl_akhir").val();
      var petugas = $("#nama_petugas").val();
      $.ajax( {  
        type :"post",  
        url : "<?php echo base_url().'kasir/search_laporan'; ?>",  
        cache :false,
        data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,petugas:petugas},
        success : function(data) {
         $("#cari_penjualan").html(data);
       },  
       error : function(data) {  
        alert("das");  
      }  
    });
    }
    $(document).ready(function(){
      $('#tabel_daftar').dataTable({
        "paging":   false,
        "info":     false
      });
    });
    
  </script>
