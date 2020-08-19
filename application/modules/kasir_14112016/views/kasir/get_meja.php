 <?php
    $id = $this->input->post('id_ruang');
    
    
    if($id==""){
        $ruangan = $this->db->get('master_ruang');
    }else{
        $ruangan = $this->db->get_where('master_ruang',array('kode_ruang'=>$id));
    }
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