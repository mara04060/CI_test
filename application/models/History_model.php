<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	public function getHistory() {
		$query = $this->db->query("SELECT name, valCurrency FROM `rates` order by id DESC");
		return $query->result_array();
	}

}