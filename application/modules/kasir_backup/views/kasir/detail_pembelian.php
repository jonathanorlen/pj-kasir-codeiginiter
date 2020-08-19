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
  width: 600px;
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
                <div class="box box-info">
                  <div class="box-header">
                      <!-- tools box -->
                      <div class="pull-right box-tools"></div><!-- /. tools -->
                  </div>
                    <div class="sukses" ></div>
                        <form id="data_form" action="" method="post">
                            <div class="box-body">
                              <label><h3><b>Detail Transaksi Pembelian</b></h3></label>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Kode Transaksi</label>
                                    <?php
                                        $kode = $this->uri->segment(4);
                                        
                                        $transaksi_pembelian = $this->db->get_where('transaksi_pembelian',array('kode_pembelian'=>$kode));
                                        $hasil_transaksi_pembelian = $transaksi_pembelian->row();
                                    ?>
                                    <input readonly="true" type="text" value="<?php echo @$hasil_transaksi_pembelian->kode_pembelian; ?>" class="form-control" placeholder="Kode Transaksi" name="kode_pembelian" id="kode_pembelian" />
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="gedhi">Tanggal Transaksi</label>
                                    <input type="text" value="<?php echo TanggalIndo($hasil_transaksi_pembelian->tanggal_pembelian); ?>" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_pembelian" id="tanggal_pembelian"/>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Nota Referensi</label>
                                    <input readonly="true" type="text" value="<?php echo $hasil_transaksi_pembelian->nomor_nota ?>" class="form-control" placeholder="Nota Referensi" name="nomor_nota" id="nomor_nota" />
                                  </div>
                                  <div class="form-group">
                                    <label>Supplier</label>
                                    <?php
                                      $supplier = $this->db->get('master_supplier');
                                      $supplier = $supplier->result();
                                    ?>
                                    <select disabled="true" class="form-control select2" name="kode_supplier" id="kode_supplier">
                                       <option selected="true" value="">--Pilih Supplier--</option>
                                       <?php foreach($supplier as $daftar){ ?>
                                        <option <?php if($hasil_transaksi_pembelian->kode_supplier==$daftar->kode_supplier){ echo "selected='true'"; } ?> value="<?php echo $daftar->kode_supplier ?>"><?php echo $daftar->nama_supplier ?></option>
                                        <?php } ?>
                                    </select> 
                                  </div>
                                </div>
                                <div class="col-md-6">
                                      <label>Pembayaran</label>
                                      <div class="form-group">
                                        <select disabled="true" class="form-control" name="proses_pembayaran" id="proses_pembayaran">
                                          <option <?php if($hasil_transaksi_pembelian->proses_pembayaran=='cash') { echo "selected='true'"; } ?> value="cash">Cash</option>
                                          <option <?php if($hasil_transaksi_pembelian->proses_pembayaran=='credit') { echo "selected='true'"; } ?>  value="credit">Credit</option>
                                          <option <?php if($hasil_transaksi_pembelian->proses_pembayaran=='konsinyasi') { echo "selected='true'"; } ?> value="konsinyasi">Konsinyasi</option>
                                        </select>
                                      </div>
                                    </div>
                              </div>
                            </div> 

                            <div id="list_transaksi_pembelian">
                              <div class="box-body">
                                <table id="tabel_daftar" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Jenis Bahan</th>
                                      <th>Nama bahan</th>
                                      <th>QTY</th>
                                      <th>Harga Satuan</th>
                                      <th>Subtotal</th>
                                    </tr>
                                  </thead>
                                  <tbody id="tabel_temp_data_transaksi">
                                  
                                <?php
                                  $pembelian = $this->db->get_where('opsi_transaksi_pembelian',array('kode_pembelian'=>$kode));
                                  $list_pembelian = $pembelian->result();
                                  $nomor = 1;  $total = 0;

                                  foreach($list_pembelian as $daftar){ 
                                ?> 
                                    <tr>
                                      <td><?php echo $nomor; ?></td>
                                      <td><?php echo $daftar->kategori_bahan ?></td>
                                      <td><?php echo $daftar->nama_bahan; ?></td>
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
                                  <td colspan="4"></td>
                                  <td style="font-weight:bold;">Total</td>
                                  <td><?php echo $total; ?></td>
                                </tr>

                                <tr>
                                  <td colspan="4"></td>
                                  <td style="font-weight:bold;">Diskon (%)</td>
                                  <td id="tb_diskon"><?php echo $hasil_transaksi_pembelian->diskon_persen; ?></td></td>
                                  
                                </tr>
                                
                                <tr>
                                  <td colspan="4"></td>
                                  <td style="font-weight:bold;">Diskon (Rp)</td>
                                  <td id="tb_diskon_rupiah"><?php echo format_rupiah($hasil_transaksi_pembelian->diskon_rupiah); ?></td>
                                  
                                </tr>
                                
                                <tr>
                                  <td colspan="4"></td>
                                  <td style="font-weight:bold;">Grand Total</td>
                                  <td id="tb_grand_total"><?php echo format_rupiah($total-$hasil_transaksi_pembelian->diskon_rupiah); ?></td>
                                  
                                </tr>
                                  </tbody>
                                  <tfoot>
                                    
                                  </tfoot>
                                </table>
                              </div>
                            </div>
                        </form>

                      </div>        
                    </div>  

                      
                </div>
            </section><!-- /.Left col -->      
        </div><!-- /.row (main row) -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


