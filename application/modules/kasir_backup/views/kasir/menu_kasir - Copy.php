<!-- Content Wrapper. Contains page content -->
<?php 
$user = $this->session->userdata('astrosession');
$modul_user = $user->jabatan;
$jabatan = $this->db->get_where('master_jabatan',array('kode_jabatan'=>$modul_user));
$hasil_jabatan = $jabatan->row();

if($hasil_jabatan->nama_jabatan=='kasir' || $hasil_jabatan->kode_jabatan=='001'){ ?>
<div class="content-wrapper" style="min-height: 925px;margin-left: 0px !important;">
  <section class="content-header">
    <h1><?php echo ucfirst($user->uname);?></h1><div id="clock"></div>
    <ol class="breadcrumb">
    </ol>
  </section>
  
  <?php
}else{
  ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Kasir</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin').'/dasboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
    <?php } ?> 
    <!-- Content Header (Page header) -->
    <style type="text/css">
    .ombo{
      width: 600px;
    } 
    </style>    
    <!-- Main content -->
    <section class="content">             
      <!-- Main row -->

      <div class="col-lg-12">            
            <!--<div style="margin-left: 10px;" class="small-box bg-blue-gradient col-md-3">
              <div class="inner">
              <?php
                    $this->db->where('proses_pembayaran !=','kredit');
                    $this->db->where('proses_pembayaran !=','compliment');
                    $trx_tunai = $this->db->get('transaksi_penjualan');
                    $hasil_trx_tunai = $trx_tunai->result();
                    #echo $this->db->last_query();
                ?>
                <h5 style="font-size:18px; font-family:arial; font-weight:bold"><?php echo count($hasil_trx_tunai); ?> Transaksi Tunai</h5>
                
              </div>
            </div>
            <div style="margin-left: 10px;" class="small-box bg-green-gradient col-md-3">
              <div class="inner">
              <?php
                    $this->db->where('proses_pembayaran !=','tunai');
                    $this->db->where('proses_pembayaran !=','debet');
                    $this->db->where('proses_pembayaran !=','compliment');
                    $trx_non_tunai = $this->db->get('transaksi_penjualan');
                    $hasil_trx_non_tunai = $trx_non_tunai->result();
                    #echo $this->db->last_query();
                    
                ?>
                <h5 style="font-size:18px; font-weight:bold"><?php echo count($hasil_trx_non_tunai); ?> Transaksi Non Tunai</h5>
                
              </div>
            </div>-->
            <?php if($hasil_jabatan->nama_jabatan=='kasir' || $hasil_jabatan->kode_jabatan=='001'){}else{?>
            <a onclick="tutup_kasir()" style="margin-left: 10px;" class="small-box col-md-2 btn pull-right bg-red-gradient">
              <div class="inner">
                <i class="fa fa-sign-out"></i>
                <h5 style="font-size:15px; font-weight:bold">Tutup Kasir</h5>
                <?php
                $this->db->select_max('kode_transaksi');
                $kasir = $this->db->get_where('transaksi_kasir',array('tanggal'=>date("Y-m-d"),'status'=>"open"));
                $hasil_cek_kasir = $kasir->row();
                ?>
                <input type="hidden" id="kasir" value="<?php echo $hasil_cek_kasir->kode_transaksi; ?>" />
              </div>
            </a><?php }?> 
          </div>

          <div class="box-body">
            <div class="row">





            </div>
          <!--   <div class="col-md-3">
               <div class="checkbox">
                   <input autofocus type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Nama Produk" />
            </div>
            </div>
             <div class="col-md-3">
               <div class="checkbox">
                   <input autofocus type="text" name="harga_produk" id="harga_produk" class="form-control" placeholder="Harga Produk" />
                 </div> -->
               </div>







               <form action="<?php echo base_url().'kasir/simpan_pembayaran'; ?>" method="post" id="inputform">
                <section class="col-lg-12 connectedSortable">
                  <div class="box box-info">
                    <!--<div class="box-header">-->
                    <!-- tools box -->
                      <!--<div class="callout callout-info">
                      <span style="font-size: large; color: black;" class="pull-left">Pesanan Meja <?php echo $this->uri->segment(3); ?></span>
                      <div style="margin-left: 566px;">-->
               <!-- <a onclick="$('#modal-pindah').modal('show')" class="btn red btn-sm"><i class="icon-share"></i> Pindah Meja</a>
               <a onclick="$('#modal-gabung').modal('show')" class="btn dark btn-sm"><i class="icon-resize-small"></i> Gabung Meja</a>
               <a onclick="print('order-list')" class="btn yellow btn-sm" <?php echo ($meja=='Take-away') ? 'style="display:none"':'' ?>>
                  <i class="icon-print"></i> Pesan
                </a> -->
               <!--<?php $kode_meja = $this->uri->segment(3); if(!empty($kode_meja)){ ?>
               <a href="<?php echo base_url().'kasir/bayar_personal/'.$kode_meja ?>" style="text-decoration: none;" class="btn green btn-sm"><i class="fa fa-dollar"></i> Bayar Personal</a>
               <a onclick="pindah_meja()" style="text-decoration: none;" class="btn btn-warning btn-sm"><i class="fa fa-table"></i> Pindah Meja</a>
               <a onclick="gabung_meja()" style="text-decoration: none;" class="btn purple btn-sm"><i class="fa fa-bookmark"></i> Gabung Meja</a>
               <?php } ?>
               <a onclick="print()" style="text-decoration: none;" class="btn red btn-sm"><i class="fa fa-print"></i> Print Guest Bill</a>
               <a onclick="cetak_pesanan()" style="text-decoration: none;" class="btn green btn-sm"><i class="fa fa-print"></i> Print Pesanan</a>
            </div>
          </div>-->
          <!-- /. tools -->
          <!--</div>-->
          <?php
          $tgl = date("Y-m-d");
          $no_belakang = 0;
          $this->db->select_max('kode_penjualan');
          $kode = $this->db->get_where('transaksi_penjualan',array('tanggal_penjualan'=>$tgl));
          $hasil_kode = $kode->row();
                                        #$pecah_kode = explode("_",$hasil_kode_pembelian->kode_pembelian);
                                        #echo $pecah_kode[0];
                                        #echo $pecah_kode[2];
          $this->db->select('kode_penjualan');
          $kode_penjualan = $this->db->get('master_setting');
          $hasil_kode_penjualan = $kode_penjualan->row();
          if(count($hasil_kode)==0){
            $no_belakang = 1;
          }
          else{
            $pecah_kode = explode("_",$hasil_kode->kode_penjualan);
            $no_belakang = @$pecah_kode[2]+1;
          }
          $this->db->select_max('kode_transaksi');
          $kasir = $this->db->get_where('transaksi_kasir',array('tanggal'=>$tgl,'status'=>"open"));
          $hasil_cek_kasir = $kasir->row();
                                        #echo $this->db->last_query();
          ?>
          <input readonly="true" type="hidden" value="<?php echo @$hasil_kode_penjualan->kode_penjualan."_".date("dmyHis")."_".$no_belakang ?>" placeholder="Kode Transaksi" name="kode_penjualan" id="kode_penjualan" />
          <input type="hidden" name="kode_meja" id="kode_meja" value="<?php echo $this->uri->segment(3); ?>" />
          <input type="hidden" value="<?php echo TanggalIndo(date("Y-m-d")); ?>" readonly="true"  placeholder="Tanggal Transaksi" name="tanggal_pembelian" id="tanggal_penjualan"/>
          <div class="sukses" ></div>
          <div class="notif_stok" ></div>
          <div class="box-body">


