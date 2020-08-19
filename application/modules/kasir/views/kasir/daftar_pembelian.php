

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Pembelian </h1>
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
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'pembelian/pembelian/tambah'; ?>">
              <i class="fa fa-plus"></i> Tambah Pembelian
            </a>
            
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'pembelian/pembelian/daftar_pembelian'; ?>">
              <i class="fa fa-list"></i> Daftar Pembelian
            </a>
            
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'pembelian/retur/tambah'; ?>">
              <i class="fa fa-plus"></i> Tambah Retur Pembelian
            </a>
            
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'pembelian/retur/daftar_retur_pembelian'; ?>">
              <i class="fa fa-list"></i> Daftar Retur Pembelian
            </a>
            <div class="small-box bg-aqua pull-right">
              <div class="inner">
                <h5 style="font-size:25px; font-family:arial; font-weight:bold">Total Transaksi</h5>
                <?php
                    $this->db->select_sum('grand_total');
                    $total = $this->db->get('transaksi_pembelian');
                    $hasil_total = $total->row();
                    
                ?>
                <p><?php echo format_rupiah($hasil_total->grand_total); ?></p>
              </div>
            </div>
              <br><br><br>
                <div class="box box-info">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools"></div><!-- /. tools -->
                    </div>
                    
                    <div class="box-body">            
                        <div class="sukses" ></div>
                        <table id="tabel_daftar" class="table table-bordered table-striped">
                            <?php
                              $pembelian = $this->db->get('transaksi_pembelian');
                              $hasil_pembelian = $pembelian->result();
                            ?>
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Tanggal Pembelian</th>
                                <th>Kode Pembelian</th>
                                <th>Nota Ref</th>
                                <th>Supplier</th>
                                <th>Total</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor = 1;

                                    foreach($hasil_pembelian as $daftar){ ?> 
                                    <tr>
                                      <td><?php echo $nomor; ?></td>
                                      <td><?php echo TanggalIndo(@$daftar->tanggal_pembelian);?></td>
                                      <td><?php echo @$daftar->kode_pembelian; ?></td>
                                      <td><?php echo @$daftar->nomor_nota; ?></td>
                                      <td><?php echo @$daftar->nama_supplier; ?></td>
                                      <td><?php echo format_rupiah(@$daftar->grand_total); ?></td>
                                      <td><?php echo get_detail($daftar->kode_pembelian); ?></td>
                                    </tr>
                                <?php $nomor++; } ?>
                               
                            </tbody>
                              <tfoot>
                                <tr>
                                <th>No</th>
                                <th>Tanggal Pembelian</th>
                                <th>Kode Pembelian</th>
                                <th>Nota Ref</th>
                                <th>Supplier</th>
                                <th>Total</th>
                                <th>Action</th>
                              </tr>
                             </tfoot>
                        </table>

            </section><!-- /.Left col -->      
        </div><!-- /.row (main row) -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
$(document).ready(function(){
  $("#tabel_daftar").dataTable();
})
   
</script>