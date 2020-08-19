<?php
$param = $this->input->post();
if(@$param['tgl_awal'] && @$param['tgl_akhir']){

  $tgl_awal = $param['tgl_awal'];
  $tgl_akhir = $param['tgl_akhir'];

  $this->db->where('tanggal_penjualan >=', $tgl_awal);
  $this->db->where('tanggal_penjualan <=', $tgl_akhir);
}
if(@$param['petugas']){
  $petugas = $param['petugas'];
  $this->db->where('id_petugas',$petugas);
}
?>
<?php
$user = $this->session->userdata('astrosession');
$id_petugas = $user->id;

$this->db->select('*'); 
$this->db->distinct();

$this->db->where('id_petugas',$id_petugas) ;
$this->db->select('kode_penjualan');
$this->db->order_by('kode_penjualan','desc');
$this->db->group_by('kode_penjualan');
$penjualan = $this->db->get('transaksi_penjualan');
$hasil_penjualan = $penjualan->result();
// $this->db->last_query();


$this->db->select('*'); 
$this->db->distinct();

$this->db->where('tanggal_transaksi',date('Y-m-d'));
$this->db->where('id_petugas',$id_petugas);
$this->db->where('nama_kategori_keuangan','Penjualan');
$keuangan_masuk = $this->db->get('keuangan_masuk');
$hasil_keuangan_masuk = $keuangan_masuk->result();
$masuk = 0;
foreach($hasil_keuangan_masuk as $total_masuk){
  $masuk += $total_masuk->nominal;
}

?>
<div>
  <?php
  $keuangan = 0;
  foreach($hasil_penjualan as $total){
    $keuangan += $total->grand_total-$total->nominal_retur;
  }

  ?>
  <label><h4><strong>Total Transaksi Penjualan : <?php echo count($hasil_penjualan); ?></strong></h4></label><br />
  <span><label><h4><strong>Total Keuangan Penjualan :<?php echo format_rupiah($keuangan); ?></strong></h4></label></span>
  <br/>
  <span><label><h4><strong>Total Keuangan Kasir :<?php echo format_rupiah($masuk); ?></strong></h4></label></span><br>
  <?php 
  $this->db->select_sum('nominal_retur');
  $retur_penjualan = $this->db->get_where('transaksi_retur_penjualan',array('kode_kasir'=>$id_petugas));
  $hasil_retur_penjualan = $retur_penjualan->row();
  ?>
  <span><label><h4><strong>Total Keuangan Retur :<?php echo format_rupiah($hasil_retur_penjualan->nominal_retur); ?></strong></h4></label></span>
</div>
<table id="search_penjualan" class="table table-bordered table-striped" style="font-size:1.5em;">
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Kode Penjualan</th>
      <!--<th>Kode Transaksi</th>-->
      <th>Kode Member</th>
      <th>Nama Member</th>
      <th>Petugas</th>
      <th>Total</th>
      <th>Pembayaran</th>
      <th class="act">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $nomor = 1;

    foreach($hasil_penjualan as $daftar){ ?> 
    <tr>
      <td><?php echo $nomor; ?></td>
      <td><?php echo TanggalIndo(@$daftar->tanggal_penjualan);?></td>
      <td><?php echo @$daftar->kode_penjualan; ?></td>
      <!--<td><?php echo @$daftar->kode_transaksi; ?></td>-->
      <td><?php echo @$daftar->kode_member; ?></td>
      <td><?php echo @$daftar->nama_member; ?></td>
      <td><?php echo @$daftar->petugas; ?></td>
      <td><?php echo format_rupiah(@$daftar->grand_total-@$daftar->nominal_retur); ?></td>
      <td><?php echo @$daftar->jenis_transaksi; ?></td>
      <td align="center" class="act"><?php echo get_detail_penjualan($daftar->kode_penjualan); ?></td>
    </tr>
    <?php $nomor++; } ?>

  </tbody>
  <tfoot>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Kode Penjualan</th>
      <!--<th>Kode Transaksi</th>-->
      <th>Kode Member</th>
      <th>Nama Member</th>
      <th>Petugas</th>
      <th>Total</th>
      <th>Pembayaran</th>
      <th class="act">Action</th>
    </tr>
  </tfoot>
</table>
<script>
$('#search_penjualan').dataTable({
  "paging":   false,
  "info":     false
});
$("#export_exel").attr('onclick',"tableToExcel('search_penjualan', 'W3C Example Table')");
</script>