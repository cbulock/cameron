<?php
namespace cbulock\me\beer;
class Data {

	protected $db;

	public function __construct() {
		$this->db = new DB;
	}

	public function recent() {
		$sql = "
			SELECT DISTINCT
			brewery_name, beer_name, beer_url, rating_score
			FROM beerdata
			ORDER BY created_at DESC
			LIMIT 10
		";
		$result = $this->db->query($sql);

		return $this->db->fetchAll($result);
	}

	public function most_checked_in() {
		$sql = "
			SELECT
			brewery_name, beer_name, beer_url, rating_score, COUNT(beer_url) AS count
			FROM beerdata
			GROUP BY beer_url
			ORDER BY count DESC
			LIMIT 20
		";
		$result = $this->db->query($sql);

		return $this->db->fetchAll($result);
	}

	public function fav_styles() {
		$sql = "
			SELECT
			beer_type, COUNT(beer_type) AS count
			FROM beerdata
			GROUP BY beer_type
			ORDER BY count DESC
			LIMIT 10
		";
		$result = $this->db->query($sql);

		return $this->db->fetchAll($result);
	}

	public function all_styles() {
		$sql = "
			SELECT
			beer_type, COUNT(beer_type) AS count
			FROM beerdata
			GROUP BY beer_type
			ORDER BY count DESC
		";
		$result = $this->db->query($sql);

		return $this->db->fetchAll($result);
	}

	public function recent_fav_styles() {
		$sql = "
			SELECT
			beer_type, COUNT(beer_type) AS count
			FROM beerdata
			WHERE date(created_at)
			BETWEEN date('now', '-2 months') AND date('now')
			GROUP BY beer_type
			ORDER BY count DESC
			LIMIT 10;
		";
		$result = $this->db->query($sql);

		return $this->db->fetchAll($result);
	}
}
