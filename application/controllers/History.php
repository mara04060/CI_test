<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/hystory
	 *	- or -
	 * 		http://example.com/index.php/history/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/history/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('history_model');
	}

	public function index()
	{
		$data['title']="History currency";
		$data['description']="Full history currency";
		
		$data['content']=$this->history_model->getHistory();
		if(!$data['content']){
			show_404();
		}
		
		$this->load->view('templates/index',$data);
	}
}
