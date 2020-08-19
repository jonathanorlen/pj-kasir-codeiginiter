<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu_resto extends MY_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
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

    //public function index()
    //{
    //  $data['konten'] = $this->load->view('bahan_jadi/daftar_bahan_baku_jadi', NULL, TRUE);
    //  $this->load->view ('main', $data);  
        
    //} 

    //------------------------------------------ View Data Table----------------- --------------------//
    
  //  public function index()
//{
//        $data['aktif']='master';
//$data['konten'] = $this->load->view('bahan_baku/daftar_bahan_baku', NULL, TRUE);
//$data['halaman'] = $this->load->view('bahan_baku/menu', $data, TRUE);
//$this->load->view('bahan_baku/main', $data);	
//
//}
    
    public function menu()
    {
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('master/menu', NULL, TRUE);
        $this->load->view ('main', $data);      
    }

    public function rak()
    {
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('rak/daftar_rak', NULL, TRUE);
        $data['halaman'] = $this->load->view('rak/menu', $data, TRUE);
        $this->load->view('rak/main', $data);       
    }

    public function daftar_menu()
    {

        /*$data['konten'] = $this->load->view('setting/daftar', NULL, TRUE);
        $this->load->view ('main', $data);*/

        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('menu_resto/daftar_menu', NULL, TRUE);
        $data['halaman'] = $this->load->view('menu_resto/menu', $data, TRUE);
        $this->load->view('menu_resto/main', $data);       
    }

    

    public function detail()
    {
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('menu_resto/detail_menu', NULL, TRUE);
        $data['halaman'] = $this->load->view('menu_resto/menu', $data, TRUE);
        $this->load->view('menu_resto/main', $data);
        
            
    }  

    //------------------------------------------ View Input----------------- --------------------//
    
    public function tambah()
    {
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('menu_resto/tambah_menu', NULL, TRUE);
        $data['halaman'] = $this->load->view('menu_resto/menu', $data, TRUE);
        $this->load->view('menu_resto/main', $data);  
    } 

    //------------------------------------------ Proses Simpan----------------- --------------------//
   

    public function simpan_tambah_menu() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_produk', 'temp', 'required');
        $this->form_validation->set_rules('nama_produk', 'temp', 'required');
        $this->form_validation->set_rules('harga_jual', 'temp', 'required');
        $this->form_validation->set_rules('kode_satuan_stok', 'temp', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-warning">Gagal tersimpan.</div>';            
        } else {
            $simpan_menu = $this->input->post();
            
            $nama_satuan_stok = $this->db->get_where('master_satuan',array('kode'=>$simpan_menu['kode_satuan_stok']));
            $hasil_nama = $nama_satuan_stok->row();
            $simpan_menu['satuan_stok'] = $hasil_nama->nama;
            $simpan_menu['status'] = '1';
            $this->db->insert('master_produk',$simpan_menu);
            echo '<div class="alert alert-success">Sudah tersimpan.</div>';    
        }    
    }
    
    //------------------------------------------ Proses Update----------------- --------------------//
    

    

    public function simpan_edit_menu() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_produk', 'temp', 'required');
        $this->form_validation->set_rules('nama_produk', 'temp', 'required');
        $this->form_validation->set_rules('harga_jual', 'temp', 'required');
        $this->form_validation->set_rules('kode_satuan_stok', 'temp', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-warning">Gagal tersimpan.</div>';            
        } else {
            $simpan_menu = $this->input->post();
            
            $nama_satuan_stok = $this->db->get_where('master_satuan',array('kode'=>$simpan_menu['kode_satuan_stok']));
            $hasil_nama = $nama_satuan_stok->row();
            $simpan_menu['satuan_stok'] = $hasil_nama->nama;
            $simpan_menu['status'] = '1';
            $this->db->update('master_produk',$simpan_menu,array('kode_produk'=>$simpan_menu['kode_produk']));
            echo '<div class="alert alert-success">Sudah tersimpan.</div>';     
        }    
    }

    public function get_kode()
    {
        $kode_menu = $this->input->post('kode_menu');
        $query = $this->db->get_where('master_menu',array('kode_menu' => $kode_menu))->num_rows();

        if($query > 0){
            echo "1";
        }
        else{
            echo "0";
        }
    }

    //------------------------------------------ Proses Delete----------------- --------------------//
    

    public function hapus_produk(){
        $id = $this->input->post('id');
        //$this->db->delete('master_bahan_jadi',array('id'=>$id));

        $delete = $this->db->delete('master_produk',array('kode_produk' => $id));
        
    }

   

  

}
