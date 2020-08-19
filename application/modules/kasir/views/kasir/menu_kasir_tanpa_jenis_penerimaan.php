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
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <div class="portlet box grey-steel">
          <div class="portlet-title">
            <div class="caption">
              <span style="font-size: large; color: black;" class="pull-left">Menu Kasir</span>

            </div>
            <div class="pull-right">   
             <a onclick="taking_order()" style="text-decoration: none;font-size: 16px;" class="btn purple btn-md"><i class="fa fa-bookmark"></i> Taking Order</a>

           </div>
         </div>
         <div class="portlet-body">
          <!------------------------------------------------------------------------------------------------------>
          <?php
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

        $user = $this->session->userdata('astrosession');
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
          $no_belakang = @$pecah_kode[4]+1;
        }
        $this->db->select_max('kode_transaksi');
        $kasir = $this->db->get_where('transaksi_kasir',array('tanggal'=>$tgl,'status'=>"open",
          'kode_kasir'=>$nomor_kasir));
        $hasil_cek_kasir = $kasir->row();
                                        #echo $this->db->last_query();

        $ipaddress = '';

        $this->db->select_max('id');
        $get_max_po = $this->db->get('transaksi_penjualan');
        $max_po = $get_max_po->row();

        $this->db->where('id', $max_po->id);
        $get_po = $this->db->get('transaksi_penjualan');
        $po = $get_po->row();
        $tahun = substr(@$po->kode_penjualan, 4,4);
        if(date('Y')==$tahun){
          $nomor = substr(@$po->kode_penjualan, 9);
          $nomor = $nomor + 1;
          $string = strlen($nomor);
          if($string == 1){
            $kode_trans = 'PEN_'.date('Y').'_00000'.$nomor;
          } else if($string == 2){
            $kode_trans = 'PEN_'.date('Y').'_0000'.$nomor;
          } else if($string == 3){
            $kode_trans = 'PEN_'.date('Y').'_000'.$nomor;
          } else if($string == 4){
            $kode_trans = 'PEN_'.date('Y').'_00'.$nomor;
          } else if($string == 5){
            $kode_trans = 'PEN_'.date('Y').'_0'.$nomor;
          } else if($string == 6){
            $kode_trans = 'PEN_'.date('Y').'_'.$nomor;
          }
        } else {
          $kode_trans = 'PEN_'.date('Y').'_000001';
        }
        ?>
        <input type="hidden" value="<?php echo @$kode_trans ?>" placeholder="Kode Transaksi" name="kode_penjualan" id="kode_penjualan" />
        <input type="hidden" value="<?php echo @$kode_trans ?>" placeholder="Kode Transaksi" name="kode_penjualan_baru" id="kode_penjualan_baru" />

        <input type="hidden" value="<?php echo TanggalIndo(date("Y-m-d")); ?>" readonly="true"  placeholder="Tanggal Transaksi" name="tanggal_pembelian" id="tanggal_penjualan"/>


        <div class="box-body">            

          <div class="loading" style="z-index:9999999999999999; background:rgba(255,255,255,0.8); width:100%; height:100%; position:fixed; top:0; left:0; text-align:center; padding-top:25%; display:none" >
            <img src="<?php echo base_url() . '/public/images/loading1.gif' ?>" >
          </div>
          <div class="sukses"></div>
          <div class="row">
           <div class="col-md-8">

        <!--<table id="col_auto" class="table table-striped table-bordered table-advance table-hover" width="40%;">
                    <tbody >
                      <form >
                        <tr>
                         <td width="100px" style="background-color:#229fcd;">
                          <input autofocus type="text" name="barcode" id="barcode" class="form-control" placeholder="" />

                        </td>
                        <td align="center" valign="bottom" width="100px" style="background-color:#229fcd;color: white;font-size: large;font-weight: bold;">
                          Mode Barcode Auto
                          <input type="hidden" name="barcode" id="harga_barcode_auto" class="form-control" placeholder="" />
                          </td>
                          
                        </tr>
                      </form>
                    </tbody>
                  </table>-->


                  <table id="col_manual" class="table table-striped table-bordered table-advance table-hover">
                    <tbody >
                      <form >
                        <tr>



                         <td width="100px" style="background-color:#229fcd;">
                           <input autofocus type="text" name="barcode_manual" id="barcode_manual" class="form-control" placeholder="" />

                         </td>
                         
                         <td align="center" valign="bottom" width="100px" style="background-color:#229fcd;color: white;font-size: large;font-weight: bold;">
                          Mode Barcode Manual</td>
                          
                        </tr>
                      </form>
                    </tbody>
                  </table>
                  
                  <table id="" class="table table-striped table-bordered table-advance table-hover">
                    <tbody>
                      <form id="panelForm">
                        <tr>
                          <td width="250px" style="background-color:#229fcd;">
                            <input type="text" name="id_penjualan" id="id_penjualan" value="" hidden/>
                            <?php
                            $menu_resto = $this->db->get('master_bahan_baku');
                            $hasil_menu = $menu_resto->result();
                            ?>
                            <select name="menu" id="menu" class="form-control select2">
                             <option value="" selected="true">--Pilih Produk--</option>
                             <?php
                             foreach($hasil_menu as $daftar){
                               ?>
                               <option value="<?php echo $daftar->kode_bahan_baku; ?>"><?php echo $daftar->nama_bahan_baku; ?></option>
                               <?php } ?>
                             </select>
                           </td>
                           
                           <!-- <td style="background-color:#229fcd;">
                            <select name="satuan_stok" onchange="get_harga()" id="satuan_stok" class="form-control">
                             <option value="" selected="true">--Pilih Satuan--</option>
                             
                           </select> -->
                           
                           
                         </td>
                         
                         <td width="100px" style="background-color:#229fcd;">

                          <input type="text" name="qty" id="qty" class="form-control" placeholder="jumlah" onkeyup="get_harga()" />
                          <input type="hidden" id="kode_kasir" value="<?php echo $hasil_cek_kasir->kode_transaksi; ?>" />
                          <input type="hidden" name="qty" id="qty2" class="form-control" placeholder="jumlah">
                        </td>
                        <td width="100px" style="background-color:#229fcd;">
                          <input readonly="true" type="text" name="harga" id="harga" class="form-control" placeholder="harga">
                        </td>
                        <td width="150px" style="background-color:#229fcd;">
                          <select hidden name="jenis_diskon" id="jenis_diskon" class="form-control">
                            <option value="persen" selected="true">Persen</option>
                            <option value="rupiah">Rupiah</option>
                          </select>
                        </td>
                        <td width="100px" style="background-color:#229fcd;">
                          <div class="input-icon right" id="form_diskon_item">
                            <i class="fa">%</i>
                            <input type="text" name="diskon" id="diskon_item" class="form-control" placeholder="Diskon Persen" value="0">
                          </div>
                          <div class="input-icon right" id="form_diskon_rupiah">
                            <i class="fa">Rp.</i>
                            <input type="text" name="diskon_rupiah" id="diskon_rupiah" class="form-control" placeholder=" Diskon Rupiah" value="0">
                          </div>
                          <input type="hidden" name="kode_edit_penjualan" id="kode_edit_penjualan" />
                        </td>
                        <td width="100px"style="background-color:#229fcd;" >
                          <div onclick="simpan_pesanan_temp()" class="btn purple">Add</div>
                          <div id="update" onclick="editData()" class="btn purple">Update</div>
                        </td>
                      </tr>
                    </form>
                  </tbody>
                </table>
              </div>
              <div class="col-md-8">
                <table style="white-space: nowrap; font-size: 1.5em;" id="data" class="table table-bordered  table-hover">
                  <thead>
                    <tr>
                      <th style="background-color:#229fcd; color:white" class="text-center" width="50px">No.</th>
                      <th style="background-color:#229fcd; color:white" class="text-center">Nama Produk</th>

                      <th style="background-color:#229fcd; color:white" class="text-center" width="50px">Qty</th>
                      <th style="background-color:#229fcd; color:white" class="text-center" width="125px">Harga</th>
                      <th style="background-color:#229fcd; color:white" class="text-center" width="125px">Subtotal</th>
                      <th style="background-color:#229fcd; color:white" class="text-center" width="100px">Diskon</th>
                      <th style="background-color:#229fcd; color:white" class="text-center" width="170px">Action</th>
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
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">Diskon(%)</span>
                    <span id="dibayar">
                      <input type="text" onkeyup="diskon_persen()" class="form-control" name="persen" id="persen" />
                    </span>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">Diskon(Rp)</span>
                    <span id="dibayar">
                      <input type="text" onkeyup="diskon_rupiah()" class="form-control" name="rupiah" id="rupiah" />
                    </span>
                  </div>
                </div>

              </div>

              <div style="margin-top: -125px;" class="col-md-4">
                <div class="bg-yellow" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
                  <span style="font-size:22px; " class="pull-right" id="total_pesanan"></span>

                  <p style="font-size: 18px;">Total Pesanan</p>
                </div>
                <div class="bg-red" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
                  <span style="font-size:22px; " class="pull-right" id="diskon_all">Rp 0</span>
                  <i style="font-size:56px; margin-top:5px"></i>
                  <p style="font-size: 18px;">Discount</p>
                </div>
                <div class="bg-blue" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
                  <span style="font-size:22px; " class="pull-right" id="grand_total">Rp 0</span>
                  <i style="font-size:56px; margin-top:5px"></i>
                  <p style="font-size: 18px;">Grand Total</p>
                </div>
                <div style="">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">Kode Member</span>
                      <span>
                        <select  onchange="get_member()" class="form-control select2" id="kode_member" name="kode_member">
                         <option value="">--Pilih Member--</option>
                         <?php 
                         $get_member=$this->db->get('master_member');
                         $hasil=$get_member->result();
                         foreach ($hasil as $list) {
                          ?>
                          <option value="<?php echo $list->kode_member;  ?>"><?php echo $list->kode_member;  ?></option>
                          <?php } ?>
                        </select>
                        <!-- <input onkeyup="get_member()" type="text" class="form-control" name="kode_member" id="kode_member" /> -->
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

                <div style="height:60px; margin-bottom:5px">
                  <div style="height: 40px;" class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">Jenis Transaksi</span>
                      <span id="golongan">
                        <select class="form-control" id="jenis_transaksi" name="jenis_transaksi">
                          <option selected="true" value="tunai">Tunai</option>
                          <option value="kredit">Kredit</option>
                          <option value="cod">COD</option>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>
                <div style="height:60px;margin-bottom: 5px;margin-top: -20px;">
                  <div style="height: 40px;" class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">Jenis Penerimaan</span>
                      <span id="golongan">
                        <input type="text" readonly="true" class="form-control" id="jenis_penerimaan" />

                      </span>
                    </div>
                  </div>
                </div>

                <div style="height:60px;margin-bottom: 5px;margin-top: -20px;">
                  <div style="height: 40px;" class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">Ongkos Kirim</span>
                      <span id="golongan">
                        <input onkeyup="ongkos_kirim()" type="text" class="form-control" id="ongkos_kirim" />

                      </span>
                    </div>
                  </div>
                </div>
                <div style="height:60px; margin-top: -20px;">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" style="font-size: x-large;font-weight: bolder;"><strong>Dibayar</strong></span>
                      <span id="dibayar">
                        <input type="hidden" id="total_no" />
                        <input type="hidden" id="total2" />
                        <input type="hidden" id="kembalian2" />
                        <input style="font-size: 30px;" onkeyup="kembalian()" type="text" class="form-control input-lg" name="bayar" id="bayar" />
                      </span>
                    </div>
                  </div>
                </div>

                <div class="bg-purple" style="height:40px; padding: 0px 10px 0px 10px; margin-top:-5px">
                  <span style="font-size:26px; " class="pull-right totalDiskon" id="kembalian">Rp 0</span>
                  <i style="font-size:56px; margin-top:5px"></i>
                  <p style="font-size: 18px;">Kembalian</p>
                </div>







                        <!--<div class="bg-green" style="height:55px; padding: 10px 10px 0px 10px; margin-top:35px">
                            <button class="btn btn-large btn-default" style="width:100%" onClick="list_suspend()">LIST PESANAN</button>
                          </div>-->
                        </div><br />
                        <div id="rupiah_bayar" style="padding-left: 500px;margin-top:-40px;font-size:35px" class="pull-right col-md-12">

                        </div>
                      </div>
                      <div class="row">

                        <div class="col-md-12">
                          <input type="hidden" id="id_meja" value="<?php echo $this->uri->segment(3); ?>" />
                          
                          
                          
                          
                          
                          <input type="hidden" id="hasil_meja" />
                          
                        </div>
                        
                        
                      </div>
                      <br /><br />
                      
                      <div id="data_pengiriman" class="row" style=" margin-top: -10px;">
                        <fieldset>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Nama Penerima</label>
                              <input placeholder="Nama" type="text" class="form-control" id="penerima" />
                            </div>
                            
                            <div class="form-group">
                              <label>Jam Pengiriman</label>
                              <input placeholder="No. Telp" type="text" class="form-control timepicker" id="jam_kirim" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>No. Telp</label>
                              <input placeholder="No. Telp" type="text" class="form-control" id="no_telp" />
                            </div>
                            
                            <div class="form-group">
                              <label>Tanggal Pengiriman</label>
                              <input placeholder="Tanggal" type="date" class="form-control" id="tgl_kirim" />
                            </div>
                            
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Alamat</label>
                              <textarea id="alamat" class="form-control" placeholder="Alamat"></textarea>
                            </div>
                            
                          </div>
                        </fieldset>
                        
                      </div>
                      
                      <div class="row">


                        <div class="col-lg-12">
                          <a style="text-decoration: none;" onclick="konfirm_bayar()"  class="bg-green btn col-md-12">
                            <center><span style="font-size:35px; font-weight: bold; "><i style="font-size: 35px;" class="fa fa-money"></i> Bayar</span></center>	
                          </a>
                        </div>
                        
                      </div><br /><br />
                      
                      
                      
                      
                      
                      
                      
                      <!------------------------------------------------------------------------------------------------------>

                    </div>
                  </div>
                  
                  <!-- /.row (main row) -->
                </section><!-- /.content -->
              </div>
              
              
            </div>  
          </div>
        </section><!-- /.Left col -->      
        
        
        
      </div><!-- /.row (main row) -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <div id="modal-confirm-bayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:grey">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title" style="color:#fff;">Konfirmasi Pembayaran</h4>
        </div>
        <div class="modal-body">
          <span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan dengan nominal pembayaran tersebut ?</span>
          <input id="no" type="hidden">
        </div>
        <div class="modal-footer" style="background-color:#eee">
          <button id="tidak" class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
          <button id="ya" onclick="bayar()" class="btn green">Ya</button>
        </div>
      </div>
    </div>
  </div>

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
          <button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
          <button onclick="delData()" class="btn green">Ya</button>
        </div>
      </div>
    </div>
  </div>

  <div id="modal-taking-order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:grey">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title" style="color:#fff;">Masukkan Nota Taking Order</h4>
        </div>
        <div class="modal-body">

          <input id="nota_to" placeholder="Nomor Nota" class="form-control" type="text" />
        </div>
        <div class="modal-footer" style="background-color:#eee">
          <button class="btn red" data-dismiss="modal" aria-hidden="true">Cancel</button>
          <button id="cari_to" class="btn green">OK</button>
        </div>
      </div>
    </div>
  </div>



  

  <script>
    function setting() {
      $('#modal_setting').modal('show');
    }

    function konfirm_bayar(){
      $("#modal-confirm-bayar").modal('show');
    }

    function taking_order(){
      $('#modal-taking-order').modal('show');
      $("#nota_to").focus();
    }
    $("#jenis_diskon").change(function(){
      if($("#jenis_diskon").val()=='rupiah'){
        $("#form_diskon_rupiah").show();
        $("#form_diskon_item").hide();
      } else {
        $("#form_diskon_rupiah").hide();
        $("#form_diskon_item").show();
      }
    });
    $(document).ready(function(){
      $("#form_diskon_rupiah").hide();
      var kode_kasir = $("#kode_kasir").val();
      $("#tb_pesan_temp").load('<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>'+kode_kasir);
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
      $('#col_auto').hide();
      $('#col_manual').show();
      $('#barcode_manual').focus();
      $("#data_pengiriman").hide();
      $('input.timepicker').timepicker({ 
       timeFormat: 'HH:mm',
       interval: 30,
       scrollbar:true 
     });

    });
    function tutupmeja(){
      var url = "<?php echo base_url().'kasir/kasir/tutup_meja'; ?>";
      var id_meja = $("#id_meja").val();
      $.ajax( {
       type:"POST", 
       url : url,  
       cache :false,  
       data :{id_meja:id_meja},

       beforeSend:function(){
        $(".tunggu").show();  
      },
      success : function(data) {
       $(".tunggu").hide(); 
       $(".sukses").html(data);
       setTimeout(function(){$('.sukses').html('');},1500); 




     },  
     error : function(data) {  
      alert(data);  
    }  
  });
    }
    function bukameja(){
      var url = "<?php echo base_url().'kasir/kasir/buka_meja'; ?>";
      var id_meja = $("#id_meja").val();
      $.ajax( {
       type:"POST", 
       url : url,  
       cache :false,  
       data :{id_meja:id_meja},
       beforeSend:function(){
        $(".tunggu").show();  
      },
      success : function(data) {  
        $(".tunggu").hide(); 
        window.location.reload();
      },  
      error : function(data) {  
        alert(data);  
      }  
    });
    }

    function simpan_pesanan_temp(){
      var url = "<?php echo base_url().'kasir/simpan_pesanan_temp'; ?>";
      var kode_penjualan = $("#kode_penjualan").val();
      $('#id_penjualan').val('--Pilih Produk--  ');
      var tanggal_penjualan = $("#tanggal_penjualan").val();
      var nomor_nota =$("#nomor_nota").val();
      var kode_meja = $("#kode_meja").val();
      var menu = $("#menu").val();
      var jumlah = $("#qty").val();
      var harga = $("#harga").val();
      var diskon = $("#diskon_item").val();
      var kode_kasir = $("#kode_kasir").val();
      var jenis_diskon = $("#jenis_diskon").val();
      var diskon_rupiah = $("#diskon_rupiah").val();
      if(jumlah < 1 || menu==""){
        $(".sukses").html("<div class='alert alert-warning'>Jumlah Pesanan Salah</div>");
        setTimeout(function(){$('.sukses').html('');},1500); 

      }else{
        $.ajax( {
         type:"POST", 
         url :"http://admin-pj.cloud-astro.com/reloader/simpan_pesanan_temp",
         cache :false,  
         data :{kode_penjualan:kode_penjualan,kode_meja:kode_meja,kode_menu:menu,jumlah:jumlah,
          diskon_item:diskon,harga_satuan:harga,kode_kasir:kode_kasir,jenis_diskon:jenis_diskon,diskon_rupiah:diskon_rupiah
        },
        success : function(data) {
          alert('Berhasil mengunggah Data');
        },  

      });
        $.ajax( {
         type:"POST", 
         url : url,  
         cache :false,  
         data :{kode_penjualan:kode_penjualan,kode_meja:kode_meja,kode_menu:menu,jumlah:jumlah,
          diskon_item:diskon,harga_satuan:harga,kode_kasir:kode_kasir,jenis_diskon:jenis_diskon,diskon_rupiah:diskon_rupiah
        },

        beforeSend:function(){
          $(".tunggu").show();  
        },
        success : function(data) {
          $(".tunggu").hide(); 
          $("#tb_pesan_temp").load('<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>'+kode_kasir);
          $("#menu").select2().select2('val', menu);
          $("#qty").val('');
          $("#diskon_item").val('0');
          $("#harga").val('');
          $("#keterangan").val('');
          $("#barcode_manual").focus();
          $("#jenis_diskon").html('');
          $("#jenis_diskon").html('<option value="persen" selected="true">Persen</option><option value="rupiah">Rupiah</option>');
          totalan();
          grand_total();
          cek_status();
          $("#form_diskon_rupiah").hide();
          $("#form_diskon_item").show();
        },  
        error : function(data) {  
          alert(data);  
        }  
      });
      }

    }

    function simpan_pesanan_otomatis(){
      var kode_penjualan = $("#kode_penjualan").val();
      var tanggal_penjualan = $("#tanggal_penjualan").val();
      var nomor_nota =$("#nomor_nota").val();
      var menu = $("#barcode").val();
      var jumlah = '1';
      var diskon ='0';
      var kode_meja = $("#kode_meja").val();
      var kode_kasir = $("#kode_kasir").val();
      var harga = $("#harga_barcode_auto").val();
      var kode_kasir = $("#kode_kasir").val()
      var url = "<?php echo base_url().'kasir/simpan_pesanan_temp'; ?>";

      $.ajax({
        type: "POST",
        url: url,
        data: {kode_penjualan:kode_penjualan,kode_meja:kode_meja,kode_menu:menu,jumlah:jumlah,
          diskon_item:diskon,harga_satuan:harga,kode_kasir:kode_kasir
        },
        success: function(data)
        {
          if(data == 'tidak cukup'){
            $(".notif_stok").html('<div class="alert alert-warning">Stok Produk Tidak Mencukupi</div>');
            setTimeout(function(){
              $('.notif_stok').html('');
            },1700);              
          }else{
            $("#tb_pesan_temp").load("<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>"+kode_kasir);
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

    function get_harga(){
      var url = "<?php echo base_url().'kasir/kasir/get_harga'; ?>";
      var id_menu = $("#menu").val();
      var qty = $("#qty").val();
      $.ajax( {
        type:"POST", 
        url : url, 
        cache :false,  
        data :{id_menu:id_menu,qty:qty},
        success : function(data) {   
          $("#harga").val(data);
        },  
        error : function(data) {  
          alert(data);  
        }  
      });
    }
    function actEdit(id) {
     var kode_kasir = $("#kode_kasir").val();
     var id = id;
     var url = "<?php echo base_url().'kasir/kasir/get_pesanan_temp'; ?>";
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
        $("#tb_pesan_temp").load('<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>'+kode_kasir);
      }
    });
     $("#update").show();
     $("#tambah").hide();
   }

   function editData(){

    var url = "<?php echo base_url().'kasir/kasir/simpan_ubah_pesanan_temp'; ?>";
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
    beforeSend:function(){
      $(".tunggu").show();  
    },
    success : function(data) {
      $(".tunggu").hide(); 
      $("#tb_pesan_temp").load('<?php echo base_url().'kasir/kasir/pesanan_temp/'.$this->uri->segment(3); ?>');
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
    var url = '<?php echo base_url().'kasir/kasir/hapus_pesanan_temp'; ?>/delete';
    
    $.ajax({
      type: "POST",
      url: "http://admin-pj.cloud-astro.com/reloader/hapus_pesanan_temp/delete",
      data: {
        id:id
      },
      success: function(msg) {
        alert("berhasil mennghapus online");
      }
    });

    $.ajax({
      type: "POST",
      url: url,
      data: {
        id:id
      },
      success: function(msg) {
        var kode_kasir = $("#kode_kasir").val()
        $('#modal-confirm').modal('hide');
        $("#tb_pesan_temp").load('<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>'+kode_kasir);
        totalan();
        grand_total();
      }
    });
    return false;
  }
  function toRp(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
      rev2  += rev[i];
      if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
        rev2 += '.';
      }
    }
    return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
  }
  function ongkos_kirim(){
    var ongkos = $('#ongkos_kirim').val();
    if(ongkos == ''){
      var ongkos = parseInt(0);
    } else{
      var ongkos = parseInt($('#ongkos_kirim').val());
    }
    var grand_tot=parseInt($('#total2').val());
    var diskon = $("#rupiah").val();
      //lert(grand_tot);
      var a;
      a= Math.round(grand_tot + ongkos - diskon);
      $('#total_no').val(a);
      $('#grand_total').text(toRp(a));

    }
    function diskon_persen(){
      var no_meja = $("#kode_meja").val();
      var kode_kasir = $("#kode_kasir").val();
      var diskon_persen = $("#persen").val();
      var url = "<?php echo base_url().'kasir/kasir/diskon_persen'; ?>";
      $.ajax({
        type: 'POST',
        url: url,
        data: {no_meja:no_meja,diskon_persen:diskon_persen,kode_kasir:kode_kasir},
        success: function(total){
          var rupiah = Math.round((diskon_persen/100 )*total);
          $("#rupiah").val(rupiah);
          diskon_all();
          grand_total();
        }
      });
    }
    function diskon_rupiah(){
      var no_meja = $("#kode_meja").val();
      var diskon_rupiah = $("#rupiah").val();
      var kode_kasir = $("#kode_kasir").val();
      var url = "<?php echo base_url().'kasir/kasir/diskon_persen'; ?>";
      $.ajax({
        type: 'POST',
        url: url,
        data: {no_meja:no_meja,diskon_rupiah:diskon_rupiah,kode_kasir:kode_kasir},
        success: function(total){
          var persen = Math.round(diskon_rupiah/total*100);
          $("#persen").val(persen);
          diskon_all();
          grand_total();
        }
      });
    }
    function totalan() {
      var no_meja = $("#kode_meja").val();
      var kode_kasir = $("#kode_kasir").val();
      var url = "<?php echo base_url().'kasir/kasir/get_total_temp'; ?>";
      $.ajax({
        type: 'POST',
        url: url,
        dataType:'json',
        data: {no_meja:no_meja,kode_kasir:kode_kasir},
        success: function(kasir){
          $("#total_pesanan").text(kasir.total);
          $("#grand_total").text(kasir.total);
          $("#total2").val(kasir.total2);
        }
      });
    }
    function diskon_all(){
      var url = "<?php echo base_url().'kasir/kasir/diskon_all'; ?>";
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
     var url = "<?php echo base_url().'kasir/kasir/grand_total'; ?>";
     var rupiah = $("#rupiah").val();
     var kode_kasir = $("#kode_kasir").val();
     var kode_penjualan = $("#kode_penjualan").val();
     $.ajax({
      type: 'POST',
      url: url,
      dataType:'json',
      data: {rupiah:rupiah,kode_penjualan:kode_penjualan,kode_kasir:kode_kasir},
      success: function(rupiah){
        $("#grand_total").text(rupiah.total_grand);
        $("#total_no").val(rupiah.total_no);
      }
    });
   }

   function kembalian(){
    var url = "<?php echo base_url().'kasir/kasir/kembalian'; ?>";
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
        $("#rupiah_bayar").text(rupiah.dibayar);
      }
    });
  }
  function bayar(){
    var url = "<?php echo base_url().'kasir/kasir/simpan_pembayaran'; ?>";
    var kode_meja = $("#kode_meja").val();
    var kode_penjualan = $("#kode_penjualan").val();
    var total_pesanan = $("#total2").val();
    var persen = $("#persen").val();
    var rupiah = $("#rupiah").val();
    var grand_total = $("#total_no").val();
    var jenis_transaksi = $("#jenis_transaksi").val();
    var kembalian = $("#kembalian2").val();
    var bayar = $("#bayar").val();
    var kode_member = $("#kode_member").val();
    var nama_member = $("#nama_member").val();
    var kode_penjualan_baru = $("#kode_penjualan_baru").val();
    var waiter = $("#waiter").val();
    var jenis_penerimaan = $("#jenis_penerimaan").val();
    var penerima = $("#penerima").val();
    var no_telp = $("#no_telp").val();
    var alamat = $("#alamat").val();
    var jam_kirim = $("#jam_kirim").val();
    var tgl_kirim = $("#tgl_kirim").val();
    var ongkos = $("#ongkos_kirim").val();

    var id_petugas = "<?php echo $user->id; ?>";
    var nama_petugas = "<?php echo $user->uname; ?>";

    if(bayar==""){
      $(".sukses").html('<div style="font-size:1.5em" class="alert alert-warning">Pembayaran masih kosong</div>');
      setTimeout(function(){$('.sukses').html('');},1500);  
    }else{
      if(nama_member=="" && jenis_transaksi=="kredit"){
        $(".sukses").html('<div class="alert alert-warning">Pembayaran kredit hanya digunakan untuk member</div>');
      }else{
        $.ajax({
          type: "POST",
          url: "http://admin-pj.cloud-astro.com/reloader/input_transaksi_penjualan",
          data: {
            kode_penjualan:kode_penjualan,
            bayar:bayar,
            kembalian:kembalian,
            total_pesanan:total_pesanan,
            persen:persen,
            rupiah:rupiah,
            grand_total:grand_total,
            jenis_transaksi:jenis_transaksi,
            kode_member:kode_member,
            nama_member:nama_member,
            waiter:waiter,
            kode_penjualan_baru:kode_penjualan_baru,
            jenis_penerimaan:jenis_penerimaan,
            penerima:penerima,
            no_telp:no_telp,
            alamat:alamat,
            jam_kirim:jam_kirim,
            id_petugas:id_petugas,
            nama_petugas:nama_petugas,
            tgl_kirim:tgl_kirim,ongkos:ongkos
          },
          success: function(data) {
            alert('berhasil mengunggah transaksi.')
          }
        });
        $.ajax({
          type: 'POST',
          url: url,
          data: {kode_meja:kode_meja,kode_penjualan:kode_penjualan,bayar:bayar,kembalian:kembalian,
            total_pesanan:total_pesanan,persen:persen,rupiah:rupiah,grand_total:grand_total,jenis_transaksi:jenis_transaksi,
            kode_member:kode_member,nama_member:nama_member,waiter:waiter,kode_penjualan_baru:kode_penjualan_baru,
            jenis_penerimaan:jenis_penerimaan,penerima:penerima,no_telp:no_telp,alamat:alamat,
            jam_kirim:jam_kirim,tgl_kirim:tgl_kirim,ongkos:ongkos},
            success: function(hasil){
              $("#modal-confirm-bayar").modal('hide');

              $(".sukses").html('<div style="font-size:1.5em" class="alert alert-success">Pembayaran Produk Berhasil</div>');
              var link = "<?php echo base_url('kasir/kasir/cetak_pembayaran'); ?>";

              $.ajax({
               type: "POST",
               url: link,
               data:{
                kode_meja:kode_meja,kode_penjualan_baru:kode_penjualan_baru,jenis_transaksi:jenis_transaksi,ongkos:ongkos
              },
              success: function(msg)
              {


              }
            });
              setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'kasir/' ?>";},1000);  
            }
          });
      }
    }

  }
  function pindah_meja(){
    $('#modal-regular').modal('show'); 
  }

  function gabung_meja(){
    $('#modal-gabung').modal('show'); 
  }

  function simpan_pindah_meja(){
    var url = "<?php echo base_url().'kasir/kasir/pindah_meja'; ?>";
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
    var url = "<?php echo base_url().'kasir/kasir/gabung_meja'; ?>";
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
        $(".sukses_gabung").html(data);
        setTimeout(function(){$(".sukses_gabung").html(''); },2000);
        setTimeout(function(){$('#modal-gabung').modal('hide'); },2000);
        cek_status(); 


      }
    });
  }

  function cek_status(){
    var kode_meja = $("#id_meja").val();
    var url = "<?php echo base_url().'kasir/kasir/cek_status'; ?>";
    $.ajax({
      type: 'POST',
      url: url,
      data: {kode_meja:kode_meja},
      success: function(hasil){
        var data = $("#hasil_meja").val(hasil);
        if($("#hasil_meja").val(hasil)=="aktif"){
                //alert("oke");
                $("#buka").show();
                $("#tutup").hide();
              }else{
               // alert("jos");
               $("#buka").hide();
               $("#tutup").show();
             }
           }
         });
  }

  function print() {
    var url = "<?php echo base_url('kasir/kasir/cetak_bill'); ?>";
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
    var url = "<?php echo base_url('kasir/kasir/cetak_pesanan'); ?>";
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
    var url = "<?php echo base_url().'kasir/kasir/tutup_kasir'; ?>";
    $.ajax( {
     type:"POST", 
     url : url,  
     cache :false,  
     data :{kasir:kasir},
     beforeSend:function(){
      $(".tunggu").show();  
    },
    success : function(data) {  
      $(".tunggu").hide(); 
      setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'kasir/kasir/tutup_kasir/' ?>"+kasir;},1000);
    },  
    error : function(data) {  
      alert(data);  
    }  
  });
  }
  function get_member(){
    var kode_member = $("#kode_member").val();
    var url = "<?php echo base_url().'kasir/kasir/get_member'; ?>"
    $.ajax( {
     type:"POST", 
     url : url,  
     cache :false,
     dataType:'json',  
     data :{kode_member:kode_member},

     beforeSend:function(){
      $(".tunggu").show();  
    },
    success : function(data) {  
      $(".tunggu").hide(); 
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
    var kode_kasir = $("#kode_kasir").val();
    $("#tb_pesan_temp").load('<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>'+kode_kasir);
    $("#update").hide();
    $(".select2").select2();
    
    
    $("#cari_to").click(function(){
      var kode_kasir = $("#kode_kasir").val();
      var kode_transaksi = $("#nota_to").val();
      var kode_penjualan = $("#kode_penjualan").val();
      var url = "<?php echo base_url().'kasir/kasir/get_taking_order/'; ?>"+kode_kasir;
      $.ajax( {
       type:"POST", 
       url : url,  
       cache :false,
       dataType:'json',  
       data :{kode_transaksi:kode_transaksi,kode_kasir:kode_kasir,kode_penjualan:kode_penjualan},
       
       beforeSend:function(){
        $(".tunggu").show();  
      },
      success : function(data) {  
        $(".tunggu").hide();
        if(data.status_penerimaan=="dikirim"){
          $("#data_pengiriman").fadeIn(1000);
        }else{
          $("#data_pengiriman").hide();
        }
        $("#modal-taking-order").modal('hide'); 
        $("#tb_pesan_temp").load('<?php echo base_url().'kasir/kasir/pesanan_temp/'; ?>'+kode_kasir);
        totalan();
        grand_total();
        cek_status();
        $("#penerima").val(data.nama_penerima);
        $("#no_telp").val(data.no_telp);
        $("#alamat").val(data.alamat);
        $("#jam_kirim").val(data.waktu_pengiriman);
        $("#tgl_kirim").val(data.tanggal_pengiriman);
        $("#jenis_penerimaan").val(data.status_penerimaan);         
      },  
      error : function(data) {  
        alert(data);  
      }  
    });

    });


          /*    $('#barcode').on('keydown',function(event) {

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
       
       
      $('#barcode').on('keydown', function(event) {

               if (event.which == 13) {
                event.preventDefault();
                var url = "<?php #echo base_url().'kasir/get_harga'; ?>";
                var id_menu = $("#barcode").val();
                $.ajax( {
                 type:"POST", 
                 url : url,  
                 cache :false,
                 dataType: "json",  
                 data :{id_menu:id_menu},
                 beforeSend: function(){
                   $(".loading").show(); 
                 },
                 success : function(data) {  
                 
                 $("#harga_barcode_auto").val(data);

                  
                  simpan_pesanan_otomatis();
                  $("#barcode").val('');
                  $("#barcode").focus();
                  $(".loading").hide(); 
                },  
                error : function(data) {  
                  alert(data);  
                }  
              });
              } else if (event.which == 66) {
                event.preventDefault();
                $("#bayar").focus();
              }
            }); */

            $('#barcode_manual').on('keydown', function(event) {

             if (event.which == 13) {
               var cek = $("#barcode_manual").val();
               if(cek==""){
                event.preventDefault();
                $("#persen").focus();

              }else{
               event.preventDefault();
               var url = "<?php echo base_url().'kasir/get_produk_manual'; ?>";
               var id_menu = "BB_"+$("#barcode_manual").val();
               $.ajax( {
                 type:"POST", 
                 url : url,  
                 cache :false,  
                 dataType : "json",
                 data :{id_menu:id_menu},

                 success : function(data) {
                  $(".loading").hide(); 
                  $("#qty").focus();
                  $("#menu").select2().select2('val',data.kode_bahan_baku);
                  $("#barcode_manual").val('');
                  $("#harga").val(data.harga_jual_1);
                          // simpan_pesanan_manual();
                        },  
                        error : function(data) {  
                          alert(data);  
                        }  
                      });
             }                                 

           }else if (event.which == 66) {
            event.preventDefault();
            $("#bayar").focus();
          }
        }); 


            $("#barcode_manual").change(function(){
              var url = "<?php echo base_url().'kasir/get_satuan_stok'; ?>";
              var id_menu = "BB_"+$("#barcode_manual").val();
              $.ajax( {
               type:"POST", 
               url : url,  
               cache :false,
               data :{id_menu:id_menu},

               success : function(data) {
                 $("#satuan_stok").html('');
                 $("#satuan_stok").html(data);
                 $("#satuan_stok").focus();
               },  
               error : function(data) {  
                alert(data);  
              }  
            });
            })

            $("#menu").change(function(){
              var url = "<?php echo base_url().'kasir/get_satuan_stok'; ?>";
              var id_menu = $("#menu").val();
              $.ajax( {
               type:"POST", 
               url : url,  
               cache :false,
               data :{id_menu:id_menu},

               success : function(data) {
                 $("#satuan_stok").html('');
                 $("#satuan_stok").html(data);
                 $("#satuan_stok").focus();
               },  
               error : function(data) {  
                alert(data);  
              }  
            });
            })

            $('#menu').on('keydown', function(event) {

             if (event.which == 13) {
               // alert("siap");
               $("#satuan_stok").focus();
             }else if(event.which == 27){
              // alert("siap");
              $("#persen").focus();
            }
          });

            $('#satuan_stok').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                $("#qty").focus();
              }
            });

            $('#qty').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                $("#diskon_item").focus();
              }
            });

            $('#diskon_item').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                simpan_pesanan_temp();
                $("#menu").focus();
              }
            });

             $('#diskon_rupiah').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                simpan_pesanan_temp();
                $("#menu").focus();
              }
            });


            $('#persen').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#kode_member").focus();
              }
            });

            $('#rupiah').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#kode_member").focus();
              }
            });

            $('#kode_member').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#jenis_transaksi").focus();
              }
            });

            $('#jenis_penerimaan').on('keydown', function(event) {
              var penerimaan = $("#jenis_penerimaan").val();
              if (event.which == 13) {
                //alert("siap");
                if(penerimaan=="dikirim"){
                  $("#penerima").focus();
                }else{
                  $("#ongkos_kirim").focus();
                } 
                
              }
            });

            $("#jenis_penerimaan").change(function(){
       // alert("oke");
       var penerimaan = $("#jenis_penerimaan").val();
       if(penerimaan=="dikirim"){
        $("#data_pengiriman").fadeIn(500);
      }else{
        $("#data_pengiriman").fadeOut(500);
        $("#penerima").val('');
        $("#no_telp").val('');
        $("#alamat").val('');
        $("#jam_kirim").val('');
        $("#tgl_kirim").val('');
      } 
    });

            $('#penerima').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#no_telp").focus();
              }
            });

            $('#no_telp').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#alamat").focus();
              }
            });

            $('#alamat').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#jam_kirim").focus();
              }
            });

            $('#jam_kirim').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#tgl_kirim").focus();
              }
            });

            $('#tgl_kirim').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#bayar").focus();
              }
            });

            $('#ongkos_kirim').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#bayar").focus();
              }
            });

            $('#jenis_transaksi').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
                
                $("#jenis_penerimaan").focus();
              }
            });

            $('#bayar').on('keydown', function(event) {

             if (event.which == 13) {
               // alert("siap");
               $("#modal-confirm-bayar").modal('show');

             }
           });



   /*  $('#no').on('keydown', function(event) {

             if (event.which == 84) {
               // alert("siap");
              $("#modal-confirm-bayar").modal('hide');
            }
          });

     $('#ya').on('keydown', function(event) {

             if (event.which == 89) {
               // alert("siap");
             bayar();
            }
          }); */

  /*  $('#bayar').on('keydown', function(event) {

             if (event.which == 13) {
                //alert("siap");
             
               bayar();
            }
          });*/


        });
      </script>
