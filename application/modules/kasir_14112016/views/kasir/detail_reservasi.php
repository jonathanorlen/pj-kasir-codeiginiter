<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
<style type="text/css">
 .ombo{
  width: 600px;
 } 
</style>    
    <!-- Main content -->
    <section class="content">             
      <!-- Main row -->
      <div class="row">
        
        <div class="col-md-12">
						
						<!-- Begin: life time stats -->
						<div class="portlet light">
                        
                        
                        <br /><br />
							<div class="portlet-title">
                            <div class="note note-danger bg-green-jungle note-bordered">
							<p style="font-size: 15px;">
								 <strong>Reservasi Meja</strong>
							</p>
						</div>
                            
								
								
                                
                                
							</div>
							<div class="portlet-body">
                            <form id="reservasi" method="post">
                  <div class="box-body">
                  <div id="berhasil"></div>
                  <?php
                     $param = $this->uri->segment(3);
                     if(!empty($param)){
                        $reservasi = $this->db->get_where('transaksi_reservasi',array('kode_reservasi'=>$param));
                        $hasil_reservasi = $reservasi->row();
                     }    

                    ?>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Kode Reservasi</label>
                                    
                                    <input readonly="true" type="text" class="form-control" value="<?php echo $hasil_reservasi->kode_reservasi; ?>" placeholder="Kode Transaksi" name="kode_reservasi" id="kode_reservasi" />
                                  
                                    <input readonly="true" type="hidden" class="form-control" value="<?php echo $hasil_reservasi->kode_pelanggan; ?>" placeholder="Kode Transaksi" name="kode_pelanggan" id="kode_pelanggan" />
                                  
                                  </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="gedhi">Tanggal Transaksi</label>
                                    <input type="text" value="<?php echo TanggalIndo($hasil_reservasi->tanggal_reservasi); ?>" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_transaksi" id="tanggal_transaksi"/>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Nama</label>
                                    <input readonly="true" type="text" value="<?php echo @$hasil_reservasi->nama_pelanggan; ?>" class="form-control" name="nama_pelanggan" id="nama_pelanggan" />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea disabled="true" class="form-control" name="alamat_pelanggan" id="alamat_pelanggan"><?php echo @$hasil_reservasi->alamat_pelanggan; ?></textarea>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Telepon</label>
                                    <input readonly="true" type="text" value="<?php echo @$hasil_reservasi->telepon_pelanggan; ?>" class="form-control" name="telepon_pelanggan" id="telepon_pelanggan" />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Tanggal Pemakaian</label>
                                    <input readonly="true" type="text" value="<?php echo @$hasil_reservasi->tanggal_reservasi; ?>" class="form-control tgl" name="tanggal_reservasi" id="tanggal_reservasi" />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Waktu Pemakaian</label>
                                    <input readonly="true" type="text" value="<?php echo @$hasil_reservasi->jam_reservasi; ?>" class="form-control timepicker" name="jam_reservasi" id="jam_reservasi" />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Ruang</label>
                                    <select disabled="true" onchange="pilih_meja()" class="form-control" id="ruang">
                                    <option selected="true" value="">-- Pilih Ruang --</option>
                                        <?php $ruang = $this->db->get('master_ruang');
                                          $hasil_ruang = $ruang->result();
                                          foreach($hasil_ruang as $daftar){
                                     ?>
                                     <option value="<?php echo $daftar->kode_ruang; ?>"><?php echo $daftar->nama_ruang; ?></option>
                                     <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Meja</label><br />
                                    <span id="meja">
                                    <?php
                                        $meja = $this->db->get('master_meja');
                                        $hasil_meja = $meja->result();
                                        foreach($hasil_meja as $daftar){
                                        $no_meja = $daftar->no_meja;
                                        $meja_dipesan = $this->db->get_where('transaksi_reservasi',array('kode_reservasi'=>@$hasil_reservasi->kode_reservasi,'kode_meja'=>$no_meja));
                                        $hasil_dipesan = $meja_dipesan->row();
                                    ?>
                                    <input disabled="true" <?php if(@$hasil_dipesan->kode_meja==$daftar->no_meja){ echo "checked='true'"; } ?> type="checkbox" value="<?php echo $daftar->no_meja ?>" name="dipilih" id="kode_meja" /><?php echo $daftar->no_meja ?><br />
                                    <?php } ?>
                                    </span>
                                  </div>
                                </div>
                                <div class="form-group col-md-6">
                                <label>DP</label>
                              <div class="input-group">
                                <span id="dibayar">
                                  <input readonly="true" onkeyup="rupiah()" type="text" value="<?php echo @$hasil_reservasi->dp; ?>" class="form-control" name="dp" id="dp" />
                                </span>
                                <span id="rupiah" class="input-group-addon">Rp.</span>
                              </div>
                              
                            </div>
                            
                        <div style="margin-left: 80px;"  class="col-md-10">
                        <table style="font-size: 1.5em;" id="data" class="table table-bordered  table-hover">
                            <thead>
                                <tr>
                                    <th style="background-color:#229fcd; color:white" class="text-center" width="50px">No.</th>
                                    <th style="background-color:#229fcd; color:white" class="text-center">Nama Produk</th>
                                    <th style="background-color:#229fcd; color:white" class="text-center" width="50px">Qty</th>
                                    <th style="background-color:#229fcd; color:white" class="text-center" width="125px">Harga</th>
                                    <th style="background-color:#229fcd; color:white" class="text-center" width="125px">Subtotal</th>
                                    <th style="background-color:#229fcd; color:white" class="text-center" width="70px">Diskon</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="tb_pesan_temp">
                            <?php
                                $this->db->group_by('kode_menu');
                                $reservasi = $this->db->get_where('opsi_transaksi_reservasi',array('kode_reservasi'=>$param));
                                $hasil_reservasi = $reservasi->result();
                                $no=1;
                                foreach($hasil_reservasi as $reserv){
                                    
                            
                            ?>
                            <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $reserv->nama_menu; ?></td>
                            <td><?php echo $reserv->jumlah ?></td>
                            <td><?php echo format_rupiah($reserv->harga_satuan); ?></td>
                            <td><?php echo format_rupiah($reserv->subtotal); ?></td>
                            <td><?php echo $reserv->diskon_item; ?></td>
                            </tr>
                            <?php $no++; } ?>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                        
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <a style="margin-left:20px;" href="<?php echo base_url().'kasir/dft_reservasi' ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <a  onclick="buka_reservasi()" class="btn btn-primary pull-right"><i class="fa fa-folder-open-o"></i> Buka Meja</a>
                            
                            </div>
                            
                        </div>
                            
                            
                              </div>
                            </div>
                        </form>
								
							</div>
						</div>
						<!-- End: life time stats -->
					</div>
        
        
       <!-- /.Left col -->      
            
                  </div>
      
          
                </div>
            </section><!-- /.Left col -->      
        </div><!-- /.row (main row) -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
function buka_reservasi(){
    //alert("AA");
    var url = "<?php echo base_url().'kasir/buka_reservasi'; ?>";
    var kode_reservasi = $("#kode_reservasi").val();
    $.ajax({
        type:"post",
        url:url,
        data:{kode_reservasi:kode_reservasi},
        success:function(data){
           setTimeout(function(){ window.location="<?php echo base_url().'kasir/menu_kasir/'; ?>"+data; },1500);
        }
    })
}
</script>