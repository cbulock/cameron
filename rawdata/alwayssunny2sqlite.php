<?php

$csv_file = "alwayssunny.csv";
$db_file = "../alwayssunnydata.db";

$db = new SQLite3($db_file);

$data = array_map('str_getcsv', file($csv_file));
array_walk($data, function(&$a) use ($data) {
	$a = array_combine($data[0], $a);
});
array_shift($data);

$resetsql = "DROP TABLE episodes";
$createsql = 
"CREATE TABLE episodes(
	Season INTEGER,
	Episode INTEGER,
	Title TEXT,
	IMDB TEXT,
	IMDB2 TEXT,
	Ranking INTEGER
)";

$db->query($resetsql);
$db->query($createsql);

foreach($data as $episode) {
	$colcount = count($episode);
	$columns = implode(',', array_keys($episode));
	$values = implode(',', array_fill(0, $colcount, '?'));

	$insertsql = "INSERT INTO episodes ($columns) VALUES ($values);";

	$stmt = $db->prepare($insertsql);
	$counter = 1;
	foreach ($episode as $col => $val) {
		$stmt->bindValue($counter, $val);
		$counter++;
	}
	$stmt->execute();

}