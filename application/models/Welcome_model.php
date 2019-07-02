<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model{
	public function __construct(){
		$this->load->database();
		$this->load->driver('cache');
	}
	/* Function work in Memchache */
	public function getCache(string $name_cache = 'content')
	{
		return $this->cache->memcached->get($name_cache);
	}
	public function setCache(string $name_cache = 'content', $data_content )
	{
		$this->cache->memcached->save($name_cache, $data_content, 10); //10 min. = 600sec cach is life
	}
	
	/* Function work Database Currency */
	public function getCurrency(int $max_currency=1): ?array
	{
		$query = $this->db->query('SELECT name, valCurrency, dateTim FROM `rates` order by id DESC LIMIT '.$max_currency.'');
		return $query->result_array();		
	}

	public function setCurrency(array $newCurrency) {
		$this->db->query("INSERT INTO `rates` (name, valCurrency, dateTim) 
			VALUES (".$this->db->escape($newCurrency['name']).", ".$newCurrency['valCurrency']." , CURRENT_DATE() );");
		$this->db->affected_rows();
	}
	
	/*
	Get Currency PrivatBank API
	*/
	public function getAPIcurrency(): ?array
	{
		$url="https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5";
		$json=json_decode(file_get_contents($url), true);
		///[ccy] => USD [base_ccy] => UAH [buy] => 25.90000 [sale] => 26.25000
		return $json;		 
 	}
 	/*
	Set Currency PrivatBank API to database
	*/
 	public function toCurrencyTable($json)
 	{
 		foreach ($json as $key => $value) {
 			$data["name"]=$value["ccy"];
 			$data["valCurrency"]=$value["buy"];
 			$this->setCurrency($data);
 		}
 	}
		
}