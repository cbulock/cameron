<?php
namespace cbulock\me\brewerymap;
class Data {

	protected $db;

	public function __construct() {
		$this->db = new DB;
	}

	public function all() {
		$sql = "
			SELECT *
			FROM breweries
		";
		$result = $this->db->query($sql);

		return $this->db->fetchAll($result);
	}
}
