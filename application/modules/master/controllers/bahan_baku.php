<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bahan_baku extends MY_Controller {

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

    public function index()
    {
        $data['aktif']='master';
        $data['konten'] = $this->load->view('bahan_baku/daftar_bahan_baku', NULL, TRUE);
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
        $data['konten'] = $this->load->view('bahan_baku/tambah_bahan_baku', NULL, TRUE);
        $data['halaman'] = $this->load->view('bahan_baku/menu', $data, TRUE);
        $this->load->view('bahan_baku/main', $data);		
    }
    
    public function detail()
    {
        $data['aktif']='master';
        $data['konten'] = $this->load->view('bahan_baku/detail_bahan_baku', NULL, TRUE);
        $data['halaman'] = $this->load->view('bahan_baku/menu', $data, TRUE);
        $this->load->view('bahan_baku/main', $data);		
    }
    
    public function simpan()
    {
        $this->load->library('form_validation');
       // $this->form_validation->set_rules('kode_bahan_baku', 'Kode bahan baku', 'required');
        $this->form_validation->set_rules('nama_bahan_baku', 'Nama bahan baku', 'required');
        $this->form_validation->set_rules('kode_rak', 'Kode Rak', 'required');
        $this->form_validation->set_rules('id_satuan_pembelian', 'Satuan pembelian', 'required');  
        $this->form_validation->set_rules('id_satuan_stok', 'Satuan', 'required');
        $this->form_validation->set_rules('jumlah_dalam_satuan_pembelian', 'Isi dalam 1 pembelian', 'required');      
        $this->form_validation->set_rules('stok_minimal', 'Stok Minimal', 'required');      
        //jika form validasi berjalan salah maka tampilkan GAGAL
        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
            
        } 
        //jika form validasi berjalan benar maka inputkan data
        else {

            $data = $this->input->post(NULL, TRUE);
            $header_produk=$data['header_produk'];
            if(!empty($header_produk)){
                $unit = $this->db->get_where('master_unit',array('kode_unit'=>$data['kode_unit']));
                $hasil_unit = $unit->row();
                $rak = $this->db->get_where('master_rak',array('kode_rak'=>$data['kode_rak']));
                $hasil_rak = $rak->row();
                $satuan_pembelian = $this->db->get_where('master_satuan',array('kode'=>$data['id_satuan_pembelian']));
                $hasil_satuan_pembelian = $satuan_pembelian->row();
                $satuan_stok = $this->db->get_where('master_satuan',array('kode'=>$data['id_satuan_stok']));
                $kategori_produk = $this->db->get_where('master_kategori_menu',array('kode_kategori_menu'=>$data['kode_kategori_produk']));
                $hasil_kategori_produk = $kategori_produk->row();
                $this->db->select('kode_bahan_baku');
                $bb = $this->db->get('master_setting');
                $hasil_bb = $bb->row();
                $hasil_satuan_stok = $satuan_stok->row();
                $data['kode_bahan_baku'] = $header_produk.".".$data['kode_bahan_baku'];
                $data['kode_header_produk'] = $data['header_produk'];
                $data['satuan_stok'] = $hasil_satuan_stok->nama;
                $data['satuan_pembelian'] = $hasil_satuan_pembelian->nama;
                $data['nama_kategori_produk'] = $hasil_kategori_produk->nama_kategori_menu;
                $data['nama_unit'] = $hasil_unit->nama_unit;
                $data['nama_rak'] = $hasil_rak->nama_rak;
                $data['real_stock'] = 0;
                $data['status_produk'] = 'subproduk';
                unset($data['header_produk']);
                unset($data['kode_sub']);
                $this->db->insert("master_bahan_baku", $data);
                echo '1';
            }else{
                $unit = $this->db->get_where('master_unit',array('kode_unit'=>$data['kode_unit']));
                $hasil_unit = $unit->row();
                $rak = $this->db->get_where('master_rak',array('kode_rak'=>$data['kode_rak']));
                $hasil_rak = $rak->row();
                $satuan_pembelian = $this->db->get_where('master_satuan',array('kode'=>$data['id_satuan_pembelian']));
                $hasil_satuan_pembelian = $satuan_pembelian->row();
                $satuan_stok = $this->db->get_where('master_satuan',array('kode'=>$data['id_satuan_stok']));
                $this->db->select('kode_bahan_baku');
                $bb = $this->db->get('master_setting');
                $hasil_bb = $bb->row();
                $hasil_satuan_stok = $satuan_stok->row();
                $kategori_produk = $this->db->get_where('master_kategori_menu',array('kode_kategori_menu'=>$data['kode_kategori_produk']));
                $hasil_kategori_produk = $kategori_produk->row();
                $data['kode_bahan_baku'] = $hasil_bb->kode_bahan_baku.'_'.$data['kode_bahan_baku'];
                $data['satuan_stok'] = $hasil_satuan_stok->nama;
                $data['satuan_pembelian'] = $hasil_satuan_pembelian->nama;
                $data['nama_unit'] = $hasil_unit->nama_unit;
                $data['nama_rak'] = $hasil_rak->nama_rak;
                $data['real_stock'] = 0;
                $data['status_produk'] = 'produk';
                $data['nama_kategori_produk'] = $hasil_kategori_produk->nama_kategori_menu;
                unset($data['header_produk']);
                unset($data['kode_sub']);
                $this->db->insert("master_bahan_baku", $data);
                echo '1';
            }
            

        }
    }
    
    public function simpan_edit()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_bahan_baku', 'Kode bahan baku', 'required');    
        //jika form validasi berjalan salah maka tampilkan GAGAL
        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        } 
        //jika form validasi berjalan benar maka inputkan data
        else {
            $data = $this->input->post(NULL, TRUE);
            
                $unit = $this->db->get_where('master_unit',array('kode_unit'=>$data['kode_unit']));
                $hasil_unit = $unit->row();
                $rak = $this->db->get_where('master_rak',array('kode_rak'=>$data['kode_rak']));
                $hasil_rak = $rak->row();
                $kategori_produk = $this->db->get_where('master_kategori_menu',array('kode_kategori_menu'=>$data['kode_kategori_produk']));
                $hasil_kategori_produk = $kategori_produk->row();
                $satuan_pembelian = $this->db->get_where('master_satuan',array('kode'=>$data['id_satuan_pembelian']));
                $hasil_satuan_pembelian = $satuan_pembelian->row();
                $satuan_stok = $this->db->get_where('master_satuan',array('kode'=>$data['id_satuan_stok']));
                $hasil_satuan_stok = $satuan_stok->row();
                $data['satuan_stok'] = $hasil_satuan_stok->nama;
                $data['satuan_pembelian'] = $hasil_satuan_pembelian->nama;
                $data['nama_unit'] = $hasil_unit->nama_unit;
                $data['nama_rak'] = $hasil_rak->nama_rak;
                $data['nama_kategori_produk'] = $hasil_kategori_produk->nama_kategori_menu;
                unset($data['header_produk']);
                unset($data['kode_sub']);
                $this->db->update("master_bahan_baku", $data,array('kode_bahan_baku'=>$data['kode_bahan_baku']));
                echo '1';  
            
            

        }
    }   


    public function hapus(){
        $kode = $this->input->post('id');
        $get_hapus = $this->db->get_where('master_bahan_baku',array('id'=>$kode));
        $hasil_get = $get_hapus->row();
        $this->db->delete('master_bahan_baku',array('kode_bahan_baku'=>$hasil_get->kode_bahan_baku,
            'kode_unit'=>$hasil_get->kode_unit,'kode_rak'=>$hasil_get->kode_rak));
    }
    
    public function get_satuan_stok(){
        $param = $this->input->post();
        $satuan_stok = $this->db->get_where('master_satuan',array('kode'=>$param['id_pembelian']));
        $hasil_satuan_stok = $satuan_stok->row();
        $dft_satuan = $this->db->get_where('master_satuan');
        $hasil_dft_satuan = $dft_satuan->result();
        #$desa = $desa->result();
        $list = '';
        foreach($hasil_dft_satuan as $daftar){
          $list .= 
          "
          <option value='$daftar->kode'>$daftar->nama</option>
          ";
      }
      $opt = "<option selected='true' value=''>Pilih Satuan Stok</option>";
      echo $opt.$list;
  }

  public function get_rak()
  {
    $kode_unit = $this->input->post('kode_unit');
    $opt = "<option selected='true' value=''>--Pilih Rak--</option>";
    $data = $this->db->get_where('master_rak',array('kode_unit' => $kode_unit));
    foreach ($data->result() as $key => $value) {
        $opt .= "<option value=".$value->kode_rak.">".$value->nama_rak."</option>";
    }
    echo $opt;
}

public function get_kode()
{
    $kode_bahan_baku = $this->input->post('kode_bahan_baku');
    $query = $this->db->get_where('master_bahan_baku',array('kode_bahan_baku' => $kode_bahan_baku))->num_rows();

    if($query > 0){
        echo "1";
    }
    else{
        echo "0";
    }
}
public function get_kode_sub()
{
    $kode_header = $this->input->post('kode_header');
    $query = $this->db->get_where('master_bahan_baku',array('kode_bahan_baku' => $kode_bahan_baku))->num_rows();

    if($query > 0){
        echo "1";
    }
    else{
        echo "0";
    }
}

}
