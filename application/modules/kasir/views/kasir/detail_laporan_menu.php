

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
                        <form id="data_form" action="" method="post">
                            <div class="box-body">
                              <label><h3><b>Detail Penjualan</b></h3></label>
                              <div class="row">
                              <?php
                                  //$param = $this->uri->segment(3);
                                  $kode_penjualan = $this->uri->segment(3);
                                  $penjualan = $this->db->get_where('transaksi_penjualan',array('kode_kasir' => $kode_penjualan));
                                  $list_penjualan_row = $penjualan->row();
                                  $list_penjualan = $penjualan->result();
                              ?>
                               

                              

                              </div>
                            </div> 
                                
                            <div id="list_transaksi_pembelian">
                              <div class="box-body">
                                <div class="row">
                                  
                                </div>

                                <table style="font-size: 1.5em;" id="tabel_daftar" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Kategori</th>
                                      <th>Menu</th>
                                      <th>QTY</th>
                                      <th>Harga</th>
                                      <th>Subtotal</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                       //$param = $this->uri->segment(3);
                                        $kode_penjualan = $this->uri->segment(3);
                                                 $this->db->select('*'); 
                                                 $this->db->distinct();
                                                 $this->db->select('nama_menu') ;
                                                 $this->db->group_by('nama_menu');
                                        $spoil = $this->db->get_where('opsi_transaksi_penjualan',array('kode_kasir' => $kode_penjualan));
                                        $list_spoil = $spoil->result();
                                        $nomor = 1;  $total = 0;

                                        foreach($list_spoil as $daftar){ 
                                      ?> 
                                          <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $daftar->kategori_menu; ?></td>
                                            <td><?php echo $daftar->nama_menu; ?></td>
                                            <td><?php echo $daftar->jumlah; ?></td>
                                            <td><?php echo format_rupiah($daftar->harga_satuan); ?></td>
                                            <td><?php echo format_rupiah($daftar->subtotal); ?></td>
                                          </tr>
                                      <?php 
                                          $total = $total + $daftar->subtotal;
                                          $nomor++; 
                                        } 
                                      ?>
                                      <tr>
                                        <td colspan="3"></td>
                                        <td style="font-weight:bold;">Total</td>
                                        <td></td>
                                        <td><?php echo format_rupiah($total); ?></td>
                                      </tr>

                                      
                                      

                                  </tbody>
                                  <tfoot>
                                    
                                  </tfoot>
                                </table>
                              </div>
                            </div>
                            <br>
                              <div class="box-footer">
                               <!--  <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'laporan/penjualan/'; ?>"><i class="fa fa-backward"></i>Kembali</a> -->
                              </div>
                        </form>
        
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
    window.location = "<?php echo base_url().'kasir/laporan_penjualan_menu'; ?>";
  });
  </script>