<!-- 
          <div class="col-md-5" id="col_auto">
                  <span>Auto</span><input autofocus type="text" name="barcode" id="barcode" class="form-control" placeholder="" /><br>
              </div>

              <div class="col-md-4">
                  <input autofocus type="text" name="barcode_manual" id="barcode_manual" class="form-control" placeholder="" /></br>
                </div> -->
                <div class="col-md-8">

                  <table id="col_auto" class="table table-striped table-bordered table-advance table-hover" width="40%;">
                    <tbody >
                      <form >
                        <tr>
                         <td width="100px" style="background-color:#229fcd;">
                          <input autofocus type="text" name="barcode" id="barcode" class="form-control" placeholder="" />

                        </td>
                        <td width="100px" style="background-color:#229fcd;">
                          <input type="text" name="" id="" class="form-control" value="Mode Barcode : Auto" style="background-color:#229fcd;" /></td>
                          
                        </tr>
                      </form>
                    </tbody>
                  </table>


                  <table id="col_manual" class="table table-striped table-bordered table-advance table-hover">
                    <tbody >
                      <form >
                        <tr>



                         <td width="100px" style="background-color:#229fcd;">
                           <input autofocus type="text" name="barcode_manual" id="barcode_manual" class="form-control" placeholder="" />

                         </td>
                         <td width="100px" style="background-color:#229fcd;">
                          <input type="text" name="" id="" class="form-control" value="Mode Barcode : Manual" style="background-color:#229fcd;" /></td>
                          
                        </tr>
                      </form>
                    </tbody>
                  </table>


                  <table id="" class="table table-striped table-bordered table-advance table-hover">
                    <tbody >
                      <form id="panelForm">
                        <tr>

                          <td id="panelForm1" colspan="2" style="background-color:#229fcd;">
                            <input type="text" name="id_penjualan" id="id_penjualan" value="" hidden/>
                            <?php
                            $menu_resto = $this->db->get_where('master_menu',array('status'=>'1'));
                            $hasil_menu = $menu_resto->result();
                            ?>
                            <select name="menu" onchange="get_harga()" id="menu" class="form-control select2">
                             <option value="" selected="true">--Pilih Produk--</option>
                             <?php
                             foreach($hasil_menu as $daftar){
                               ?>
                               <option value="<?php echo $daftar->kode_menu; ?>"><?php echo $daftar->nama_menu; ?></option>
                               <?php } ?>
                             </select>
                           </td>

                           <td width="100px" style="background-color:#229fcd;">

                            <input type="text" name="qty" id="qty" class="form-control" placeholder="jumlah"/>
                            <input type="hidden" id="kode_kasir" value="<?php echo $hasil_cek_kasir->kode_transaksi; ?>" />
                            <input type="hidden" name="qty" id="qty2" class="form-control" placeholder="Jumlah"></td>

                            <td width="100px" style="background-color:#229fcd;">
                              <input type="text" name="diskon" id="diskon_item" class="form-control" placeholder="Diskon">
                              <input type="hidden" name="kode_edit_penjualan" id="kode_edit_penjualan" />
                            </td>
                            <td width="100px"style="background-color:#229fcd;" >
                              <div id="tambah_pesanan" class="btn purple">Add</div>
                              <div id="update" onclick="editData()" class="btn purple">Update</div>
                            </td>
                          </tr>
                        </form>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-8">
                    <table style="white-space: nowrap;" id="data" class="table table-bordered  table-hover">
                      <thead>
                        <tr>
                          <th style="background-color:#229fcd; color:white" class="text-center" width="50px">No.</th>
                          <th style="background-color:#229fcd; color:white" class="text-center">Nama Produk</th>
                          <!--<th style="background-color:#229fcd; color:white" class="text-center" width="50px">Keterangan</th>-->
                          <th style="background-color:#229fcd; color:white" class="text-center" width="50px">Qty</th>
                          <th style="background-color:#229fcd; color:white" class="text-center" width="125px">Harga</th>
                          <th style="background-color:#229fcd; color:white" class="text-center" width="125px">Subtotal</th>
                          <th style="background-color:#229fcd; color:white" class="text-center" width="100px">Diskon (%)</th>
                          <th style="background-color:#229fcd; color:white" class="text-center" width="170px">Action</th>
                        </tr>
                      </thead>
                      <tbody id="tb_pesan_temp">

                      </tbody>
                      <tfoot>
                      </tfoot>
                    </table>
                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon">Diskon(%)</span>
                        <span id="dibayar">
                          <input type="text" data-index="1" onkeyup="diskon_persen()" class="form-control" name="persen" id="persen" />
                        </span>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon">Diskon(Rp)</span>
                        <span id="dibayar">
                          <input type="text" data-index="2" onkeyup="diskon_rupiah()" class="form-control" name="rupiah" id="rupiah" />
                        </span>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <div style="height: 40px;" class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">Jenis Transaksi</span>
                          <span id="golongan">
                            <select class="form-control" id="jenis_transaksi" name="jenis_transaksi">
                              <option selected="true" value="tunai">Tunai</option>
                              <option value="debet">Debet</option>
                              <option value="kredit">Kredit</option>
                              <option value="compliment">Compliment</option>

                            </select>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" style="font-size: x-large;font-weight: bolder;"><strong>Dibayar</strong></span>
                          <span id="dibayar">
                            <input type="hidden" id="total_no" />
                            <input type="hidden" id="total2" />
                            <input type="hidden" id="kembalian2" />
                            <input type="hidden" id="hutang2" />
                            <input style="font-size: 30px;" data-index="3" onkeyup="kembalian()" type="text" class="form-control input-lg" name="bayar" id="bayar" />
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div style="margin-top: -70px;" class="col-md-4">
                    <div class="bg-yellow" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
                      <span style="font-size:22px; " class="pull-right" id="total_pesanan"></span>
                      <i style="font-size:56px; margin-top:5px"></i>
                      <p>Total</p>
                    </div>
                    <div class="bg-red" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
                      <span style="font-size:22px; " class="pull-right" id="diskon_all">Rp 0</span>
                      <i style="font-size:56px; margin-top:5px"></i>
                      <p>Discount</p>
                    </div>
                    <div class="bg-blue" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
                      <span style="font-size:22px; " class="pull-right" id="grand_total">Rp 0</span>
                      <i style="font-size:56px; margin-top:5px"></i>
                      <p>Grand Total</p>
                    </div>
                        <!--<div style="">
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon">Kode Member</span>
                                <span>
                                  <input onkeyup="get_member()" type="text" class="form-control" name="kode_member" id="kode_member" />
                                </span>
                                
                              </div>
                            </div>
                        </div>
                        <div style="">
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon">Nama Member</span>
                                <span>
                                  <input readonly="true" type="text" class="form-control" name="nama_member" id="nama_member" />
                                </span>
                                
                              </div>
                            </div>
                        </div>
                        <div style="">
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon">Waiter</span>
                                <span>
                                  <input type="text" class="form-control" name="waiter" id="waiter" />
                                </span>
                                
                              </div>
                            </div>
                          </div>-->
                          <div id="div-kembali" class="bg-purple" style="height:40px; padding: 0px 10px 0px 10px; margin-top:5px">
                            <span style="font-size:26px; " class="pull-right totalDiskon" id="kembalian">Rp 0</span>
                            <i style="font-size:56px; margin-top:5px"></i>
                            <p>Kembalian</p>
                          </div>

                          <div id="div-hutang" class="bg-purple" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px; display:none;">
                            <span style="font-size:26px; " class="pull-right totalDiskon" id="hutang">Rp 0</span>
                            <i style="font-size:56px; margin-top:5px"></i>
                            <p>Hutang</p>
                          </div>


                        <!--<div class="bg-green" style="height:55px; padding: 10px 10px 0px 10px; margin-top:35px">
                            <button class="btn btn-large btn-default" style="width:100%" onClick="list_suspend()">LIST PESANAN</button>
                          </div>-->
                        </div>
                        <!--<a data-index="4" onclick="bayar()"  style="margin: 10px;width: 355;" class="small-box col-md-2 btn pull-right bg-green-active">
                        
                          <div class="inner">

                            <center><span style="font-size:35px; font-weight: bold; "><i class="fa fa-money"></i> Bayar</span></center>

                          </div>
                        </a>-->
                        <button  id="submit" data-index="4" style="margin: 10px;width: 355;" class="small-box col-md-2 btn pull-right bg-green-active"><center><span style="font-size:35px; font-weight: bold; "><i class="fa fa-money"></i> Bayar</span></center></button>
                        <div class="col-md-8">
                          <input type="hidden" id="id_meja" value="<?php echo $this->uri->segment(3); ?>" />

                          <a id="buka" style="width: 300px;" onclick="bukameja()" class="btn btn-lg blue" href="#">
                            <i class="fa fa-sign-in"></i> Buka Meja
                          </a>
                          <?php $kode_meja = $this->uri->segment(3); if(!empty($kode_meja)){ ?>
                          <a id="tutup" style="width: 300px;" onclick="tutupmeja()" class="btn btn-lg red" href="#">
                            <i class="fa fa-eject"></i> Tutup Meja
                          </a>
                          <?php } ?>
                        </div>
                        <div>
                         <?php if($hasil_jabatan->nama_jabatan=='kasir' || $hasil_jabatan->kode_jabatan=='001'){}else{?>
                         <a style=" margin-top: 30px;" class="btn btn-lg btn-success col-md-12" href="<?php echo base_url('kasir/'); ?>">
                          <i class="fa fa-backward"></i> Kembali
                        </a><?php }?>
                      </div>
                    </form>
                  </div>
                </div>       
              </div>  
            </div>
          </section><!-- /.Left col -->      
          <?php 
          $user = $this->session->userdata('astrosession');
          $modul = $user->modul;
          $modul_pecah = explode("|",$modul);
          if(in_array('Setting',$modul_pecah)){ 
            ?>
            <div onclick="setting()" class="btn green " style="position: fixed; bottom: 29px; right: 0px; " ><i class="fa fa-gears ngeling"></i></div>
            <?php } ?>
          </div><!-- /.row (main row) -->
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
              <a onclick="delData()" class="btn red">Ya</a>
            </div>
          </div>
        </div>
      </div>
      <div id="modal-regular" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="cari_nota" method="post">
              <div class="modal-header" style="background-color:grey">
                <button type="button" class="close" onclick="" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color:#fff;">Pindah Meja</h4>
              </div>
              <div class="modal-body" >
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Dari Meja</label>
                        <input readonly="true" type="text" id="meja_asal" class="form-control" value="<?php echo $this->uri->segment(3); ?>" />
                      </div>
                    </div>
                  </div>
                  <div id="edit_hide" class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Menuju Meja</label>
                        <?php
                        $meja = $this->db->get_where('master_meja',array('no_meja !='=>$this->uri->segment(3),'status'=>'0'));
                        $hasil_meja = $meja->result();
                        ?>
                        <select class="form-control" name="meja_akhir" id="meja_akhir">
                         <option selected="true" value="">--Pilih Meja--</option>
                         <?php foreach($hasil_meja as $daftar){ ?>
                         <option value="<?php echo $daftar->no_meja ?>"><?php echo $daftar->no_meja; ?></option>
                         <?php } ?>
                       </select> 
                     </div>
                   </div>
                 </div>
                 <div class="row">
                  <div class="col-md-12">
                    <div class="sukses" ></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="background-color:#eee">
              <div class="btn blue" data-dismiss="modal" aria-hidden="true">Cancel</div>
              <div onclick="simpan_pindah_meja()" class="btn green">Pindah Meja</div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="modal-print" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="cari_nota" method="post">
            <div class="modal-header" style="background-color:grey">
              <button type="button" class="close" onclick="" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
            </div>
            <div class="modal-body" >
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label style="font-size: 12pt;" class="control-label">Apakah anda ingin mencetak struk lagi ?</label>
                      <!--<input readonly="true" type="text" id="meja_asal" class="form-control" value="<?php echo $this->uri->segment(3); ?>" />-->
                    </div>
                  </div>
                </div>
                <div id="edit_hide" class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                            <!--<label style="font-size: 12pt;" class="control-label"></label><br />
                            <?php
                            $this->db->select('kode_ruang');
                            $ruang = $this->db->get_where('master_meja',array('no_meja'=>$this->uri->segment(3)));
                            $hasil_ruang = $ruang->row();
                            $meja = $this->db->get_where('master_meja',array('kode_ruang'=>$hasil_ruang->kode_ruang,'no_meja !='=>$this->uri->segment(3),'status'=>'0'));
                            $hasil_meja = $meja->result();
                                      #echo $this->db->last_query();
                            ?>

                            <?php foreach($hasil_meja as $daftar){ ?>
                            <input name="digabung" type="checkbox" value="<?php echo $daftar->no_meja ?>"/><span style="font-size: 12pt;"><?php echo $daftar->no_meja; ?></span><br />
                            <?php } ?> -->

                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="sukses_gabung" ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer" style="background-color:#eee">
                    <div onclick="bayar()" class="btn green">Ya</div>
                    <div onclick="cancel()" class="btn blue" >Tidak</div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div id="modal-gabung" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="cari_nota" method="post">
                  <div class="modal-header" style="background-color:grey">
                    <button type="button" class="close" onclick="" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" style="color:#fff;">Gabung Meja</h4>
                  </div>
                  <div class="modal-body" >
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label style="font-size: 12pt;" class="control-label">Dari Meja</label>
                            <input readonly="true" type="text" id="meja_asal" class="form-control" value="<?php echo $this->uri->segment(3); ?>" />
                          </div>
                        </div>
                      </div>
                      <div id="edit_hide" class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label style="font-size: 12pt;" class="control-label">Dengan Meja</label><br />
                            <?php
                            $this->db->select('kode_ruang');
                            $ruang = $this->db->get_where('master_meja',array('no_meja'=>$this->uri->segment(3)));
                            $hasil_ruang = $ruang->row();
                            $meja = $this->db->get_where('master_meja',array('kode_ruang'=>$hasil_ruang->kode_ruang,'no_meja !='=>$this->uri->segment(3),'status'=>'0'));
                            $hasil_meja = $meja->result();
                                      #echo $this->db->last_query();
                            ?>

                            <?php foreach($hasil_meja as $daftar){ ?>
                            <input name="digabung" type="checkbox" value="<?php echo $daftar->no_meja ?>"/><span style="font-size: 12pt;"><?php echo $daftar->no_meja; ?></span><br />
                            <?php } ?> 

                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="sukses_gabung" ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer" style="background-color:#eee">
                    <div class="btn blue" data-dismiss="modal" aria-hidden="true">Cancel</div>
                    <div onclick="simpan_gabung_meja()" class="btn green">Gabung Meja</div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div id="modal_setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
            <div class="modal-dialog" style="width:1000px;">
              <div class="modal-content" >
                <div class="modal-header" style="background-color:grey">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                  <label><b><i class="fa fa-gears"></i>Setting</b></label>
                </div>

                <form id="form_setting" >
                  <div class="modal-body">


                    <div class="box-body">

                      <div class="row">
                        <div class="col-xs-6">
                          <div class="form-group">
                            <label>Note</label>
                            <input type="text" name="keterangan"  class="form-control" />
                          </div>

                        </div>
                      </div>

                    </div>

                    <div class="modal-footer" style="background-color:#eee">
                      <button class="btn red" data-dismiss="modal" aria-hidden="true">Cancel</button>
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <script type="text/javascript">

            function startTime() {
              var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              var date = new Date();
              var day = date.getDate();
              var month = date.getMonth();
              var yy = date.getYear();
              var year = (yy < 1000) ? yy + 1900 : yy;
              //document.write(day + " " + months[month] + " " + year);
              var today=new Date(),
              curr_hour=today.getHours(),
              curr_min=today.getMinutes(),
              curr_sec=today.getSeconds();
              curr_hour=checkTime(curr_hour);
              curr_min=checkTime(curr_min);
              curr_sec=checkTime(curr_sec);
              document.getElementById('clock').innerHTML=day + " " + months[month] + " " + year+" "+curr_hour+":"+curr_min+":"+curr_sec;
            }
            function checkTime(i) {
              if (i<10) {
                i="0" + i;
              }
              return i;
            }
            setInterval(startTime, 500);

            $('#barcode').on('keydown', function(event) {

             if (event.which == 13) {
              event.preventDefault();
              var url = "<?php echo base_url().'kasir/get_produk'; ?>";
              var id_menu = $("#barcode").val();
              $.ajax( {
               type:"POST", 
               url : url,  
               cache :false,  
               data :{id_menu:id_menu},
               beforeSend: function(){
                 $(".loading").show(); 
               },
                beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  
                var hasil=data.split('|');



                simpan_pesanan_otomatis();
                $("#barcode").val('');
                $("#barcode").focus();
              },  
              error : function(data) {  
                alert(data);  
              }  
            });
            }
          });


            $('#barcode_manual').on('keydown', function(event) {

             if (event.which == 13) {
              event.preventDefault();
              var url = "<?php echo base_url().'kasir/get_produk_manual'; ?>";
              var id_menu = $("#barcode_manual").val();
              $.ajax( {
               type:"POST", 
               url : url,  
               cache :false,  
               data :{id_menu:id_menu},
               beforeSend: function(){
                 $(".loading").show(); 
               },
                beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  

                $("#panelForm1").html('');
                $("#panelForm1").html(data);

                $("#qty").focus();
                  // simpan_pesanan_manual();
                },  
                error : function(data) {  
                  alert(data);  
                }  
              });
            }
          });

            $('#qty').on('keydown', function(event) {

             if (event.which == 68) {
              event.preventDefault();
              $("#diskon_item").focus();
            }
            else if (event.which == 13) {
              event.preventDefault();
              tambah_pesanan();
              $("#barcode_manual").val('');
              $("#barcode_manual").focus();
            }
          });

            $('#diskon_item').on('keydown', function(event) {

             if (event.which == 13) {
              event.preventDefault();
              tambah_pesanan();
              $("#barcode_manual").val('');
              $("#barcode_manual").focus();
            }
          });


            $('#barcode').on('keydown',function(event) {

             if (event.which == 17) {
              event.preventDefault();
               //alert('asdasd');
               $('#col_auto').hide();
               $('#col_manual').show();
               $('#barcode_manual').focus();

             }
           });
            $('#barcode_manual').on('keydown',function(event) {

             if (event.which == 17) {
              event.preventDefault();
               //alert('asdasd');
               $('#col_auto').show();
               $('#col_manual').hide();
               $('#barcode').focus();

             }
           });
            function setting() {
              $('#modal_setting').modal('show');
            }

            function tutupmeja(){
              var url = "<?php echo base_url().'kasir/tutup_meja'; ?>";
              var id_meja = $("#id_meja").val();
              $.ajax( {
               type:"POST", 
               url : url,  
               cache :false,  
               data :{id_meja:id_meja},
               beforeSend: function(){
                 $(".loading").show(); 
               },
                beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {
                if(data=='gagal'){
                  $(".sukses").html("<div class='alert alert-warning'>Pesanan Belum Dibayar</div>");
                  setTimeout(function(){$('.sukses').html('');},1500); 
                }else if(data=='berhasil'){
                  setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() .'kasir/' ?>";},1000);
                }
              },  
              error : function(data) {  
                alert(data);  
              }  
            });
            }
            function bukameja(){
              var url = "<?php echo base_url().'kasir/buka_meja'; ?>";
              var id_meja = $("#id_meja").val();
              $.ajax( {
               type:"POST", 
               url : url,  
               cache :false,  
               data :{id_meja:id_meja},
               beforeSend: function(){
                 $(".loading").show(); 
               },
                beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  
                window.location.reload();
              },  
              error : function(data) {  
                alert(data);  
              }  
            });
            }

            function simpan_pesanan_manual(){
              var kode_penjualan = $("#kode_penjualan").val();
              var tanggal_penjualan = $("#tanggal_penjualan").val();
              var nomor_nota =$("#nomor_nota").val();
              var menu = $("#barcode").val();
              var jumlah = '1';
              var diskon ='0';
              var kode_kasir = $("#kode_kasir").val();

              var url = "<?php echo base_url().'kasir/simpan_item_penjualan_temp'; ?>";

              $.ajax({
                type: "POST",
                url: url,
                data: { kode_penjualan:kode_penjualan,
                  kode_menu:menu,
                  jumlah:jumlah,
                  diskon_item:diskon,
                  kode_kasir:kode_kasir

                },
                success: function(data)
                {
                  if(data == 'tidak cukup'){
                    $(".notif_stok").html('<div class="alert alert-warning">Stok Produk Tidak Mencukupi</div>');
                    setTimeout(function(){
                      $('.notif_stok').html('');
                    },1700);              
                  }else{
                    $("#tb_pesan_temp").load("<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>"+kode_penjualan);
                    $("#nama_produk").val('');
                    $('#nama_produk').select2().trigger('change');
                    $("#qty").val('');
                    $("#diskon_item").val('');
                    totalan();
                    grand_total();
                    cek_status();
                  }
                }
              });
}
function simpan_pesanan_otomatis(){
  var kode_penjualan = $("#kode_penjualan").val();
  var tanggal_penjualan = $("#tanggal_penjualan").val();
  var nomor_nota =$("#nomor_nota").val();
  var menu = $("#barcode").val();
  var jumlah = '1';
  var diskon ='0';
  var kode_kasir = $("#kode_kasir").val();

  var url = "<?php echo base_url().'kasir/simpan_item_penjualan_temp'; ?>";

  $.ajax({
    type: "POST",
    url: url,
    data: { kode_penjualan:kode_penjualan,
      kode_menu:menu,
      jumlah:jumlah,
      diskon_item:diskon,
      kode_kasir:kode_kasir

    },
    success: function(data)
    {
      if(data == 'tidak cukup'){
        $(".notif_stok").html('<div class="alert alert-warning">Stok Produk Tidak Mencukupi</div>');
        setTimeout(function(){
          $('.notif_stok').html('');
        },1700);              
      }else{
        $("#tb_pesan_temp").load("<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>"+kode_penjualan);
        $("#nama_produk").val('');
        $('#nama_produk').select2().trigger('change');
        $("#qty").val('');
        $("#diskon_item").val('');
        totalan();
        grand_total();
        cek_status();
      }
    }
  });
}

