<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class meja_ruang extends MY_Controller {

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

	public function index()
	{
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('master/meja_ruang/daftar_ruangan', NULL, TRUE);
        $data['halaman'] = $this->load->view('master/meja_ruang/menu', $data, TRUE);
        $this->load->view('master/meja_ruang/main', $data);
       
        
		
	}	

	public function ruang()
	{
        $data['aktif'] = 'master';
		$data['konten'] = $this->load->view('master/meja_ruang/daftar_ruangan', NULL, TRUE);
		$this->load->view ('main', $data);	
	}

	public function tambah()
	{
	   $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('master/meja_ruang/tambah_ruangan', NULL, TRUE);
        $data['halaman'] = $this->load->view('master/meja_ruang/menu', $data, TRUE);
        $this->load->view('master/meja_ruang/main', $data);
        
        	
	}
    
    public function detail()
    {
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('master/meja_ruang/detail_ruangan', NULL, TRUE);
        $data['halaman'] = $this->load->view('master/meja_ruang/menu', $data, TRUE);
        $this->load->view('master/meja_ruang/main', $data);
        
        	
    }

    public function get_kode()
    {
        $kode_ruang = $this->input->post('kode_ruang');
        $query = $this->db->get_where('master_ruang',array('kode_ruang' => $kode_ruang))->num_rows();

        if($query > 0){
            echo "1";
        }
        else{
            echo "0";
        }
    }

   	public function simpan_ruang()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_ruang', 'Kode Ruangan', 'required');
        $this->form_validation->set_rules('nama_ruang', 'Nama Ruangan', 'required');    

        //jika form validasi berjalan salah maka tampilkan GAGAL
        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        } 
        //jika form validasi berjalan benar maka inputkan data
        else {
            $data = $this->input->post(NULL, TRUE);

            $this->db->insert("master_ruang", $data);
            echo 'sukses';            
        }
    }    

    public function simpan_edit_ruang(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_ruang', 'Kode Ruangan', 'required');
        $this->form_validation->set_rules('nama_ruang', 'Nama Ruangan', 'required');    

        //jika form validasi berjalan salah maka tampilkan GAGAL
        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        } 
        //jika form validasi berjalan benar maka inputkan data
        else {
            $data = $this->input->post(NULL, TRUE);

            $this->db->update("master_ruang", $data,array('kode_ruang'=>$data['kode_ruang']));
            echo 'sukses';            
        }
    }
    //------------------------------------------ Proses Delete----------------- --------------------//
    public function hapus(){
        $kode = $this->input->post('kode_ruang');
        $this->db->delete('master_ruang',array('kode_ruang'=>$kode));
    }

	
}
