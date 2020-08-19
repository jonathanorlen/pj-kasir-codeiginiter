<section class="content-header">
    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <i class="fa fa-home"></i>
          <a href="#">List Pengiriman</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <a href="#">Daftar Pengiriman</a>
          <i class="fa fa-angle-right"></i>
        </li>
         <li>
          <a href="#">Detail Pengiriman</a>
          <i class="fa fa-angle-right"></i>
        </li>
      </ul>
    </div>
  </section>

<div class="row">      
  <div class="col-xs-12">
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          Detail Pengiriman
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse">
          </a>
          <a href="javascript:;" class="reload">
          </a>
        </div>
      </div>
      <div class="portlet-body">
        <?php
          $param = $this->uri->segment(3);
          $pengiriman = $this->db->get_where('transaksi_penjualan',array('id'=>$param));
          $detail_pengiriman = $pengiriman->row();

        ?>
        <div class="box-body">                   
          <div class="sukses" ></div>
          <form id="data_form" method="post">
            <div class="box-body">   
            <div class="row">

              <div class="form-group  col-md-4 pull-left" style="text-align: left;">
                   <a  class="btn btn-app blue btn-block"><i class="fa fa-barcode"></i> Kode Penjualan : <?php echo $detail_pengiriman->kode_penjualan ?> </a>
               </div>
                <!-- <div class="form-group  col-md-4 pull-right" style="text-align: left;">
                   <a  class="btn btn-app blue btn-block"><i class="fa fa-barcode"></i> No. Nota : <?php echo $detail_pengiriman->nomor_nota ?> </a>
               </div> -->
            </div>      

            <div class="row">
             <div class="form-group  col-xs-6">
              <label><b>Tanggal Pengiriman</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-time"></i></span>
                <input readonly="true" class="form-control" type="text" id="tanggal_pengiriman" value="<?php echo TanggalIndo($detail_pengiriman->tanggal_pengiriman); ?>"></input>
              </div>
            </div>

            <div class="form-group  col-xs-6">
              <label><b>Jam Pengriman</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address"></i></span>
                <input readonly="true" class="form-control" type="text" id="jam" value="<?php echo $detail_pengiriman->jam_pengiriman ?>"></input>
              </div>
            </div>
          </div>

          <div class="box-footer">
            <table  class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.5em;">

            <?php
                $opsi_pengiriman = $this->db->get_where('opsi_transaksi_penjualan',array('kode_penjualan' => $detail_pengiriman->kode_penjualan));
                $opsi_list_pengiriman = $opsi_pengiriman->result(); //echo $this->db->last_query();
            ?>
            <thead>
              <tr width="100%">
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>@Harga</th>
                <th >Sub Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total=0;
              $nomor=1;
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
                  $total+=$list->subtotal;
                  $nomor++; 
                  } 
                ?>
                <tr>
                  <td colspan="4" align="right">Total</td>
                  <td colspan="" align="right"><?php echo  format_rupiah($total); ?></td>
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
    window.location = "<?php echo base_url().'list_pengiriman/'; ?>";
  });
</script>
        