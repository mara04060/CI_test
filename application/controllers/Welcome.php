<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('welcome_model');
	}

	public function index()	{
		$data['title']="Start Page";
		
		/* */
		if(empty( $data['content'] = $this->welcome_model->getCache('currency') ))
		{
			$data['content']=$this->welcome_model->getCurrency(2);
			$this->welcome_model->setCache('currency', $data['content']);
		}

		if(empty( $data['json'] = $this->welcome_model->getCache('json') ))
		{
			$data['json'] = $this->welcome_model->getAPIcurrency();
			$this->welcome_model->setCache('json', $data['json']);
			//Каждое получение курсов вaлют записывть в БД?
			//Наверное имелось ввиду раз в сутки!!! ??? 
			$this->welcome_model->toCurrencyTable($data['json']);
			
		}
		
		$this->load->view('welcome_message',$data);
	}

	private function printCurrency(string $key="content"){
		if(empty( $data[$key] = $this->welcome_model->getCache('$key') ))
		{
			$data[$key]=$this->welcome_model->getCurrency();
			$this->welcome_model->setCache($key, $data[$key]);
		}
	}

}