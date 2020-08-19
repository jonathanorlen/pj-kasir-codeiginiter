<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class retur_penjualan extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
    $this->load->library('form_validation');
  }	

    //------------------------------------------ View Data Table----------------- --------------------//
  
  public function daftar_retur_penjualan()
  {
   $data['aktif']='retur_penjualan';
   $data['konten'] = $this->load->view('retur_penjualan/retur_penjualan/daftar_retur_penjualan', NULL, TRUE);
   $data['halaman'] = $this->load->view('menu', $data, true);
   $this->load->view ('main', $data);   
 }

 public function tambah()
 {
  $data['aktif']='retur_penjualan';
  $data['konten'] = $this->load->view('retur_penjualan/retur_penjualan/tambah_retur_penjualan', NULL, TRUE);
  $data['halaman'] = $this->load->view('menu', $data, true);
  $this->load->view ('main', $data);   	
}

public function detail($kode)
{
  $data['kode'] = $kode; 
  $data['aktif']='retur_penjualan';
  $data['konten'] = $this->load->view('retur_penjualan/retur_penjualan/detail_retur_penjualan', NULL, TRUE);
  $data['halaman'] = $this->load->view('menu', $data, true);
  $this->load->view ('main', $data);    		
}

public function cetak_retur_penjualan(){
  @$kode = $this->uri->segment(4);
  $get_id_petugas = $this->session->userdata('astrosession');
  $id_petugas = $get_id_petugas->id;
  $nama_petugas = $get_id_petugas->uname;
  @$data['kode'] = @$kode;
  @$data['id_petugas'] = @$id_petugas;
  @$data['nama_petugas'] = @$nama_petugas;
  $this->load->view('retur_penjualan/retur_penjualan/cetak_retur_penjualan',$data);
}

public function tabel_temp_data_transaksi($kode)
{
  $data['diskon'] = $this->diskon_tabel();
  $data['kode'] = $kode ;
  $this->load->view ('retur_penjualan/retur_penjualan/tabel_transaksi_temp',$data);		
}

public function get_retur_penjualan(){
  @$kode = $this->uri->segment(3);
  @$data['kode'] = @$kode ;
  $this->load->view('retur_penjualan/retur_penjualan/tabel_transaksi_temp',$data);
}

public function get_retur(){
  @$kode = $this->uri->segment(4);
  @$data['kode'] = @$kode ;
  $this->load->view('retur_penjualan/retur_penjualan/tabel_transaksi_retur_temp',$data);
}

public function get_form(){
  @$id = $this->input->post('id');
  @$data['id'] = @$id ;
  $this->load->view('retur_penjualan/retur_penjualan/form_penyesuaian',$data);
}


public function get_transaksi_penjualan(){
  $data = $this->input->post();
  $kode_penjualan = $data['penjualan'];
  
  $cek_penjualan = $this->db->get_where('transaksi_penjualan',array('kode_penjualan'=>$kode_penjualan));
  $hasil_penjualan = $cek_penjualan->row();
  
  echo TanggalIndo($hasil_penjualan->tanggal_penjualan);
}

public function cari_penjualan(){
  $data = $this->input->post();
  $kode_penjualan = $data['kode_penjualan'];
  $this->db->group_by('kode_penjualan');
  $cek_penjualan = $this->db->get_where('transaksi_penjualan',array('kode_penjualan'=>$kode_penjualan));
  $hasil_penjualan = $cek_penjualan->row();

  echo json_encode($hasil_penjualan);


  
}

public function search_retur()
{
  $data['konten'] = $this->load->view('retur_penjualan/retur_penjualan/search_retur');
}

	//------------------------------------------ Proses ----------------- --------------------//


public function simpan_item_temp()
{
  $masukan = $this->input->post();
  $nama_suplier = $this->db->get_where('master_supplier',array('kode_supplier'=>$masukan['kode_supplier']));
  $hasil_nama_supplier = $nama_suplier->row();
  $masukan['nama_supplier'] = $hasil_nama_supplier->nama_supplier;
  $subtotal = $masukan['jumlah']*$masukan['harga_satuan'];
  $masukan['subtotal'] = $subtotal;
  $this->db->insert('opsi_transaksi_retur_penjualan_temp',$masukan);
  echo "sukses";
  
  
}

