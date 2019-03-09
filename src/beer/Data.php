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
		$most_recent_checkin_sql = "
			SELECT
			created_at
			FROM beerdata
			ORDER BY created_at DESC
			LIMIT 1
		";

		$sql = "
			SELECT
			beer_type, COUNT(beer_type) AS count
			FROM beerdata
			WHERE date(created_at)
			BETWEEN date( (".$most_recent_checkin_sql."), '-2 months') AND date((".$most_recent_checkin_sql."))
			GROUP BY beer_type
			ORDER BY count DESC
			LIMIT 10;
		";
		$result = $this->db->query($sql);

		return $this->db->fetchAll($result);
	}

	public function getList($page = 1, $page_size = 10) {
		$sql = "
			SELECT
			COUNT(checkin_id) AS count
			FROM beerdata
		";
		$count_result = $this->db->query($sql);
		$total = $this->db->fetchAll($count_result)[0]['count'];
		$pages = ceil( $total / $page_size );
		$offset = ( $page - 1 ) * $page_size;

		$sql = "
			SELECT
			*
			FROM beerdata
			ORDER BY created_at DESC
			LIMIT $page_size
			OFFSET $offset
		";
		$result = $this->db->query($sql);

		$db_results = $this->db->fetchAll($result);

		return [
			'page'        => $page,
			'total_pages' => $pages,
			'page_size'   => $page_size,
			'total'       => $total,
			'results'     => $db_results
		];
	}

	public function get($id) {
		$sql = "
			SELECT
			*
			FROM beerdata
			WHERE checkin_id = $id
		";
		$result = $this->db->query($sql);

		return $this->db->fetchAll($result)[0];
	}
}
