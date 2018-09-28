<?php

$json_file = "beerdata.json";
$db_file = "beerdata.db";

$beerdata = json_decode( file_get_contents($json_file), 1 );
$db = new SQLite3($db_file);

$resetsql = "DROP TABLE beerdata";
$createsql = 
"CREATE TABLE beerdata(
	beer_name TEXT,
	brewery_name TEXT,
	beer_type TEXT,
	beer_abv NUMERIC,
	beer_ibu NUMERIC,
	comment TEXT,
	venue_name TEXT,
	venue_city TEXT,
	venue_state TEXT,
	venue_country TEXT,
	venue_lat REAL,
	venue_lng REAL,
	rating_score NUMERIC,
	created_at TEXT,
	checkin_url TEXT,
	beer_url TEXT,
	brewery_url TEXT,
	brewery_country TEXT,
	brewery_city TEXT,
	brewery_state TEXT,
	flavor_profiles TEXT,
	purchase_venue TEXT,
	serving_type TEXT,
	checkin_id INTEGER,
	bid INTEGER,
	brewery_id INTEGER,
	photo_url TEXT
)";

$db->query($resetsql);
$db->query($createsql);

foreach($beerdata as $checkin) {
	$colcount = count($checkin);
	$columns = implode(',', array_keys($checkin));
	$values = implode(',', array_fill(0, $colcount, '?'));

	$insertsql = "INSERT INTO beerdata ($columns) VALUES ($values);";

	$stmt = $db->prepare($insertsql);
	$counter = 1;
	foreach ($checkin as $col => $val) {
		$stmt->bindValue($counter, $val);
		$counter++;
	}
	$stmt->execute();
}