$('#tambah_pesanan').click(function() {
  tambah_pesanan();
});

function tambah_pesanan() {
  var kode_penjualan = $("#kode_penjualan").val();
  var tanggal_penjualan = $("#tanggal_penjualan").val();
  var nomor_nota =$("#nomor_nota").val();
  var menu = $("#menu").val();
  var jumlah = $("#qty").val();
  var diskon = $("#diskon_item").val();
  var kode_kasir = $("#kode_kasir").val();

  var url = "<?php echo base_url().'kasir/simpan_item_penjualan_temp'; ?>";

  $.ajax({
    type: "POST",
    url: url,
    data: { kode_penjualan:kode_penjualan,
      kode_menu:menu,
      jumlah:jumlah,
      diskon_item:diskon,
      kode_kasir:kode_kasir

    },
    success: function(data)
    {
      if(data == 'tidak cukup'){
        $(".notif_stok").html('<div class="alert alert-warning">Stok Produk Tidak Mencukupi</div>');
        setTimeout(function(){
          $('.notif_stok').html('');
        },1700);              
      }else{
        $("#tb_pesan_temp").load("<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>"+kode_penjualan);
        $("#menu").val('');
        $('#menu').select2().trigger('change');
        $("#qty").val('');
        $("#diskon_item").val('');
        totalan();
        grand_total();
        cek_status();
      }
    }
  });
};