public function update_item_temp(){
  $update = $this->input->post();
  #==================================INSERT DI OPSI RETUR TEMP===============#
  $opsi_retur['kode_retur'] = $update['kode_retur'];
  $opsi_retur['kode_produk'] = $update['kode_menu'];
  $opsi_retur['nama_produk'] = $update['nama_menu'];
  $opsi_retur['jumlah'] = $update['jumlah'];
  
  $harga = $this->db->get_where('opsi_transaksi_penjualan',array('kode_penjualan'=>$update['kode_penjualan'],'kode_menu'=>$update['kode_menu']));
  $hasil_harga = $harga->row();
  $opsi_retur['harga_satuan'] = $hasil_harga->harga_satuan;
  $opsi_retur['diskon_item'] = $hasil_harga->diskon_item;
  //$opsi_retur['kode_member'] = $hasil_harga->kode_member;
  //$opsi_retur['nama_member'] = $hasil_harga->nama_member;
  $opsi_retur['subtotal'] = $opsi_retur['harga_satuan'] * $opsi_retur['jumlah'];
  $opsi_retur['status'] = 'retur';
  $opsi_retur['kode_penjualan'] = $update['kode_penjualan']; 
  $opsi_retur['kode_kasir'] = $update['kode_kasir'];
  
  $cek_retur = $this->db->get_where('opsi_transaksi_retur_penjualan_temp',array('kode_retur'=>$update['kode_retur'],
    'kode_produk'=>$update['kode_menu']));
  $hasil_cek = $cek_retur->result();
  
  if(count($hasil_cek)<1){
    $this->db->insert('opsi_transaksi_retur_penjualan_temp',$opsi_retur);
  }else{
    $this->db->update('opsi_transaksi_retur_penjualan_temp',$opsi_retur,array('kode_retur'=>$update['kode_retur'],
      'kode_produk'=>$update['kode_menu']));
  }
  #=====================================================#
  
  #=======================UPDATE OPSI TRANSAKSI PENJUALAN=========#
  $get_produk = $this->db->get_where('opsi_transaksi_penjualan',array('kode_penjualan'=>$update['kode_penjualan'],
    'kode_menu'=>$update['kode_menu']));
  $hasil_produk = $get_produk->row();
  
  $opsi_penjualan['jumlah'] = $hasil_produk->jumlah - $update['jumlah'];
  $opsi_penjualan['subtotal'] = $hasil_produk->harga_satuan * $opsi_penjualan['jumlah'];
  
  //$this->db->update('opsi_transaksi_penjualan',$opsi_penjualan,array('kode_penjualan'=>$update['kode_penjualan'],
   // 'kode_menu'=>$update['kode_menu']));
  #==============================================================================#
}

public function batal_retur(){
  $batal = $this->input->post();

  $cek_produk = $this->db->get_where('opsi_transaksi_retur_penjualan_temp',array('kode_produk'=>$batal['kode_produk'],
    'kode_penjualan'=>$batal['kode_penjualan']));
  $hasil_cek = $cek_produk->row();

  $cek_produk_penjualan = $this->db->get_where('opsi_transaksi_penjualan',array('kode_menu'=>$batal['kode_produk'],
    'kode_penjualan'=>$batal['kode_penjualan']));
  $hasil_cek_penjualan = $cek_produk_penjualan->row();

  $opsi_penjualan['jumlah'] = $hasil_cek->jumlah + $hasil_cek_penjualan->jumlah;
  $opsi_penjualan['subtotal'] = $hasil_cek_penjualan->harga_satuan * $opsi_penjualan['jumlah'];
  //$this->db->update('opsi_transaksi_penjualan',$opsi_penjualan,array('kode_penjualan'=>$batal['kode_penjualan'],
  //  'kode_menu'=>$batal['kode_produk']));

  $this->db->delete('opsi_transaksi_retur_penjualan_temp',array('kode_produk'=>$batal['kode_produk'],
    'kode_penjualan'=>$batal['kode_penjualan']));        
}

