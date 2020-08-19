<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
<style type="text/css">
 .ombo{
  width: 600px;
 }
 /*.tulisan{
    font-size: 20px; */
 } 
</style>    
    <!-- Main content -->
    <section class="content">             
      <!-- Main row -->
      
      
        <div class="row">
        <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
            <div style="margin-top: 20px;margin-left: 20px;" class="tiles">
														<div id="kembali" class="tile bg-blue">
															<div class="tile-body">
																<i class="glyphicon glyphicon-arrow-left"></i>
															</div>
															<div class="tile-object">
																<div class="name">
                                                               <strong> Kembali</strong>
																	 
																</div>
																<div class="number">
																</div>
															</div>
														</div>
														
														
														
														
													</div>
            <div style="margin-left: 15px;margin-right: 15px;" class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          Daftar Menu Sold Out
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
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Nama Menu</span>
                                    <div id="menu">
                                    <?php
                                        $menu = $this->db->get('master_menu');
                                        $hasil_menu = $menu->result();
                                    ?>
                                        <select class="form-control select2" id="menu_sold">
                                        <option selected="true" value="">--Pilih Menu--</option>
                                        <?php
                                            foreach($hasil_menu as $dft){
                                        ?>
                                        <option  style="font-size:50px !important;"  value="<?php echo $dft->kode_menu ?>"><?php echo $dft->nama_menu; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-4">
                              <div class="input-group">
                                <button type="button" class="btn btn-primary" onclick="sold_out()"><i class="fa fa-edit"></i> Tambah</button>
                                
                              </div>
                            </div>
                          </div>
                        </form><br />
                        <div class="sukses" ></div>
                        <div id="list_transaksi_pembelian">
                              <div class="box-body">
                                <table style="font-size: 1.5em;" id="tabel_daftar" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Menu</th>
                                        <th>Nama Menu</th>
                                        <th>Kategori Menu</th>
                                        <th>Status Menu</th>
                                        <th>HPP</th>
                                        <th>Harga Jual</th>
                                        <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody id="tabel_sold_out">
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Menu</th>
                                        <th>Nama Menu</th>
                                        <th>Kategori Menu</th>
                                        <th>Status Menu</th>
                                        <th>HPP</th>
                                        <th>Harga Jual</th>
                                        <th>Action</th>
                                    </tr>
                                  </tfoot>
                                </table>
                              </div>
                            </div>

          
        </div>
        
        <!------------------------------------------------------------------------------------------------------>

      </div>
    </div>
                       
                    </div>  
                </div>
            </section><!-- /.Left col -->      
            
                              
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
                <span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus menu sold out tersebut ?</span>
                <input id="id_delete" type="hidden">
            </div>
            <div class="modal-footer" style="background-color:#eee">
                <button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
                <button onclick="simpan_tersedia()" class="btn red">Ya</button>
            </div>
        </div>
    </div>
</div>
<script>
 function tersedia(kode_menu) {
    $('#modal-confirm').modal('show');
    $("#id_delete").val(kode_menu);
}
function simpan_tersedia(){
    var kode_menu = $("#id_delete").val();
    $.ajax( {  
        type :"post",  
        url : "<?php echo base_url().'kasir/simpan_tersedia'; ?>",  
        cache :false,
        data : {kode_menu:kode_menu},
         beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {
  $(".tunggu").hide(); 
            $('#modal-confirm').modal('hide');
             $("#tabel_sold_out").load("<?php echo base_url().'kasir/daftar_sold_out/'; ?>");
        },  
        error : function(data) {  
          alert("das");  
        }  
      });
}
function sold_out(){
    var kode_menu = $("#menu_sold").val();
    $.ajax( {  
        type :"post",  
        url : "<?php echo base_url().'kasir/simpan_sold_out'; ?>",  
        cache :false,
        data : {kode_menu:kode_menu},
         beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {
  $(".tunggu").hide(); 
             $("#tabel_sold_out").load("<?php echo base_url().'kasir/daftar_sold_out/'; ?>");
        },  
        error : function(data) {  
          alert("das");  
        }  
      });
}

     
$(document).ready(function(){
     
    $(".select2").select2()
  $('#tabel_daftar').dataTable();
   $("#tabel_sold_out").load("<?php echo base_url().'kasir/daftar_sold_out/'; ?>");
})

$("#kembali").click(function(){
    window.location = "<?php echo base_url() . 'kasir/' ?>";
})
</script>

