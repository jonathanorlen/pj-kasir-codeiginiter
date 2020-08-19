<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

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
        $data['konten'] = $this->load->view('member/daftar_member', NULL, TRUE);
        $data['halaman'] = $this->load->view('member/menu', $data, TRUE);
        $this->load->view('member/main', $data);
	}	

    //------------------------------------------ View Data Table----------------- --------------------//

    public function menu()
    {
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('master/menu', NULL, TRUE);
        $this->load->view ('main', $data);      
    }

	public function member()
	{
        $data['aktif'] = 'master';
		$data['konten'] = $this->load->view('member/daftar_member', NULL, TRUE);
		$this->load->view ('main', $data);	
	}

	public function tambah()
	{
	    $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('member/tambah_member', NULL, TRUE);
        $data['halaman'] = $this->load->view('member/menu', $data, TRUE);
        $this->load->view('member/main', $data);
       	
	}

    public function detail()
    {
        $data['aktif'] = 'master';
        $data['konten'] = $this->load->view('member/detail_member', NULL, TRUE);
        $data['halaman'] = $this->load->view('member/menu', $data, TRUE);
        $this->load->view('member/main', $data);
        
    }
    
    public function get_kode()
    {
        $kode_member = $this->input->post('kode_member');
        $query = $this->db->get_where('master_member',array('kode_member' => $kode_member))->num_rows();

        if($query > 0){
            echo "1";
        }
        else{
            echo "0";
        }
    }

    	//------------------------------------------ Proses Simpan----------------- --------------------//
   	

    public function simpan_tambah_member()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_member', 'kode member', 'required');
        $this->form_validation->set_rules('nama_member', 'nama member', 'required'); 
        $this->form_validation->set_rules('alamat_member', 'alamat member', 'required');
        $this->form_validation->set_rules('status_member', 'status member', 'required'); 

        //jika form validasi berjalan salah maka tampilkan GAGAL
        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        } 
        //jika form validasi berjalan benar maka inputkan data
        else {
            $data = $this->input->post(NULL, TRUE);

            $this->db->insert("master_member", $data);
            echo 'sukses';            
        }
    }

    
    //------------------------------------------ Proses Update----------------- --------------------//
    
    public function simpan_edit_member()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_member', 'kode member', 'required');
        $this->form_validation->set_rules('nama_member', 'nama member', 'required'); 
        $this->form_validation->set_rules('alamat_member', 'alamat member', 'required');
        $this->form_validation->set_rules('status_member', 'status member', 'required'); 
        
        //jika form validasi berjalan salah maka tampilkan GAGAL
        if ($this->form_validation->run() == FALSE) {
            echo warn_msg(validation_errors());
        } 
        //jika form validasi berjalan benar maka inputkan data
        else {
            $data = $this->input->post(NULL, TRUE);

            $this->db->update("master_member", $data, array('id'=>$data['id']));
            echo 'sukses';            
        }
    }

   
    //------------------------------------------ Proses Delete----------------- --------------------//
    public function hapus(){
        $id = $this->input->post('id');
        $this->db->delete('master_member',array('id'=>$id));
    }

	
}
