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
                        <div href="javascript:;" class="btn btn-lg blue">
                        <?php
                    $this->db->where('proses_pembayaran !=','kredit');
                    $this->db->where('proses_pembayaran !=','compliment');
                    $trx_tunai = $this->db->get('transaksi_penjualan');
                    $hasil_trx_tunai = $trx_tunai->result();
                    #echo $this->db->last_query();
                ?>
						  <?php echo count($hasil_trx_tunai); ?> Transaksi Tunai
						</div>
                        <div href="javascript:;" class="btn btn-lg red-flamingo">
                        <?php
                    $this->db->where('proses_pembayaran !=','tunai');
                    $this->db->where('proses_pembayaran !=','debet');
                    $this->db->where('proses_pembayaran !=','compliment');
                    $trx_non_tunai = $this->db->get('transaksi_penjualan');
                    $hasil_trx_non_tunai = $trx_non_tunai->result();
                    #echo $this->db->last_query();
                    
                ?>
						  <?php echo count($hasil_trx_non_tunai); ?> Transaksi Non Tunai
						</div>
                        <br /><br />
							<div class="portlet-title">
                            
								<div class="form-group col-md-6">
                              <div class="input-group ">
                                <span class="input-group-addon">Pilih Ruangan</span>
                                <span id="ruang">
                                <?php
                                    $ruangan = $this->db->get('master_ruang');
                                    $hasil_ruang = $ruangan->result();
                                ?>
                                  <select onchange="get_meja()" class="form-control" id="ruangan" name="ruangan">
                                    <option selected="true" value="">Semua</option>
                                    
                                    <?php
                                        foreach($hasil_ruang as $daftar){
                                    ?>
                                        <option value="<?php echo $daftar->kode_ruang; ?>"><?php echo $daftar->nama_ruang; ?></option>
                                    <?php } ?>
                                  </select>
                                </span>
                              </div>
                            </div>
								
                                <div class="pull-right">
                      <a href="<?php echo base_url().'kasir/sold_out/'; ?>" style="text-decoration: none;" class="btn red btn-lg"><i class="fa fa-bell"></i> Sold Out</a>
               <a href="<?php echo base_url().'kasir/menu_kasir/00'; ?>" style="text-decoration: none;" class="btn blue btn-lg"><i class="fa fa-tags"></i> Take Away</a>
               
            <div class="btn-group">
																<button type="button" class="btn btn-lg green dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true" aria-expanded="false">
																Reservasi <i class="fa fa-bookmark"></i>
																</button>
																<ul class="dropdown-menu" role="menu">
																	<li>
																		<a href="<?php echo base_url().'kasir/reservasi/'; ?>">
																	<i class="fa fa-reorder"></i>	Tambah Reservasi </a>
																	</li>
                                                                    <li class="divider">
																	</li>
																	<li>
																		<a href="<?php echo base_url().'kasir/dft_reservasi'; ?>">
																	<i class="fa fa-table"></i>	Daftar Reservasi </a>
																	</li>
																	
																	
																	
																</ul>
															</div>
            </div>
                                
							</div>
							<div class="portlet-body">
                            <div class="col-md-12">
                            
                            </div>
								<div id="meja">
                                
                      <?php
                        $ruangan = $this->db->get('master_ruang');
                        $hasil_ruang = $ruangan->result();
                          
                     ?>
                     
                     <?php  foreach($hasil_ruang as $daftar){ ?>
                     <div class="note note-danger bg-green-jungle note-bordered">
							<p style="font-size: 15px;">
								 <strong><?php echo $daftar->nama_ruang; ?></strong>
							</p>
						</div>
                     
                                    <?php 
                                        $meja = $this->db->get_where('master_meja',array('kode_ruang'=>$daftar->kode_ruang));
                                        $hasil_meja = $meja->result();
                                     foreach($hasil_meja as $daftar){ ?>
                                     <a href="<?php echo base_url().'kasir/menu_kasir/'.$daftar->no_meja; ?>" style=" width: 138px; height: 138px; display: inline-block; margin:20px" class="icon-btn btn <?php if($daftar->status==0){ echo "blue"; }else{ echo "red-flamingo"; } ?> ">
													
													<div>
														 <?php if($daftar->status==0){ ?>
                                            <img style="width: 100px; height: auto;"  src="<?php echo base_url().'public/images/icon/kosong1.png'; ?>" /><br /> Meja <?php echo $daftar->no_meja; ?>
                                            <?php }else{ ?>
                                            <img style="width: 100px; height: auto;"  src="<?php echo base_url().'public/images/icon/isi1.png'; ?>" /><br /> Meja <?php echo $daftar->no_meja; ?>
                                            <?php } ?>
													</div>
													</a>
                                        
                     <?php } } ?>
                  </div>
							</div>
						</div>
						<!-- End: life time stats -->
					</div>
        
        
       <!-- /.Left col -->      
            
                  </div>            
                              
        </div><!-- /.row (main row) -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->



<script>
function setting() {
    $('#modal_setting').modal('show');
}
$(document).ready(function(){
    $("#form_setting").submit(function(){
        var keterangan = "<?php echo base_url().'kasir/keterangan'?>";
        $.ajax({
                  type: "POST",
                  url: keterangan,
                  data: $('#form_setting').serialize(),
                  success: function(msg)
                  {
                    $('#modal_setting').modal('hide');  
                  }
        });
        return false;
    });
});

function get_meja(){
    var url = "<?php echo base_url().'kasir/get_meja'; ?>";
    var id_ruang = $("#ruangan").val();
    $.ajax( {
       type:"POST", 
        url : url,  
        cache :false,  
        data :{id_ruang:id_ruang},
 success : function(data) { 
  $(".tunggu").hide();   
            $("#meja").html(data);
        },  
      error : function(data) {  
        alert(data);  
      }  
    });
}

function tutup_kasir(){
    var kasir = $("#kasir").val();
    var url = "<?php echo base_url().'kasir/tutup_kasir'; ?>";
    $.ajax( {
       type:"POST", 
        url : url,  
        cache :false,  
        data :{kasir:kasir},
        beforeSend: function(){
         $(".loading").show(); 
       },
        beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  
            setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'kasir/tutup_kasir/' ?>"+kasir;},1000);
        },  
      error : function(data) {  
        alert(data);  
      }  
    });
}
</script>