<?php
namespace cbulock\me\alwayssunny;
class Data {

	protected $db;

	public function __construct() {
		$this->db = new DB;
	}

	public function all() {
		$sql = "
			SELECT *
			FROM episodes
			ORDER BY ranking ASC
		";
		$result = $this->db->query($sql);

		return $this->db->fetchAll($result);
	}

}
