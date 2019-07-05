<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	public function getHistory() {
		$query = $this->db->query("SELECT name, nameBase, valCurrency, dateTim FROM `rates` order by `dateTim` DESC");
		return $query->result_array();
	}

}

