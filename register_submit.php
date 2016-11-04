<pre>
<?php

$path = getenv("DOCUMENT_ROOT") . DIRECTORY_SEPARATOR . "..";
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include "sql_credentials.php";

$host = 'localhost';
$db   = 'robotdes_jsdcweb';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $sql_username, $sql_password, $opt);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

// ==========

$agreed = ($_POST['RulesAccept'] == 'on') &&
          ($_POST['ModifyAccept'] == 'on') &&
          ($_POST['PhotoAccept'] == 'on') &&
          ($_POST['CheckAccept'] == 'on');

// ==========

$pdo->beginTransaction();

$sql = 'INSERT INTO RegistrationTeams (Name, Abbr, School, Email, Agreed) VALUE (?, ?, ?, ?, ?)'; 
$pdo->prepare($sql)->execute([$_POST['TeamName'], $_POST['TeamAbbr'], $_POST['TeamSchool'],
                             $_POST['TeamEmail'], $agreed]);

$sql = 'SET @TeamId = LAST_INSERT_ID()';
$pdo->prepare($sql)->execute();

$sql = 'INSERT INTO RegistrationMembers (Name, TeamId, Type, ShirtSize) VALUE (?, @TeamId, ?, ?)';
$statement = $pdo->prepare($sql);

foreach(range(1, 6) as $i) {
	if(isset($_POST["Member${i}Name"])) {
		$statement->execute([$_POST["Member${i}Name"], $i == 1 ? 'Captain' : 'Member',
			             $_POST["Member${i}Size"]]);
	}
}


if(isset($_POST['SponsorName'])) {
	$statement->execute([$_POST["SponsorName"], 'Sponsor', $_POST['SponsorSize']]);
}
$pdo->commit();


?>
</pre>
