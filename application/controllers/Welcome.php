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
	 Примечние Автора:
	 Т.к. в задаче скзано :
	 При заходе на главную страницу как-то вывести текущий курс валют.
	 То выведем курс из полученного JSON зпроса (он-то уже получен)
	 просто выведем его в необходимом формате.
	 Хотя можно было-бы из БД, н всяк случай оставил строку Read in DataBase 
	 тогда не требуется обращаться к API каждый раз и дергать ПриватБанк
	 Можно было-бы добвить CRON который переодически дергал АПИ ПриватБанка
	 и данные курсов валют в БД былибы всегда актуальны. В этом случае просто убрать
	 с главной стрницы обрщение к АПИ.(но добавить обращение к БД откуда брть ПОСЛЕДНИЕ 
	 данные курсов валют).
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
			
			if( ($json=$this->welcome_model->getAPIcurrency() ) )				// Read in JSON
			{
				$data['content']=$this->welcome_model->getContentInJSON($json); // Read in JSON
			}					
			else{
				$data['content']=$this->welcome_model->getCurrency();        // Read in DataBase n- rows
			}
			$this->welcome_model->setCache('currency', $data['content']);
		}

		if(empty( $data['json'] = $this->welcome_model->getCache('json') ))
		{
			if($data['json'] = $this->welcome_model->getAPIcurrency())
			{
			$this->welcome_model->setCache('json', $data['json']);
			//Каждое получение курсов вaлют записывть в БД?
			//Наверное имелось ввиду раз в сутки!!! ??? 
			//Лучше наверное перед вставкой проверять на уникальность
			//...если это не сильно будет напрягать БД
			$this->welcome_model->toCurrencyTable($data['json']);
			}
			
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