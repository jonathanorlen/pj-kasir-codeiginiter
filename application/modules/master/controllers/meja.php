<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class meja extends MY_Controller {

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
        $data['konten'] = $this->load->view('master/meja_ruang/daftar_meja', NULL, TRUE);
        $data['halaman'] = $this->load->view('master/meja_ruang/menu', $data, TRUE);
        $this->load->view('master/meja_ruang/main', $data);
       
        
		
	}	

	public function ruang()
	{
        $data['aktif']='master';
		$data['konten'] = $this->load->view('master/meja_ruang/daftar_meja', NULL, TRUE);
		$this->load->view ('main', $data);	
	}

	public function tambah()
	{   
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('master/meja_ruang/tambah_meja', NULL, TRUE);
        $data['halaman'] = $this->load->view('master/meja_ruang/menu', $data, TRUE);
        $this->load->view('master/meja_ruang/main', $data);
       
        
	}
    
    public function detail()
    {
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('master/meja_ruang/detail_meja', NULL, TRUE);
        $data['halaman'] = $this->load->view('master/meja_ruang/menu', $data, TRUE);
        $this->load->view('master/meja_ruang/main', $data);
        
        	
    }

    public function get_kode()
    {
        $no_meja = $this->input->post('no_meja');
        $query = $this->db->get_where('master_meja',array('no_meja' => $no_meja))->num_rows();

        if($query > 0){
            echo "1";
        }
        else{
            echo "0";
        }
    }


   	public function simpan()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('no_meja', 'Nomor Meja', 'required');
        $this->form_validation->set_rules('kode_ruang', 'Nama Ruangan', 'required');    

        //jika form validasi berjalan salah maka tampilkan GAGAL
        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        } 
        //jika form validasi berjalan benar maka inputkan data
        else {
            $data = $this->input->post(NULL, TRUE);
            $nama_ruang = $this->db->get_where('master_ruang',array('kode_ruang'=>$data['kode_ruang']));
            $hasil_nama_ruang = $nama_ruang->row();
            $data['nama_ruang'] = $hasil_nama_ruang->nama_ruang;
            $data['status'] = '0';
            $this->db->insert("master_meja", $data);
            echo 'sukses';            
        }
    }    

    public function simpan_edit_meja(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('no_meja', 'Nomor Meja', 'required');
        $this->form_validation->set_rules('kode_ruang', 'Nama Ruangan', 'required');    

        //jika form validasi berjalan salah maka tampilkan GAGAL
        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        } 
        //jika form validasi berjalan benar maka inputkan data
        else {
            $data = $this->input->post(NULL, TRUE);
            $nama_ruang = $this->db->get_where('master_ruang',array('kode_ruang'=>$data['kode_ruang']));
            $hasil_nama_ruang = $nama_ruang->row();
            $data['nama_ruang'] = $hasil_nama_ruang->nama_ruang;
            $this->db->update("master_meja", $data,array('id'=>$data['id']));
            echo 'sukses';            
        }
    }
    //------------------------------------------ Proses Delete----------------- --------------------//
    public function hapus(){
        $id = $this->input->post('id');
        $this->db->delete('master_meja',array('id'=>$id));
    }

	
}
