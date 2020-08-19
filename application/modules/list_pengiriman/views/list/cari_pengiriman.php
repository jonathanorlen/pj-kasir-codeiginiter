          <table  class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.5em;">
            <?php

            $param = $this->input->post();
            if(@$param['tgl_awal'] && @$param['tgl_akhir']){

              $tgl_awal = $param['tgl_awal'];
              $tgl_akhir = $param['tgl_akhir'];
             

              $this->db->where('tanggal_pengiriman >=', $tgl_awal);
              $this->db->where('tanggal_pengiriman <=', $tgl_akhir);
             

            }
            $this->db->where('status_penerimaan =', 'dikirim');
            $this->db->select('*');
            $this->db->from('transaksi_penjualan');
            $pengiriman = $this->db->get();
            $list_pengiriman = $pengiriman->result();


           
            // $pengiriman = $this->db->get_where('transaksi_penjualan',array('status_penerimaan' => 'dikirim', 'tanggal_pengiriman' => $bulan));
            // $list_pengiriman = $pengiriman->result();
            ?>
            <thead>
              <tr width="100%">
                <th>No. Nota</th>
                <th>Tanggal Pengiriman</th>
                <th>Nama Customer</th>
                <th>Jenis Transaksi</th>
                <th>Total</th>
                <th>Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $nomor=1;
              foreach($list_pengiriman as $list){
               if($list->jenis_transaksi == "cod"){
                echo "<tr style='background-color: #ffd6d6'>";
              } else if($list->jenis_transaksi == "kredit"){
                echo "<tr style='background-color: #d6e3ff'>";
              } else if($list->jenis_transaksi == "tunai"){
                echo "<tr style='background-color: #d6ffd9'>";
              }
              ?>

              <td><?php echo $list->kode_penjualan; ?></td>
              <td><?php echo TanggalIndo($list->tanggal_pengiriman); ?></td>
              <td><?php echo $list->nama_penerima; ?></td>
              <td><?php echo cek_jenis_transaksi($list->jenis_transaksi); ?></td>
              <td><?php echo format_rupiah($list->total_nominal); ?></td>
              <td><?php echo cek_status_pengiriman($list->status); ?></td>
              <td><?php echo get_detail($list->id); ?></td>
            </tr>
            <?php $nomor++; } ?>
          </tbody>
          <tfoot>
            <tr width="100%">
              <th>No. Nota</th>
              <th>Tanggal Pengiriman</th>
              <th>Nama Customer</th>
              <th>Jenis Transaksi</th>
              <th>Total</th>
              <th>Status</th>
              <th width="10%">Action</th>
            </tr>
          </tfoot>
        </table>