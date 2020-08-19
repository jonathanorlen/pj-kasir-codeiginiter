<div class="row">      

  <div class="col-xs-12">
    <!-- /.box -->
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          Detail Taking Order
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

        <?php
          $param = $this->uri->segment(3);
          $pengiriman = $this->db->get_where('taking_order',array('kode_transaksi'=>$param));
          $detail_pengiriman = $pengiriman->row();
       

        ?>
        <div class="box-body">                   
          <div class="sukses" ></div>
          
          <form id="data_form" method="post">
            <div class="box-body">   
            <div class="row">
              <div class="form-group  col-md-4 pull-left" style="text-align: left;">
                   <a  class="btn btn-app blue btn-block"><i class="fa fa-barcode"></i> Kode Transaksi : <?php echo $detail_pengiriman->kode_transaksi ?> </a>

               </div>

                
            </div>
               
            <div class="row">
            <?php if($detail_pengiriman->status_penerimaan=="dikirim") { ?>
            <div class="form-group  col-xs-6">
              <label><b>Nama Penerima</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input readonly="true" class="form-control" type="text" id="tanggal_pengiriman" value="<?php echo ($detail_pengiriman->nama_penerima) ?>"></input>
              </div>
            </div>
            <div class="form-group  col-xs-6">
              <label><b>Alamat Penerima</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                <textarea class="form-control" readonly="true"><?php echo $detail_pengiriman->alamat; ?></textarea>
                </div>
            </div>
            <div class="form-group  col-xs-6">
              <label><b>No. Telp</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input readonly="true" class="form-control" type="text" id="tanggal_pengiriman" value="<?php echo ($detail_pengiriman->no_telp) ?>"></input>
              </div>
            </div>
             <div class="form-group  col-xs-6">
              <label><b>Tanggal Pengiriman</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-table"></i></span>
                <input readonly="true" class="form-control" type="text" id="tanggal_pengiriman" value="<?php echo TanggalIndo($detail_pengiriman->tanggal_pengiriman) ?>"></input>
              </div>
            </div>
            <div class="form-group  col-xs-6">
              <label><b>Jam Pengriman</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa fa-clock-o"></i></span>
                <input readonly="true" class="form-control" type="text" id="jam" value="<?php echo $detail_pengiriman->waktu_pengiriman ?>"></input>
              </div>
            </div>
            <?php } ?>
          </div>
          
          <div class="box-footer">
            <table  class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.5em;">

            <?php
           
            $opsi_pengiriman = $this->db->get_where('opsi_taking_order',array('kode_transaksi' => $detail_pengiriman->kode_transaksi));
            $opsi_list_pengiriman = $opsi_pengiriman->result();
            ?>

            <thead>
              <tr width="100%">
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>@Harga</th>
                <th>Sub Total</th>
                
              </tr>
            </thead>
            <tbody>
              <?php
              $nomor=1;
              $grand_total = 0;
              foreach($opsi_list_pengiriman as $list){
                ?>
                <tr>
                  <td><?php echo $nomor; ?></td>
                  <td><?php echo $list->nama_menu; ?></td>
                  <td><?php echo $list->jumlah . " " . $list->nama_satuan; ?></td>
                   <td><?php echo format_rupiah($list->harga_satuan); ?></td>
                  <td align="right"><?php echo format_rupiah($list->subtotal); ?></td>
                  
                </tr>
               
                <?php
                $grand_total += $list->subtotal;
                 $nomor++; } ?>
                <tr>
                  <td colspan="4" align="right">Total</td>
                  <td colspan="" align="right"><?php echo  format_rupiah($grand_total); ?></td>
                </tr>
              </tbody>
            
              
           </table>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
        <!------------------------------------------------------------------------------------------------------>
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
            window.location = "<?php echo base_url().'taking_order/daftar'; ?>";
          });
        </script>
        <script type="text/javascript">
        $(document).ready(function(){
 //           $.ajax( {  
 //              type :"post",  
 //              url : "<?php echo base_url('master/bahan_baku/get_satuan_stok'); ?>",  
 //              cache :false,  
 //              data :({ id_pembelian:$(this).val()}),
             
 // success : function(data) {
 //  $(".tunggu").hide();
 //                $(".stok").empty();
 //                $(".stok").html(data);   
 //              },  
 //              error : function(data) {  
 //                alert("das");  
 //              }  
 //            });
 //            return false;
  //$(".select2").select2();
});
        $(function(){

          $('#kode_bahan_baku').on('change',function(){
            var kode_input = $('#kode_bahan_baku').val();
            var kode_setting = $('#kode_setting').val();
            var kode_bahan_baku = kode_setting + "_" + kode_input ;
            var url = "<?php echo base_url() . 'master/bahan_baku/get_kode' ?>";
            $.ajax({
              type: 'POST',
              url: url,
              data: {kode_bahan_baku:kode_bahan_baku},
              success: function(msg){
                if(msg == 1){
                  $(".sukses").html('<div class="alert alert-warning">Kode Telah Dipakai</div>');
                  setTimeout(function(){
                    $('.sukses').html('');
                  },1700);              
                  $('#kode_bahan_baku').val('');

                }
                else{

                }
              }
            });
          });

          $(".pembelian").change(function(){

          
          });

         // $('#kode_unit').on('change',function(){
         //    var kode_unit = $('#kode_unit').val();
         //    var url = "<?php echo base_url() . 'master/bahan_baku/get_rak'; ?>";
         //    $.ajax({
         //      type: 'POST',
         //      url: url,
         //      data: {kode_unit:kode_unit},
         //      success: function(msg){
         //        //$('#kode_rak').html(msg);
         //        //$('#kode_rak').select2().trigger('change');
         //      }
         //    });
         // // });

          $("#data_form").submit( function() {
       /* var vv = $(this).serialize();
       alert(vv);*/
       <?php if(!empty($param)){ ?>
        var url = "<?php echo base_url(). 'master/bahan_baku/simpan_edit'; ?>";  
        <?php }else{ ?>
          var url = "<?php echo base_url(). 'master/bahan_baku/simpan'; ?>";
          <?php } ?>
          $.ajax( {
           type:"POST", 
           url : url,  
           cache :false,  
           data :$(this).serialize(),
           
           beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {
  $(".tunggu").hide();
  $(".sukses").html('<div class="alert alert-success">Data Berhasil Disimpan</div>');
         setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'master/bahan_baku/' ?>";},1000);  
        if(data=="sukses"){
          
        }
       else{
           $(".sukses").html(data);
       }
        $(".loading").hide();   

      },  
      error : function(data) {  
       $(".sukses").html('<div class="alert alert-success">Data Gagal Disimpan</div>');
      }  
    });
          return false;                    
        }); 
})
</script>