public function hapus_bahan_temp(){
  $id = $this->input->post('id');
  $this->db->delete('opsi_transaksi_retur_penjualan_temp',array('id'=>$id));
}

public function get_list_bahan()
{
  $opt = '';
  $bahan_baku = $this->db->get_where('master_bahan_baku',array('kode_unit'=>'U001'));
  $hasil_bahan_baku = $bahan_baku->result();
  $opt = '<option value="">--Pilih Produk--</option>';
  foreach($hasil_bahan_baku as $daftar){
    $opt .= '<option value="'.$daftar->kode_produk.'">'.$daftar->nama_produk.'</option>';
  }

  echo $opt;
}

public function get_satuan()
{
  $kode_produk = $this->input->post('kode_produk');
  $kode_member = $this->input->post('kode_member');

  $data_member = $this->db->get_where('master_member',array('kode_member'=>$kode_member));
  $hasil_data_member = $data_member->row();
  
  $member = $this->db->get_where('transaksi_penjualan',array('kode_member'=>$kode_member));
  $hasil_member = $member->row();
  
  if($hasil_member->kode_member == ""){
    $nama_produk = $this->db->query("SELECT kode_produk,nama_produk,kode_unit,nama_unit,kode_rak,nama_rak,
      harga_jual as harga FROM master_produk WHERE kode_produk = '$kode_produk'");

  }else{
    $kategori_harga = $hasil_data_member->kategori;
    if($kategori_harga==1){
      $nama_produk = $this->db->query("SELECT kode_produk,nama_produk,kode_unit,nama_unit,kode_rak,nama_rak,
        harga_1 as harga FROM master_produk WHERE kode_produk = '$kode_produk'");
    }elseif($kategori_harga==2){
      $nama_produk = $this->db->query("SELECT kode_produk,nama_produk,kode_unit,nama_unit,kode_rak,nama_rak,
        harga_2 as harga FROM master_produk WHERE kode_produk = '$kode_produk'");
    }else{
      $nama_produk = $this->db->query("SELECT kode_produk,nama_produk,kode_unit,nama_unit,kode_rak,nama_rak,
        harga_3 as harga FROM master_produk WHERE kode_produk = '$kode_produk'");
    }


  }
  
  $hasil_bahan = $nama_produk->row();
  echo json_encode($hasil_bahan);
}

public function simpan_item_penjualan_temp()
{
  $masukan = $this->input->post();

  $jumlah_stok = $this->db->get_where('master_produk',array('kode_produk'=>$masukan['kode_produk']));
  $hasil_jumlah_stok = $jumlah_stok->row();
  $stok_pack = $hasil_jumlah_stok->stok_pack;
  $real_stock = $hasil_jumlah_stok->real_stock;

  if ($stok_pack < $masukan['jumlah'] || $real_stock < $masukan['jumlah_konversi']) {
    echo "tidak cukup";   
  }else{
    $masukan['kode_satuan'] = $hasil_jumlah_stok->id_satuan_stok;
    $masukan['nama_satuan'] = $hasil_jumlah_stok->satuan_stok;
    $total = $masukan['jumlah_konversi'] * $masukan['harga_satuan'];
    $diskon = $total * $masukan['diskon_item']/100;
    $masukan['subtotal'] = $total - $diskon;
    $masukan['status'] = 'retur_produk';
    $this->db->insert('opsi_transaksi_retur_penjualan_temp',$masukan);
    echo "sukses";
  }     
}

public function get_temp_retur_penjualan(){
  $id = $this->input->post('id');
  $penjualan = $this->db->get_where('opsi_transaksi_retur_penjualan_temp',array('id'=>$id));
  $hasil_penjualan = $penjualan->row();
  echo json_encode($hasil_penjualan);
}

public function update_item_retur_penjualan_temp(){
  $update = $this->input->post();

  $jumlah_stok = $this->db->get_where('master_produk',array('kode_produk'=>$update['kode_produk']));
  $hasil_jumlah_stok = $jumlah_stok->row();
  $stok_pack = $hasil_jumlah_stok->stok_pack;
  $real_stock = $hasil_jumlah_stok->real_stock;

  if ($stok_pack < $update['jumlah'] || $real_stock < $update['jumlah_konversi']) {
    echo "tidak cukup";   
  }else{
    $update['kode_satuan'] = $hasil_jumlah_stok->id_satuan_stok;
    $update['nama_satuan'] = $hasil_jumlah_stok->satuan_stok;
    $total = $update['jumlah_konversi'] * $update['harga_satuan'];
    $diskon = $total * $update['diskon_item']/100;
    $update['subtotal'] = $total - $diskon;
    $update['status'] = 'retur_produk';
    $this->db->update('opsi_transaksi_retur_penjualan_temp',$update,array('id'=>$update['id']));
    echo "sukses";
  } 
}

public function hapus_retur_penjualan_temp(){
  $id = $this->input->post('id');
  $this->db->delete('opsi_transaksi_retur_penjualan_temp',array('id'=>$id));
}

public function simpan_retur_penjualan(){
  $masukan = $this->input->post();

  $get_id_petugas = $this->session->userdata('astrosession');
  $id_petugas = $get_id_petugas->id;
  $nama_petugas = $get_id_petugas->uname;

  $retur_produk = $this->db->get_where('opsi_transaksi_retur_penjualan_temp',array('kode_penjualan'=>$masukan['kode_penjualan']));
  $hasil_retur_produk = $retur_produk->result();

  $total_retur_penjualan = 0;
  foreach ($hasil_retur_produk as $daftar) {
    $opsi_retur['kode_kasir'] = $daftar->kode_kasir;
    $opsi_retur['kode_retur'] = $masukan['kode_retur'];
    $opsi_retur['kode_produk'] = $daftar->kode_produk;
    $opsi_retur['nama_produk'] = $daftar->nama_produk;
    $opsi_retur['jumlah'] = $daftar->jumlah;
    $opsi_retur['harga_satuan'] = $daftar->harga_satuan;
    $opsi_retur['diskon_item'] = $daftar->diskon_item;
    //$opsi_retur['kode_member'] = $daftar->kode_member;
    //$opsi_retur['nama_member'] = $daftar->nama_member;
    $opsi_retur['subtotal'] = $daftar->subtotal;
    $opsi_retur['status'] = $daftar->status;
    $opsi_retur['kode_penjualan'] = $daftar->kode_penjualan;

    $total_retur_penjualan += $daftar->subtotal;

    $tabel_opsi_retur = $this->db->insert('opsi_transaksi_retur_penjualan',$opsi_retur);
  }

  if (count($hasil_retur_produk) > 0) {

    foreach ($hasil_retur_produk as $item) {
      $produk = $this->db->get_where('master_bahan_baku',array('kode_bahan_baku'=>$item->kode_produk));
      $hasil_produk = $produk->row();
      $stok['real_stock'] = $hasil_produk->real_stock + $item->jumlah;
      $this->db->update('master_bahan_baku',$stok,array('kode_bahan_baku'=>$item->kode_produk));

      $hpp_produk = $this->db->get_where('transaksi_stok',array('kode_bahan'=>$item->kode_produk));
      $hasil_hpp_produk = $hpp_produk->row();

      $transaksi_stok['jenis_transaksi'] = 'retur penjualan';
      $transaksi_stok['kode_transaksi'] = $masukan['kode_retur'];
      $transaksi_stok['kode_bahan'] = $item->kode_produk;
      $transaksi_stok['nama_bahan'] = $item->nama_produk;
      $transaksi_stok['stok_masuk'] = $item->jumlah;
      $transaksi_stok['sisa_stok'] = $item->jumlah;
      $transaksi_stok['hpp'] = @$hasil_hpp_produk->hpp;
      $transaksi_stok['id_petugas'] = $id_petugas;
      $transaksi_stok['nama_petugas'] = $nama_petugas;
      $transaksi_stok['tanggal_transaksi'] = date("Y-m-d");
      $transaksi_stok['posisi_awal'] = 'supplier';
      $transaksi_stok['posisi_akhir'] = 'gudang';

      //$posisi = $this->db->get_where('master_produk',array('kode_produk'=>$item->kode_produk));
      //$hasil_posisi = $posisi->row();
      //$transaksi_stok['kode_unit_tujuan'] = $hasil_posisi->kode_unit;
      //$transaksi_stok['nama_unit_tujuan'] = $hasil_posisi->nama_unit;
      //$transaksi_stok['kode_rak_tujuan'] = $hasil_posisi->kode_rak;
      //$transaksi_stok['nama_rak_tujuan'] = $hasil_posisi->nama_rak;

      $this->db->insert('transaksi_stok',$transaksi_stok);

      /*$stok_produk = $this->db->get_where('transaksi_stok',array('kode_bahan'=>$item->kode_produk));
      $hasil_stok_produk = $stok_produk->row();
      $stok_in['sisa_stok'] = $hasil_stok_produk->sisa_stok + $item->jumlah;
      $this->db->update('transaksi_stok',$stok_in,array('kode_bahan'=>$item->kode_produk));

      $trx_penjualan = $this->db->get_where('opsi_transaksi_penjualan',array('kode_penjualan'=>$item->kode_penjualan));
      $hasil_trx_penjualan = $trx_penjualan->result();*/

      //$total_trx_penjualan = 0;
      //foreach ($hasil_trx_penjualan as $value) {
      //  $total_trx_penjualan += $value->subtotal;

      //  $trx_jual = $this->db->get_where('transaksi_penjualan',array('kode_penjualan'=>$item->kode_penjualan));
      //  $hasil_trx_jual = $trx_jual->row();

        //$subtotal_trx_penjualan['total_nominal'] = $total_trx_penjualan;
        //$subtotal_trx_penjualan['grand_total'] = $total_trx_penjualan - $hasil_trx_jual->diskon_rupiah;
        //$subtotal_trx_penjualan['nominal_retur'] = $masukan['nominal_retur'];
        //echo $subtotal_trx_penjualan['nominal_retur'] = $masukan['nominal_retur'];
        //$subtotal_trx_penjualan['status_retur'] = 'retur';
        //echo $subtotal_trx_penjualan['status'] = 'retur';
        //$this->db->update('transaksi_penjualan',$subtotal_trx_penjualan,array('kode_penjualan'=>$item->kode_penjualan));

        //if ($item->kode_member == '0') {
        //$nominal_masuk['nominal'] = $hasil_trx_jual->grand_total - $masukan['nominal_retur'];
        //$this->db->update('keuangan_masuk',$nominal_masuk,array('kode_referensi'=>$item->kode_penjualan));


        
        /*} else if ($item->kode_member != '0' && $hasil_trx_jual->proses_pembayaran == 'kredit'){
          $tot_nominal = $total_trx_penjualan - $hasil_trx_jual->diskon_rupiah + $hasil_trx_jual->biaya_pengiriman;
          $uang_masuk = $this->db->get_where('keuangan_masuk',array('kode_referensi'=>$item->kode_penjualan));
          $hasil_uang_masuk = $uang_masuk->row();

          $trx_piutang = $this->db->get_where('transaksi_piutang',array('kode_transaksi'=>$item->kode_penjualan));
          $hasil_trx_piutang = $trx_piutang->row();

          $nom_piutang = $tot_nominal - $hasil_uang_masuk->nominal;
          $piutang['nominal_piutang'] = $nom_piutang;
          $piutang['sisa'] = $nom_piutang - $hasil_trx_piutang->angsuran;
          $this->db->update('transaksi_piutang',$piutang,array('kode_transaksi'=>$item->kode_penjualan));
        } else if ($item->kode_member != '0' && $hasil_trx_jual->proses_pembayaran == 'tunai'){
          $nominal_masuk['nominal'] = $total_trx_penjualan - $hasil_trx_jual->diskon_rupiah + $hasil_trx_jual->biaya_pengiriman;
          $this->db->update('keuangan_masuk',$nominal_masuk,array('kode_referensi'=>$item->kode_penjualan));
        }*/
      //}

      
      
    }
  }
  $kategori = $this->db->get_where('keuangan_sub_kategori_akun',array('kode_sub_kategori_akun'=>'2.4.1'));
  $hasil_kategori = $kategori->row();

  $nominal_retur['kode_jenis_keuangan'] =$hasil_kategori->kode_jenis_akun;// '2';
  $nominal_retur['nama_jenis_keuangan'] = $hasil_kategori->nama_jenis_akun;//'Pengeluaran';
  $nominal_retur['kode_kategori_keuangan'] =$hasil_kategori->kode_kategori_akun;// '2.4';
  $nominal_retur['nama_kategori_keuangan'] = $hasil_kategori->nama_kategori_akun;//'Retur Penjualan';
  $nominal_retur['kode_sub_kategori_keuangan'] =$hasil_kategori->kode_sub_kategori_akun;// '2.4.1';
  //$this->db->select('nama_sub_kategori_akun');
  
  $nominal_retur['nama_sub_kategori_keuangan'] = $hasil_kategori->nama_sub_kategori_akun;
  $nominal_retur['nominal'] = $masukan['nominal_retur'];
  $nominal_retur['tanggal_transaksi'] = date('Y-m-d');
  $nominal_retur['id_petugas'] = $id_petugas;
  $nominal_retur['petugas'] = $nama_petugas;
  $nominal_retur['kode_referensi'] = $masukan['kode_retur'];
  $this->db->insert('keuangan_keluar',$nominal_retur);

  $transaksi['kode_kasir'] = $masukan['kode_kasir'];
  $transaksi['kode_retur'] = $masukan['kode_retur'];
  $transaksi['kode_penjualan'] = $masukan['kode_penjualan'];
  $transaksi['tanggal_retur'] = date("Y-m-d");
  //$transaksi['kode_member'] = $masukan['kode_member'];
  //$transaksi['nama_member'] = $masukan['nama_member'];
  $transaksi['total_nominal'] = $total_retur_penjualan;
  $transaksi['grand_total'] = $total_retur_penjualan;
  $transaksi['nominal_retur'] = $masukan['nominal_retur'];
  $transaksi['id_petugas'] = $id_petugas;
  $transaksi['petugas'] = $nama_petugas;
  $transaksi['keterangan'] = '';

  $this->db->select_max('urut');    
                  $result = $this->db->get_where('transaksi_retur_penjualan');
                  $hasil = @$result->result();
                  if($result->num_rows()) $no = ($hasil[0]->urut)+1;
                  else $no = 1;

                  if($no<10)$no = '0000'.$no;
                  else if($no<100)$no = '000'.$no;
                  else if($no<1000)$no = '00'.$no;
                  else if($no<10000)$no = '0'.$no;
                  else if($no<10000)$no = ''.$no;
                  //else if($no<100000)$no = $no;
                  $code = $no;
  $transaksi['kode_transaksi'] = "RTPEN_".$code;
  $transaksi['urut'] = $code;
  $this->db->insert('transaksi_retur_penjualan',$transaksi);
  
  $kode_keuangan = $this->db->get_where('keuangan_sub_kategori_akun',array('kode_sub_kategori_akun'=>'2.4.1'));
  $hasil_kode = $kode_keuangan->row();
  
  
  
  $this->db->delete('opsi_transaksi_retur_penjualan_temp',array('kode_penjualan'=>$masukan['kode_penjualan']));


}

public function batal_retur_penjualan(){
  $kode = $this->input->post('kode_penjualan');
  $retur_temp = $this->db->get_where('opsi_transaksi_retur_penjualan_temp',array('kode_penjualan'=>$kode));
  $hasil_temp = $retur_temp->result();
  
  /*foreach($hasil_temp as $daftar){
    $cek_opsi_penjualan = $this->db->get_where('opsi_transaksi_penjualan',array('kode_penjualan'=>$kode,
    'kode_menu'=>$daftar->kode_produk));
    $hasil_opsi = $cek_opsi_penjualan->row();
    $update['jumlah'] = $daftar->jumlah + $hasil_opsi->jumlah;
    $update['subtotal'] = ($daftar->jumlah + $hasil_opsi->jumlah) * $hasil_opsi->harga_satuan;
    $this->db->update('opsi_transaksi_penjualan',$update,array('kode_penjualan'=>$kode,'kode_menu'=>$daftar->kode_produk));
  }*/
  $this->db->delete('opsi_transaksi_retur_penjualan_temp',array('kode_penjualan'=>$kode));

}

}