function get_harga(){
  var url = "<?php echo base_url().'kasir/get_harga'; ?>";
  var id_menu = $("#menu").val();
  $.ajax( {
   type:"POST", 
   url : url,  
   cache :false,  
   data :{id_menu:id_menu},
   beforeSend: function(){
     $(".loading").show(); 
   },
    beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  
    $("#harga").val(data);
  },  
  error : function(data) {  
    alert(data);  
  }  
});
}
function actEdit(id) {
  var id = id;
  var url = "<?php echo base_url().'kasir/get_pesanan_temp'; ?>";
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
      $("#keterangan").val(kasir.keterangan);
      $("#kode_edit_penjualan").val(kasir.kode_penjualan);
      $("#tb_pesan_temp").load('<?php echo base_url().'kasir/pesanan_temp/'.$this->uri->segment(3); ?>');
    }
  });
  $("#update").show();
  $("#tambah").hide();
}

function editData(){

  var url = "<?php echo base_url().'kasir/simpan_ubah_pesanan_temp'; ?>";
    //var kode_penjualan = $("#kode_penjualan").val();
    var kode_meja = $("#kode_meja").val();
    var menu = $("#menu").val();
    var jumlah_awal = $("#qty2").val();
    var jumlah = $("#qty").val();
    var harga = $("#harga").val();
    var diskon = $("#diskon_item").val();
    var keterangan = $("#keterangan").val();
    kode_penjualan = $("#kode_edit_penjualan").val();
    $.ajax( {
     type:"POST", 
     url : url,  
     cache :false,  
     data :{kode_penjualan:kode_penjualan,kode_meja:kode_meja,kode_menu:menu,jumlah:jumlah,
      diskon_item:diskon,harga_satuan:harga,jumlah_awal:jumlah_awal,keterangan:keterangan
    },
    beforeSend: function(){
     $(".loading").show(); 
   },
    beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {
    $("#tb_pesan_temp").load('<?php echo base_url().'kasir/pesanan_temp/'.$this->uri->segment(3); ?>');
    $("#menu").val('');
    $("#qty").val('');
    $("#diskon_item").val('0');
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
    $("#tambah").show();
    $("#update").hide();
  }
  function actDelete(Object) {
    $('#id-delete').val(Object);
    $('#modal-confirm').modal('show');
  }
  function delData() {
    var id = $('#id-delete').val();
    var kode_penjualan = $('#kode_penjualan').val() ;
    var url = '<?php echo base_url().'kasir/hapus_pesanan_temp'; ?>/delete';
    $.ajax({
      type: "POST",
      url: url,
      data: {
        id:id
      },
      success: function(msg) {
        $('#modal-confirm').modal('hide');
        $("#tb_pesan_temp").load("<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>"+kode_penjualan);
        totalan();
        grand_total();
      }
    });
    return false;
  }
  function diskon_persen(){
    //var no_meja = $("#kode_meja").val();
    var kode_penjualan = $("#kode_penjualan").val();
    var diskon_persen = $("#persen").val();
    var url = "<?php echo base_url().'kasir/diskon_persen'; ?>";
    $.ajax({
      type: 'POST',
      url: url,
      //data: {no_meja:no_meja,diskon_persen:diskon_persen},
      data: {kode_penjualan:kode_penjualan,diskon_persen:diskon_persen},
      success: function(total){
        var rupiah = Math.round((diskon_persen/100 )*total);
        $("#rupiah").val(rupiah);
        diskon_all();
        grand_total();
      }
    });
  }
  function diskon_rupiah(){
    //var no_meja = $("#kode_meja").val();
    var kode_penjualan = $("#kode_penjualan").val();
    var diskon_rupiah = $("#rupiah").val();
    var url = "<?php echo base_url().'kasir/diskon_persen'; ?>";
    $.ajax({
      type: 'POST',
      url: url,
      //data: {no_meja:no_meja,diskon_rupiah:diskon_rupiah},
      data: {kode_penjualan:kode_penjualan,diskon_rupiah:diskon_rupiah},
      success: function(total){
        var persen = Math.round(diskon_rupiah/total*100);
        $("#persen").val(persen);
        diskon_all();
        grand_total();
      }
    });
  }
  function totalan() {
    //var no_meja = $("#kode_meja").val();
    var kode_penjualan = $("#kode_penjualan").val();
    var url = "<?php echo base_url().'kasir/get_total_temp'; ?>";
    $.ajax({
      type: 'POST',
      url: url,
      dataType:'json',
      //data: {no_meja:no_meja},
      data: {kode_penjualan:kode_penjualan},
      success: function(kasir){
        $("#total_pesanan").text(kasir.total);
        $("#grand_total").text(kasir.total);
        $("#total2").val(kasir.total2);
      }
    });
  }
  function diskon_all(){
    var url = "<?php echo base_url().'kasir/diskon_all'; ?>";
    var rupiah = $("#rupiah").val();
    $.ajax({
      type: 'POST',
      url: url,
      data: {rupiah:rupiah},
      success: function(rupiah){
        $("#diskon_all").text(rupiah);
      }
    });
  }
  function grand_total(){
   var url = "<?php echo base_url().'kasir/grand_total'; ?>";
   var rupiah = $("#rupiah").val();
   //var no_meja = $("#kode_meja").val();
   var kode_penjualan = $("#kode_penjualan").val();
   $.ajax({
    type: 'POST',
    url: url,
    dataType:'json',
    //data: {rupiah:rupiah,no_meja:no_meja},
    data: {rupiah:rupiah,kode_penjualan:kode_penjualan},
    success: function(rupiah){
      $("#grand_total").text(rupiah.total_grand);
      $("#total_no").val(rupiah.total_no);
    }
  });
 }
 function kembalian(){
  var url = "<?php echo base_url().'kasir/kembalian'; ?>";
  var dibayar = $("#bayar").val();
  var total = $("#total_no").val();
  $.ajax({
    type: 'POST',
    url: url,
    dataType:'json',
    data: {total:total,dibayar:dibayar},
    success: function(rupiah){
      $("#kembalian").text(rupiah.kembalian1);
      $("#kembalian2").val(rupiah.kembalian2);
      $("#hutang").text(rupiah.hutang1);
      $("#hutang2").val(rupiah.hutang2);
    }
  });
}
function bayar(){
  var url = "<?php echo base_url().'kasir/simpan_pembayaran'; ?>";
  //var kode_meja = $("#kode_meja").val();
  var kode_penjualan = $("#kode_penjualan").val();
  var total_pesanan = $("#total2").val();
  var persen = $("#persen").val();
  var rupiah = $("#rupiah").val();
  var grand_total = $("#total_no").val();
  var jenis_transaksi = $("#jenis_transaksi").val();
  var kembalian = $("#kembalian2").val();
  var hutang = $("#hutang2").val();
  var bayar = $("#bayar").val();
  //var kode_member = $("#kode_member").val();
  //var nama_member = $("#nama_member").val();
  //var waiter = $("#waiter").val();
  if(bayar==""){
    $(".sukses").html('<div class="alert alert-warning">Pembayaran masih kosong</div>');
    setTimeout(function(){$('.sukses').html('');},1500);  
  }else{
    //if(nama_member=="" && jenis_transaksi=="kredit"){
    //  $(".sukses").html('<div class="alert alert-warning">Pembayaran kredit hanya digunakan untuk member</div>');
    //}else{
     $.ajax({
      type: 'POST',
      url: url,
      data: {//kode_meja:kode_meja,
        kode_penjualan:kode_penjualan,
        bayar:bayar,
        kembalian:kembalian,
        hutang:hutang,
        total_pesanan:total_pesanan,
        persen:persen,
        rupiah:rupiah,
        grand_total:grand_total,
        jenis_transaksi:jenis_transaksi
        //kode_member:kode_member,
        //nama_member:nama_member,
        //waiter:waiter
      },
      success: function(data){
        $(".sukses").html('<div class="alert bg-gray">Pembayaran Menu Berhasil</div>');
        var link = "<?php echo base_url('kasir/cetak_pembayaran'); ?>";

        $.ajax({
         type: "POST",
         url: link,
         data:{
            //kode_meja:kode_meja,
            kode_penjualan:kode_penjualan,jenis_transaksi:jenis_transaksi
          },
          success: function(msg)
          {
                       //alert(msg);

                     }
                   });
     //setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'kasir/' ?>";},1000);  
     cetakStruck();
   }
 });
   //}
 }

}
function pindah_meja(){
  $('#modal-regular').modal('show'); 
}

function cetakStruck(){
  $('#modal-print').modal('show');
}

function cancel() {
  setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'kasir/' ?>";},1000);
}

function gabung_meja(){
  $('#modal-gabung').modal('show'); 
}

function simpan_pindah_meja(){
  var url = "<?php echo base_url().'kasir/pindah_meja'; ?>";
  var meja_asal = $("#meja_asal").val();
  var meja_akhir = $("#meja_akhir").val();
  $.ajax({
    type: 'POST',
    url: url,
    data: {meja_asal:meja_asal,meja_akhir:meja_akhir},
    success: function(data){
      $(".sukses").html('<div class="alert alert-success">Berhasil Pindah Meja</div>');
      setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'kasir/menu_kasir/' ?>"+meja_akhir;},1000);  
    }
  });
}
function simpan_gabung_meja(){
  var url = "<?php echo base_url().'kasir/gabung_meja'; ?>";
  var kode_meja = $("#kode_meja").val();
  var gabungan = [];
  $("input[name='digabung']:checked").each(function(){
   gabungan.push($(this).val()); 
 });
  $.ajax({
    type: 'POST',
    url: url,
    data: {kode_meja:kode_meja,gabungan:gabungan},
    success: function(data){
      if(data=='belum pesan'){
        $(".sukses_gabung").html('<div class="alert alert-warning">Menu Belum Dipesan Silakan Pesan Menu</div>');
        setTimeout(function(){$(".sukses_gabung").html(''); },2000);
      }else{
        $(".sukses_gabung").html('<div class="alert alert-success">Berhasil Gabung Meja</div>');
        setTimeout(function(){$('#modal-gabung').modal('hide'); },1500);
        cek_status(); 
      }


    }
  });
}

function cek_status(){
  var kode_meja = $("#id_meja").val();
  var url = "<?php echo base_url().'kasir/cek_status'; ?>";
  $.ajax({
    type: 'POST',
    url: url,
    data: {kode_meja:kode_meja},
    success: function(hasil){
      if(hasil=='aktif'){
        $("#buka").show();
        $("#tutup").hide();
      }else{
        $("#buka").hide();
        $("#tutup").show();
      }
    }
  });
}

function print() {
  var url = "<?php echo base_url('kasir/cetak_bill'); ?>";
  var kode_meja = $("#kode_meja").val();
  $.ajax({
   type: "POST",
   url: url,
   data:{
    kode_meja:kode_meja
  },
  success: function(msg)
  {
           //alert(msg);

         }
       });
}

function cetak_pesanan() {
  var url = "<?php echo base_url('kasir/cetak_pesanan'); ?>";
  var kode_meja = $("#kode_meja").val();
  $.ajax({
   type: "POST",
   url: url,
   data:{
    kode_meja:kode_meja
  },
  success: function(msg)
  {
           //alert(msg);

         }
       });
}

/*function diskon_per_item(){
    var harga = $("#harga").val();
    var diskon = $("#diskon_item").val();
    var url = "<?php #echo base_url().'kasir/diskon_per_item'; ?>";
    $.ajax( {
       type:"POST", 
        url : url,  
        cache :false,  
        data :{harga:harga,diskon:diskon},
        beforeSend: function(){
         $(".loading").show(); 
       },
        beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {
            
           
            
        },  
      error : function(data) {  
        alert(data);  
      }  
    });
}*/
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
function get_member(){
  var kode_member = $("#kode_member").val();
  var url = "<?php echo base_url().'kasir/get_member'; ?>"
  $.ajax( {
   type:"POST", 
   url : url,  
   cache :false,
   dataType:'json',  
   data :{kode_member:kode_member},
   beforeSend: function(){
     $(".loading").show(); 
   },
    beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  
    $("#nama_member").val(data.nama_member);
    $("#member").text(data.nama_member);
  },  
  error : function(data) {  
    alert(data);  
  }  
});
}
$(document).ready(function(){
    //diskon_per_item();
    totalan();
    grand_total();
    cek_status();

    $('#col_auto').show();
    $('#col_manual').hide();
    //$('#barcode').focus();

    $('#inputform').on('keydown', 'input', function(event) {
      if (event.which == 13) {
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('data-index'));
        $('[data-index="' + (index + 1).toString() + '"]').focus();
      }
    });

    $('#inputform').on('keyup', '#submit', function() {
      bayar();
      $('#modal-print').modal('show');
        //var alert = confirm($('#output').text());
      });

    $('#panelForm').on('keyup', '#submit', function() {
      bayar();
      $('#modal-print').modal('show');
        //var alert = confirm($('#output').text());
      });

    var kode_penjualan = $('#kode_penjualan').val() ;
    $("#tb_pesan_temp").load("<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>"+kode_penjualan);
    $("#update").hide();

    $(".select2").select2();
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

    $('#jenis_transaksi').change(function(){
      var jenis_transaksi = $('#jenis_transaksi').val();
      if (jenis_transaksi=='kredit') {
        document.getElementById('div-hutang').style.display = "block";
        document.getElementById('div-kembali').style.display = "none";
      } else if(jenis_transaksi=='tunai'){
        document.getElementById('div-hutang').style.display = "none";
        document.getElementById('div-kembali').style.display = "block";           
      } else if(jenis_transaksi=='debet'){
        document.getElementById('div-hutang').style.display = "none";
        document.getElementById('div-kembali').style.display = "block";           
      }      
    });

    

  });
</script>
