<?php
namespace cbulock\me\brewerymap;

class DB extends \SQLite3 {

	public function __construct() {
		$db_file = "/home/cameron/public_html/breweries.db";
		$this->open( $db_file );
	}

	public function fetchAll( $result ) {
		$data = [];
		while($row=$result->fetchArray(SQLITE3_ASSOC)){
			$data[] = $row;
		}
		return $data;
	}
}
