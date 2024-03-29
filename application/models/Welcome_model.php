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
		$this->cache->memcached->save($name_cache, $data_content, 600); //10 min. = 600sec cach is life
	}
	
	/* Function work Database Currency */
	public function getCurrency(): ?array
	{
		if($query = $this->db->query('SELECT x.name, x.nameBase, x.valCurrency, x.dateTim FROM rates x INNER JOIN
			(SELECT name, max(dateTim) as dateTim FROM rates GROUP BY name ) y 
		ON (y.name = x.name) AND ( y.dateTim= x.dateTim) ORDER BY x.`name` DESC LIMIT 4'))
		{
			return $query->result_array();
		}else{
			return null;
		}
				
	}
	public function setCurrency(array $newCurrency) 
	{
		$query=$this->db->query("select valCurrency from rates where name=".$this->db->escape($newCurrency['name'])." AND nameBase=".$this->db->escape($newCurrency['nameBase'])." order by dateTim DESC LIMIT 1 ;");
		print "<p />select valCurrency from rates where name=".$this->db->escape($newCurrency['name'])." AND nameBase=".$this->db->escape($newCurrency['nameBase'])." order by dateTim DESC LIMIT 1 ;<p />";
		print "<br>".$query->row_array()['valCurrency']."";
		print " = ".(float)$newCurrency['valCurrency']."";

		if( (float)$query->row_array()['valCurrency'] != (float)$newCurrency['valCurrency'] )
		{
			if($this->db->query("INSERT IGNORE INTO `rates` (name, nameBase, valCurrency, dateTim) 
			VALUES (".$this->db->escape($newCurrency['name']).", ".$this->db->escape($newCurrency['nameBase']).", ".$newCurrency['valCurrency']." , CURRENT_TIME() );") )
			{
			$this->db->affected_rows();
			}
		}
	}
	
	/*
	Get Currency PrivatBank API
	*/
	public function getAPIcurrency(): ?array
	{
		$url="https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5";
		$json=@json_decode(file_get_contents($url), true);
		if(empty($json)){
			return NULL;
		}
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
 			$data["nameBase"]=$value["base_ccy"];
 			$data["valCurrency"]=$value["buy"];
 			$this->setCurrency($data);
 		}
 	}
public function getContentInJSON($json): ?array
	{
		$content=array();
		//if (isset($json)){ return NULL; }
		foreach ($json as $key => $value) {
 			$data["name"]=$value["ccy"];
 			$data["nameBase"]=$value["base_ccy"];
 			$data["valCurrency"]=$value["buy"];
 			$data['dateTim']=date("Y-m-d");
 			$content[]=$data;
 		}	
 		return $content;	 
 	}





}