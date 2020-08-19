<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class taking_order extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at h  ttp://example.com/
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

    public function daftar()
    {
        $data['aktif']='master';
        $data['konten'] = $this->load->view('taking_order/bahan_baku/daftar_to', NULL, TRUE);
        $data['halaman'] = $this->load->view('bahan_baku/menu', $data, TRUE);
        $this->load->view('bahan_baku/main', $data);	

    }

    public function menu()
    {
        $data['aktif']='master';
        $data['konten'] = $this->load->view('master/menu', NULL, TRUE);
        $data['halaman'] = $this->load->view('bahan_baku/menu', $data, TRUE);
        $this->load->view('bahan_baku/main', $data);		
    }

    public function tambah()
    {
        $data['aktif']='master';
        $data['konten'] = $this->load->view('bahan_baku/tambah_to', NULL, TRUE);
        $data['halaman'] = $this->load->view('bahan_baku/menu', $data, TRUE);
        $this->load->view('bahan_baku/main', $data);		
    }
    
    public function detail()
    {
        $data['aktif']='master';
        $data['konten'] = $this->load->view('bahan_baku/detail_to', NULL, TRUE);
        $data['halaman'] = $this->load->view('bahan_baku/menu', $data, TRUE);
        $this->load->view('bahan_baku/main', $data);		
    }
    
    public function get_produk_manual()
    {
        $kode = $this->input->post('id_menu');
        $menu = $this->db->get_where('master_bahan_baku', array('kode_bahan_baku' => $kode));
        $hasil_menu = $menu->row();
        /*echo '
        <input type="text" name="id_penjualan" id="id_penjualan" value="" hidden/>

        <select name="menu" onchange="get_harga()" id="menu" class="form-control select2">


        <option value="'.@$hasil_menu->kode_menu.'" selected="true">'.@$hasil_menu->nama_menu.'</option>

        </select>
        ';*/

        if (count($hasil_menu) > 0) {
            echo json_encode($hasil_menu);
        } else {
            $pesan = array("pesan" => "tidak");
            echo json_encode($pesan);
        }


    }
    
    public function get_satuan_stok()
    {
        $data = $this->input->post();
        $opsi_satuan = $this->db->get_where('opsi_bahan_baku', array('kode_bahan_baku' =>
            $data['id_menu']));
        $hasil_opsi = $opsi_satuan->result();
        $pesan = "";
        echo "<option value='' selected='true'>-Pilih Satuan-</option>";
        foreach ($hasil_opsi as $hasil_opsi) {
            $pesan = "<option value='$hasil_opsi->kode_satuan'>$hasil_opsi->nama_satuan</option>";
            echo $pesan;
        }

    }
    public function get_harga()
    {
        $kode = $this->input->post('id_menu');
        $qty = $this->input->post('qty');
        $menu = $this->db->get_where('master_bahan_baku', array('kode_bahan_baku' => $kode));
        $hasil_menu = $menu->row();
        if($hasil_menu->qty_grosir==''){
            echo @$hasil_menu->harga_jual_1; 
        } else if($qty >= $hasil_menu->qty_grosir){
            echo @$hasil_menu->harga_jual_2; 
        } else {
            echo @$hasil_menu->harga_jual_1; 
        }
        
    }
    public function simpan_pesanan_temp()
    {
        $masukan = $this->input->post();


        $kode_produk = $masukan['kode_menu'];
        $get_menu = $this->db->get_where('master_bahan_baku', array('kode_bahan_baku' =>
            $kode_produk));
        $hasil_getmenu = $get_menu->row();

        $cek_menu = $this->db->get_where('opsi_taking_order_temp', array(
            'kode_penjualan' => $masukan['kode_penjualan'],
            'kode_menu' => $kode_produk,
            'kode_satuan' => $masukan['satuan_stok']));
        $hasil_cek_menu = $cek_menu->row();

        $cek_satuan = $this->db->get_where('opsi_bahan_baku', array('kode_bahan_baku' =>
            $kode_produk, 'kode_satuan' => $masukan['satuan_stok']));
        $hasil_cek_satuan = $cek_satuan->row();
        if (count($hasil_cek_menu) < 1) {
            $masukan['nama_menu'] = $hasil_getmenu->nama_bahan_baku;
            $masukan['kode_satuan'] = $masukan['satuan_stok'];
            $masukan['nama_satuan'] = $hasil_cek_satuan->nama_satuan;
            if($masukan['jenis_diskon'] == 'persen'){
                $masukan['diskon_item'] = $masukan['diskon_item'];
                $harga_diskon = (($masukan['jumlah'] * $masukan['harga_satuan']) * $masukan['diskon_item']) / 100;
                $masukan['harga_satuan'] = $masukan['harga_satuan'];
                $subtotal = ($masukan['jumlah'] * $masukan['harga_satuan']) - $harga_diskon;
            } else{
                $masukan['diskon_rupiah'] = $masukan['diskon_rupiah'];
                $masukan['harga_satuan'] = $masukan['harga_satuan'];
                $subtotal = ($masukan['jumlah'] * $masukan['harga_satuan']) - $masukan['diskon_rupiah'];
            }
            $masukan['jenis_diskon'] = $masukan['jenis_diskon'];
            $masukan['subtotal'] = $subtotal;
            $masukan['status_menu'] = $hasil_getmenu->status_produk;
            unset($masukan['satuan_stok']);
            $this->db->insert('opsi_taking_order_temp', $masukan);
        } else {
            $updatemenu['nama_menu'] = $hasil_getmenu->nama_bahan_baku;
            $updatemenu['kode_satuan'] = $masukan['satuan_stok'];
            $updatemenu['nama_satuan'] = $hasil_cek_satuan->nama_satuan;
            $updatemenu['jumlah'] = $masukan['jumlah'] + $hasil_cek_menu->jumlah;
            if($updatemenu['jumlah'] >= $hasil_getmenu->qty_grosir){
                $masukan['harga_satuan'] = $hasil_getmenu->harga_jual_2;
            }
            if($masukan['jenis_diskon'] == 'persen'){
                $updatemenu['diskon_item'] = $masukan['diskon_item'];
                $updatemenu['harga_satuan'] = $masukan['harga_satuan'];
                $harga_diskon = ((($masukan['jumlah'] + $hasil_cek_menu->jumlah) * $updatemenu['harga_satuan']) * $updatemenu['diskon_item']) / 100;
                $subtotal = (($masukan['jumlah'] + $hasil_cek_menu->jumlah) * $updatemenu['harga_satuan']) - $harga_diskon;
            } else{
                $updatemenu['diskon_rupiah'] = $masukan['diskon_rupiah'];
                $updatemenu['harga_satuan'] = $masukan['harga_satuan'];
                $subtotal = (($masukan['jumlah'] + $hasil_cek_menu->jumlah) * $updatemenu['harga_satuan']) - $updatemenu['diskon_rupiah'];
            }
            $updatemenu['jenis_diskon'] = $masukan['jenis_diskon'];
            $updatemenu['subtotal'] = $subtotal;
            $updatemenu['status_menu'] = $hasil_getmenu->status_produk;

            $this->db->update('opsi_taking_order_temp', $updatemenu, array(
                'kode_penjualan' => $masukan['kode_penjualan'],
                'kode_menu' => $kode_produk,
                'kode_satuan' => $masukan['satuan_stok']));
        }


        echo "berhasil";


    }
    
    public function pesanan_temp()
    {
        @$kode = $this->uri->segment(4);
        @$data['kode'] = @$kode;
        $this->load->view('bahan_baku/daftar_pesanan_temp', $data);
    }
    
    public function hapus_pesanan_temp()
    {
        $id = $this->input->post('id');
        $cek = $this->db->get_where('opsi_taking_order_temp', array('id' => $id));
        $hasil_cek = $cek->row();

        $this->db->group_by('kode_penjualan');
        $cek_gabung = $this->db->get_where('opsi_taking_order_temp', array('kode_menu' =>
            $hasil_cek->kode_menu, 'kode_penjualan' => $hasil_cek->kode_penjualan));
        $hasil_cek_gabung = $cek_gabung->result();

        foreach ($hasil_cek_gabung as $hapus) {
            $cek_menu = $this->db->get_where('master_menu', array('kode_menu' => $hapus->kode_menu));
            $hasil_cek_menu = $cek_menu->row();
            if ($hasil_cek_menu->status_menu == "reguler") {

            }elseif ($hasil_cek_menu->status_menu == "tambahan") {

            }

            $this->db->delete('opsi_taking_order_temp', array('kode_menu' => $hapus->kode_menu, 'kode_penjualan' => $hapus->kode_penjualan,'kode_satuan'=>$hasil_cek->kode_satuan));
        }

    }
    
    public function simpan_taking_order(){
        $data = $this->input->post();
        $tgl = date("Y-m-d");
        $this->db->select_max('urut');
        $result = $this->db->get_where('taking_order');
        $hasil = @$result->result();
        if($result->num_rows()) $no = ($hasil[0]->urut)+1;
        else $no = 1;

        if($no<10)$no = '000'.$no;
        else if($no<100)$no = '00'.$no;
        else if($no<1000)$no = '0'.$no;
        else if($no<10000)$no = ''.$no;
                  //else if($no<100000)$no = $no;
        $code = $no;

        $this->db->select_max('id');
        $get_max_po = $this->db->get('taking_order');
        $max_po = $get_max_po->row();

        $this->db->where('id', $max_po->id);
        $get_po = $this->db->get('taking_order');
        $po = $get_po->row();
        $tahun = substr(@$po->kode_transaksi, 3,4);
        if(date('Y')==$tahun){
          $nomor = substr(@$po->kode_transaksi, 8);
          $nomor = $nomor + 1;
          $string = strlen($nomor);
          if($string == 1){
            $kode_trans = 'TO_'.date('Y').'_00000'.$nomor;
          } else if($string == 2){
            $kode_trans = 'TO_'.date('Y').'_0000'.$nomor;
          } else if($string == 3){
            $kode_trans = 'TO_'.date('Y').'_000'.$nomor;
          } else if($string == 4){
            $kode_trans = 'TO_'.date('Y').'_00'.$nomor;
          } else if($string == 5){
            $kode_trans = 'TO_'.date('Y').'_0'.$nomor;
          } else if($string == 6){
            $kode_trans = 'TO_'.date('Y').'_'.$nomor;
          }
        } else {
          $kode_trans = 'TO_'.date('Y').'_000001';
        }

        $opsi_order = $this->db->get_where('opsi_taking_order_temp',array('kode_kasir'=>$data['kode_kasir']));
        $hasil_opsi = $opsi_order->result();
        foreach($hasil_opsi as $daftar){
            $masukkan['kode_kasir'] = $daftar->kode_kasir;
            $masukkan['kode_transaksi'] = $kode_trans;
            $masukkan['kategori_menu'] = $daftar->kategori_menu;
            $masukkan['kode_menu'] = $daftar->kode_menu;
            $masukkan['nama_menu'] = $daftar->nama_menu;
            $masukkan['jumlah'] = $daftar->jumlah;
            $masukkan['kode_satuan'] = $daftar->kode_satuan;
            $masukkan['nama_satuan'] = $daftar->nama_satuan;
            $masukkan['harga_satuan'] = $daftar->harga_satuan;
            $masukkan['jenis_diskon'] = @$daftar->jenis_diskon;
            $masukkan['diskon_item'] = @$daftar->diskon_item;
            $masukkan['diskon_rupiah'] = @$daftar->diskon_rupiah;
            $masukkan['subtotal'] = $daftar->subtotal;
            $masukkan['status_menu'] = $daftar->status_menu;
            $this->db->insert('opsi_taking_order', $masukkan);
        }
        $this->db->delete('opsi_taking_order_temp',array('kode_kasir'=>$data['kode_kasir']));
        
        $taking_order['kode_kasir'] = $data['kode_kasir'];
        $taking_order['kode_transaksi'] = $kode_trans;
        $taking_order['nama_penerima'] = $data['penerima'];
        $taking_order['no_telp'] = $data['no_telp'];
        $taking_order['alamat'] = $data['alamat'];
        $taking_order['waktu_pengiriman'] = $data['jam_kirim'];
        $taking_order['tanggal_pengiriman'] = $data['tgl_kirim'];
        $taking_order['tanggal_transaksi'] = date("Y-m-d");
        $taking_order['status_penerimaan'] = $data['jenis_pengiriman'];
        $taking_order['urut'] = $no;
        $this->db->insert('taking_order',$taking_order);
    }
    


}
