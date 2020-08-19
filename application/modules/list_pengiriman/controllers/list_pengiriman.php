<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class list_pengiriman extends MY_Controller {

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
        $data['konten'] = $this->load->view('list_pengiriman/list/daftar_pengiriman', NULL, TRUE);
        $data['halaman'] = $this->load->view('list/menu', $data, TRUE);
        $this->load->view('list/main', $data);	

    }

    public function menu()
    {
        $data['aktif']='master';
        $data['konten'] = $this->load->view('master/menu', NULL, TRUE);
        $data['halaman'] = $this->load->view('list/menu', $data, TRUE);
        $this->load->view('list/main', $data);		
    }

  
    public function detail()
    {
        $data['aktif']='master';
        $data['konten'] = $this->load->view('list/detail_pengriman', NULL, TRUE);
        $data['halaman'] = $this->load->view('list/menu', $data, TRUE);
        $this->load->view('list/main', $data);		
    }

    public function cari_pengiriman()
    {
        $this->load->view('list/cari_pengiriman');
    }
    
    

}
