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
								$user = $this->session->userdata('astrosession');
								$param = $this->uri->segment(3);
								if(!empty($param)){
									$reservasi = $this->db->get_where('transaksi_reservasi',array('kode_reservasi'=>$param));
									$hasil_reservasi = $reservasi->row();
								}    

								?>
								<div class="row">
									<div class="sukses"></div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Kode Reservasi</label>
											<?php
											$tgl = date("Y-m-d");
											$no_belakang = 0;
											$this->db->select_max('kode_reservasi');
											$kode = $this->db->get_where('transaksi_reservasi',array('tanggal_transaksi'=>$tgl));
											$hasil_kode = $kode->row();
                                        #$pecah_kode = explode("_",$hasil_kode_pembelian->kode_pembelian);
                                        #echo $pecah_kode[0];
                                        #echo $pecah_kode[2];
											$this->db->select('kode_reservasi');
											$kode_reservasi = $this->db->get('master_setting');
											$hasil_kode_reservasi = $kode_reservasi->row();
											if(count($hasil_kode)==0){
												$no_belakang = 1;
											}
											else{
												$pecah_kode = explode("_",$hasil_kode->kode_reservasi);
												$no_belakang = @$pecah_kode[2]+1;
											}
                                        #echo $this->db->last_query();
											$ipaddress = '';
											if (getenv('HTTP_CLIENT_IP'))
												$ipaddress = getenv('HTTP_CLIENT_IP');
											else if(getenv('HTTP_X_FORWARDED_FOR'))
												$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
											else if(getenv('HTTP_X_FORWARDED'))
												$ipaddress = getenv('HTTP_X_FORWARDED');
											else if(getenv('HTTP_FORWARDED_FOR'))
												$ipaddress = getenv('HTTP_FORWARDED_FOR');
											else if(getenv('HTTP_FORWARDED'))
												$ipaddress = getenv('HTTP_FORWARDED');
											else if(getenv('REMOTE_ADDR'))
												$ipaddress = getenv('REMOTE_ADDR');
											else
												$ipaddress = 'UNKNOWN';

                                       # echo $ipaddress;

											$get_kasir = $this->db->get_where('master_kasir',array('ip'=>$ipaddress));
											$hasil_kasir = $get_kasir->row();
                                      #echo $this->db->last_query();
											$nomor_kasir = $hasil_kasir->kode_kasir;
											?>
											<input readonly="true" type="text" class="form-control" value="<?php if(!empty($param)){ echo @$hasil_reservasi->kode_reservasi; }else{ echo @$hasil_kode_reservasi->kode_reservasi."_".date("dmyHis")."_".$nomor_kasir."_".$user->id."_".$no_belakang; }  ?>" placeholder="Kode Transaksi" name="kode_reservasi" id="kode_reservasi" />
											<?php
											$tgl = date("Y-m-d");
											$no_belakang = 0;
											$this->db->select_max('kode_pelanggan');
											$kode = $this->db->get_where('transaksi_reservasi',array('tanggal_transaksi'=>$tgl));
											$hasil_kode = $kode->row();
                                        #$pecah_kode = explode("_",$hasil_kode_pembelian->kode_pembelian);
                                        #echo $pecah_kode[0];
                                        #echo $pecah_kode[2];
											$this->db->select('kode_pelanggan');
											$kode_pelanggan = $this->db->get('master_setting');
											$hasil_kode_pelanggan = $kode_pelanggan->row();
											if(count($hasil_kode)==0){
												$no_belakang = 1;
											}
											else{
												$pecah_kode = explode("_",$hasil_kode->kode_pelanggan);
												$no_belakang = @$pecah_kode[2]+1;
											}
                                        #echo $this->db->last_query();
											
											?>
											<input readonly="true" type="hidden" class="form-control" value="<?php if(!empty($param)){ echo $hasil_reservasi->kode_pelanggan; }else{ echo @$hasil_kode_pelanggan->kode_pelanggan."_".date("dmyHis")."_".$no_belakang; }  ?>" placeholder="Kode Transaksi" name="kode_pelanggan" id="kode_pelanggan" />
											
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<label class="gedhi">Tanggal Transaksi</label>
											<input type="text" value="<?php echo TanggalIndo(date("Y-m-d")); ?>" readonly="true" class="form-control" placeholder="Tanggal Transaksi"/>
											<input type="hidden" value="<?php echo date("Y-m-d"); ?>" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_transaksi" id="tanggal_transaksi"/>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Nama</label>
											<input type="text" value="<?php echo @$hasil_reservasi->nama_pelanggan; ?>" class="form-control" name="nama_pelanggan" id="nama_pelanggan" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Alamat</label>
											<textarea class="form-control" name="alamat_pelanggan" id="alamat_pelanggan"><?php echo @$hasil_reservasi->alamat_pelanggan; ?></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Telepon</label>
											<input type="text" value="<?php echo @$hasil_reservasi->telepon_pelanggan; ?>" class="form-control" name="telepon_pelanggan" id="telepon_pelanggan" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Tanggal Pemakaian</label>
											<input type="date" value="<?php echo @$hasil_reservasi->tanggal_reservasi; ?>" class="form-control" name="tanggal_reservasi" id="tanggal_reservasi" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Waktu Pemakaian</label>
											<input type="text" value="<?php echo @$hasil_reservasi->jam_reservasi; ?>" class="form-control timepicker" name="jam_reservasi" id="jam_reservasi" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Ruang</label>
											<select onchange="pilih_meja()" class="form-control" id="ruang">
												<option selected="true" value="">-- Pilih Ruang --</option>
												<option value="">Semua</option>
												<?php $ruang = $this->db->get('master_ruang');
												$hasil_ruang = $ruang->result();
												foreach($hasil_ruang as $daftar){
													?>
													<option value="<?php echo $daftar->kode_ruang; ?>"><?php echo $daftar->nama_ruang; ?></option>
													
													<?php } ?>
													<input type="hidden" id="reserv" value="<?php if(!empty($param)){ echo @$param; } ?>" />
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Meja</label><br />
												<span id="meja">
													<?php
													$this->db->order_by('no_meja','asc');
													$meja = $this->db->get('master_meja');
													$hasil_meja = $meja->result();
													foreach($hasil_meja as $daftar){
														$no_meja = $daftar->no_meja;
														$meja_dipesan = $this->db->get_where('transaksi_reservasi',array('kode_reservasi'=>@$hasil_reservasi->kode_reservasi,'kode_meja'=>$no_meja));
														$hasil_dipesan = $meja_dipesan->row();
														?>
														<input <?php if(@$hasil_dipesan->kode_meja==$daftar->no_meja){ echo "checked='true'"; } ?> type="checkbox" value="<?php echo $daftar->no_meja ?>" name="dipilih" id="kode_meja" /><span style="font-size: 15px;"><?php echo $daftar->no_meja ?></span><br />
														<?php } ?>
													</span>
												</div>
											</div>
											<div class="form-group col-md-6">
												<label>DP</label>
												<div class="input-group">
													<span id="dibayar">
														<input onkeyup="rupiah()" type="text" value="<?php echo @$hasil_reservasi->dp; ?>" class="form-control" name="dp" id="dp" />
													</span>
													<span id="rupiah" class="input-group-addon">Rp.</span>
												</div>
											</div>
											<div style="margin-left: 120px;" class="col-md-8">
												<table style="font-size: 1.5em;" id="" class="table table-striped table-bordered table-advance table-hover">
													<tbody>
														<form id="panelForm">
															<tr>
																<td colspan="2" style="background-color:#229fcd;">
																	<input type="text" name="id_penjualan" id="id_penjualan" value="" hidden/>
																	<?php
																	$menu_resto = $this->db->get_where('master_menu',array('status'=>'1'));
																	$hasil_menu = $menu_resto->result();
																	?>
																	<select name="menu" onchange="get_harga()" id="menu" class="form-control">
																		<option value="" selected="true">--Pilih Menu--</option>
																		<?php
																		foreach($hasil_menu as $daftar){
																			?>
																			<option value="<?php echo $daftar->kode_menu; ?>"><?php echo $daftar->nama_menu; ?></option>
																			<?php } ?>
																		</select>
																	</td>
																	
																	<td width="100px" style="background-color:#229fcd;"><input type="text" name="qty" id="qty" class="form-control" placeholder="jumlah"></td>
																	<td width="100px" style="background-color:#229fcd;"><input readonly="true" type="text" name="harga" id="harga" class="form-control" placeholder="harga"></td>
																	<td width="100px" style="background-color:#229fcd;"><input type="text" name="diskon" id="diskon_item" class="form-control" placeholder="diskon"></td>
																	<td width="100px"style="background-color:#229fcd;" >
																		<div onclick="simpan_pesanan_reservasi()" class="btn purple">Add</div>
																		
																	</td>
																</tr>
															</form>
														</tbody>
													</table>
												</div>
												<div style="margin-left: 120px;" class="col-md-8">
													<table style="white-space: nowrap; font-size: 1.5em;" id="data" class="table table-bordered  table-hover">
														<thead>
															<tr>
																<th style="background-color:#229fcd; color:white" class="text-center" width="50px">No.</th>
																<th style="background-color:#229fcd; color:white" class="text-center">Nama Produk</th>
																
																<th style="background-color:#229fcd; color:white" class="text-center" width="50px">Qty</th>
																<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Harga</th>
																<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Subtotal</th>
																<th style="background-color:#229fcd; color:white" class="text-center" width="70px">Diskon</th>
																<th style="background-color:#229fcd; color:white" class="text-center" width="175px">Action</th>
															</tr>
														</thead>
														<tbody id="tb_pesan_temp">
															<tr>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
														</tbody>
														<tfoot>
														</tfoot>
													</table>
													
													
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<?php if(!empty($param)){ ?>
															<div style="margin-left: 10px;" onclick="batal_edit_reservasi()" class="btn btn-lg btn-primary pull-right"><i class=" fa fa-history"></i> Batal</div>
															<?php } ?>
															<a href="<?php echo base_url().'kasir'; ?>" style="margin-left: 10px;" class="btn btn-lg btn-warning pull-right"><i class=" fa fa-arrow-left"></i> Kembali</a>
															<div onclick="simpan_reservasi()" class="btn btn-lg btn-success pull-right"><i class=" fa fa-save"></i> Simpan</div>
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
						
						<!-- /.row (main row) -->
					</section><!-- /.content -->
				</div><!-- /.content-wrapper -->
				<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="background-color:grey">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
							</div>
							<div class="modal-body">
								<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus pesanan tersebut ?</span>
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
						var kode_reservasi = $("#kode_reservasi").val();
						var url = '<?php echo base_url().'kasir/hapus_pesanan_reservasi_temp'; ?>';
						$.ajax({
							type: "POST",
							url: url,
							data: {
								id:id
							},
							success: function(msg) {
								$('#modal-confirm').modal('hide');
								$("#tb_pesan_temp").load('<?php echo base_url().'kasir/kasir/pesanan_reservasi_temp/'; ?>'+kode_reservasi);
								totalan();
								grand_total();
							}
						});
						return false;
					}


					function get_harga(){
						var url = "<?php echo base_url().'kasir/get_harga'; ?>";
						var id_menu = $("#menu").val();
						$.ajax( {
							type:"POST", 
							url : url,  
							cache :false,  
							data :{id_menu:id_menu},
							beforeSend:function(){
								$(".tunggu").show();  
							},
							success : function(data) {  
								$(".tunggu").hide(); 
								$("#harga").val(data);
							},  
							error : function(data) {  
								alert(data);  
							}  
						});
					}

					function simpan_pesanan_reservasi(){
						var url = "<?php echo base_url().'kasir/kasir/simpan_pesanan_reservasi_temp'; ?>";
						var kode_reservasi = $("#kode_reservasi").val();
						var tanggal_transaksi = $("#tanggal_transaksi").val();
						var menu = $("#menu").val();
						var jumlah = $("#qty").val();
						var harga = $("#harga").val();
						var diskon = $("#diskon_item").val();
						if(jumlah < 1 || menu==""){
							$(".sukses").html("<div class='alert alert-warning'>Jumlah Pesanan Salah</div>");
							setTimeout(function(){$('.sukses').html('');},1500); 
							
						}else{
							$.ajax( {
								type:"POST", 
								url : url,  
								cache :false,  
								data :{kode_reservasi:kode_reservasi,kode_menu:menu,jumlah:jumlah,
									diskon_item:diskon,harga_satuan:harga
								},
								beforeSend:function(){
									$(".tunggu").show();  
								},
								success : function(data) {
									$(".tunggu").hide(); 
									$("#tb_pesan_temp").load('<?php echo base_url().'kasir/pesanan_reservasi_temp/'; ?>'+kode_reservasi);
									$("#menu").val('');
									$("#qty").val('');
									$("#diskon_item").val('');
									$("#harga").val('');
									$("#keterangan").val('');
									totalan();
									grand_total();
									cek_status();
									
								},  
								error : function(data) {  
									alert(data);  
								}  
							});
						}
						
					}

					function batal_edit_reservasi(){
						var kode_reservasi = $("#kode_reservasi").val();
						var url = "<?php echo base_url().'kasir/batal_edit_reservasi'; ?>";
						$.ajax( {
							type:"POST", 
							url : url,  
							cache :false,  
							data :{kode_reservasi:kode_reservasi},
							beforeSend:function(){
								$(".tunggu").show();  
							},
							success : function(data) {
								$(".tunggu").hide(); 
								setTimeout(function(){ window.location='<?php echo base_url('kasir/dft_reservasi'); ?>'; },1500);
								
							},  
							error : function(data) {  
								alert(data);  
							}  
						});
					}

					function simpan_reservasi(){
						var kode_reservasi = $("#kode_reservasi").val();
						var kode_pelanggan = $("#kode_pelanggan").val();
						var tanggal_transaksi = $("#tanggal_transaksi").val();
						var nama_pelanggan = $("#nama_pelanggan").val();
						var alamat_pelanggan = $("#alamat_pelanggan").val();
						var telepon_pelanggan = $("#telepon_pelanggan").val();
						var tanggal_reservasi = $("#tanggal_reservasi").val();
						var jam_reservasi = $("#jam_reservasi").val();
						var kode_meja = [];
						$("input[name='dipilih']:checked").each(function(){
							kode_meja.push($(this).val()); 
						});
						var hapus_meja = [];
						$("input:checkbox:not(:checked)").each(function(){
							hapus_meja.push($(this).val()); 
						});
						var dp = $("#dp").val();
						<?php
						if(!empty($param)){
							
							
							?>
							var url = "<?php echo base_url().'kasir/simpan_edit_reservasi' ?>";
							<?php }else{
								
								?>
								var url = "<?php echo base_url().'kasir/simpan_reservasi' ?>";
								<?php } ?>
								$.ajax({
									type:"post",
									url:url,
									data:{kode_reservasi:kode_reservasi,kode_pelanggan:kode_pelanggan,tanggal_transaksi:tanggal_transaksi,
										nama_pelanggan:nama_pelanggan,alamat_pelanggan:alamat_pelanggan,telepon_pelanggan:telepon_pelanggan,
										tanggal_reservasi:tanggal_reservasi,jam_reservasi:jam_reservasi,kode_meja:kode_meja,dp:dp,hapus_meja:hapus_meja
									},
									success:function(hasil){
										if(hasil=="gagal"){
											$("#berhasil").html('<div class="alert alert-warning">Pesan Menu Dahulu</div>');
										}else if(hasil=="belum"){
											$("#berhasil").html('<div class="alert alert-warning">Pilih Meja Dahulu</div>');
										}else if(hasil=="belumgagal"){
											$("#berhasil").html('<div class="alert alert-warning">Pilih Meja dan Menu Dahulu</div>');
										}else{
											$("#berhasil").html('<div class="alert alert-success">Reservasi meja berhasil</div>');
											setTimeout(function(){ window.location='<?php echo base_url('kasir/dft_reservasi'); ?>'; },1500);
										}
										
									}
								})
							}

							function rupiah(){
								var rupiah = $("#dp").val();
								var url = "<?php echo base_url().'kasir/diskon_all' ?>";
								$.ajax({
									type:"post",
									url:url,
									data:{rupiah:rupiah},
									success:function(data){
										$("#rupiah").text(data);
									}
								})
							}
							function actEdit(id) {
								var id = id;
								var url = "<?php echo base_url().'kasir/get_pesanan_reservasi_temp'; ?>";
								var kode_reservasi = $("#kode_reservasi").val();
								$.ajax({
									type: 'POST',
									url: url,
									dataType: 'json',
									data: {id:id},
									success: function(kasir){
										$("#menu").val(kasir.kode_menu);
										$("#qty").val(kasir.jumlah);
										$("#qty2").val(kasir.jumlah);
										$("#diskon_item").val(kasir.diskon_item);
										$("#harga").val(kasir.harga_satuan);
										$("#kode_edit_penjualan").val(kasir.kode_penjualan);
										$("#keterangan").val(kasir.keterangan);
										$("#tb_pesan_temp").load('<?php echo base_url().'kasir/pesanan_reservasi_temp/'; ?>'+kode_reservasi);
									}
								});
							}

							function pilih_meja(){
								var ruang = $("#ruang").val();
								var reserv = $("#reserv").val();
								var url = "<?php echo base_url().'kasir/pilih_meja' ?>";
								$.ajax({
									type:"post",
									url:url,
									data:{ruang:ruang,reserv:reserv},
									success:function(data){
										$("#meja").html(data);
									}
								})
							}

							$(document).ready(function(){
   /* var kode_meja = [];
    $("input:checkbox:not(:checked)").each(function(){
       kode_meja.push($(this).val()); 
    });
    alert(kode_meja);*/
    var kode_reservasi = $("#kode_reservasi").val();
    <?php if(!empty($param)){
    	
    	?>
    	$("#tb_pesan_temp").load('<?php echo base_url().'kasir/pesanan_reservasi_temp/'.$param; ?>');
    	<?php }else{
    		
    		?>
    		$("#tb_pesan_temp").load('<?php echo base_url().'kasir/pesanan_reservasi_temp/'; ?>'+kode_reservasi);
    		<?php } ?>
    		$(".tgl").datepicker();
    		$('input.timepicker').timepicker({ 
    			timeFormat: 'HH:mm',
    			interval: 30,
    			scrollbar:true 
    		});
    	});
    </script>