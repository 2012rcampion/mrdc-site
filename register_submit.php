---
layout: page
---
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

$agreed = ($_POST['RulesAccept'] == 'on') && ($_POST['ModifyAccept'] == 'on') && ($_POST['PhotoAccept'] == 'on') && ($_POST['CheckAccept'] == 'on');

$db_error = false;
$db_error_msg = 'There was a problem processing your submission.';

$sizes = ['S', 'M', 'L', 'XL', 'XXL'];

// ==========

try {

  $pdo->beginTransaction();
  
  if(is_null($_POST['TeamName']) || $_POST['TeamName'] == '') {
    $db_error_msg = 'A team name is required.';
    throw new Exception('');
  }
  
  if(is_null($_POST['TeamSchool']) || $_POST['TeamSchool'] == '') {
    $db_error_msg = 'A school name is required.';
    throw new Exception('');
  }
  
  if(!$agreed) {
    $db_error_msg = 'You must agree to all the terms and conditions.';
    throw new Exception('');
  }
  
  $sql = 'INSERT INTO RegistrationTeams (Name, Abbr, School, Agreed) VALUE (?, ?, ?, ?)'; 
  $pdo->prepare($sql)->execute([$_POST['TeamName'], $_POST['TeamAbbr'], $_POST['TeamSchool'], $agreed]);

  $sql = 'SET @TeamId = LAST_INSERT_ID()';
  $pdo->prepare($sql)->execute();

  $sql = 'INSERT INTO RegistrationMembers (Name, TeamId, Type, Email, Phone, ShirtSize) VALUE (?, @TeamId, ?, ?, ?, ?)';
  $statement = $pdo->prepare($sql);

  foreach(range(1, 6) as $i) {
    if(isset($_POST["Member${i}Name"]) && $_POST["Member${i}Name"] != '' ) {
      if(is_null($_POST["Member${i}Size"]) || !in_array($_POST["Member${i}Size"], $sizes)) {
        $db_error_msg = "A t-shirt size is missing for team member ${i}.";
        throw new Exception('');
      }
      
      if(is_null($_POST["Member${i}Email"]) || $_POST["Member${i}Email"] == '') {
        $db_error_msg = "An email address is missing for team member ${i}.";
        throw new Exception('');
      }
      
      if(is_null($_POST["Member${i}Phone"]) || $_POST["Member${i}Phone"] == '') {
        $db_error_msg = "A phone number is missing for team member ${i}.";
        throw new Exception('');
      }
      
      $statement->execute([$_POST["Member${i}Name"], $i == 1 ? 'Captain' : 'Member', $_POST["Member${i}Email"], $_POST["Member${i}Phone"], $_POST["Member${i}Size"]]);
    }
    else {
      if($i == 1) {
        $db_error_msg = 'A team captain is required.';
        throw new Exception('');
      }
    }
  }

  if(isset($_POST['SponsorName']) && $_POST['SponsorName'] != '' ) {
    if(is_null($_POST['SponsorSize']) || !in_array($_POST['SponsorSize'], $sizes)) {
      $db_error_msg = "A t-shirt size is missing for the team sponsor.";
      throw new Exception('');
    }
    
    if(is_null($_POST["SponsorEmail"]) || $_POST["SponsorEmail"] == '') {
      $db_error_msg = "An email address is missing for the team sponsor.";
      throw new Exception('');
    }
    
    if(is_null($_POST["SponsorPhone"]) || $_POST["SponsorPhone"] == '') {
      $db_error_msg = "A phone number is missing for the team sponsor.";
      throw new Exception('');
    }
    
    $statement->execute([$_POST['SponsorName'], 'Sponsor', $_POST['SponsorEmail'], $_POST['SponsorPhone'], $_POST['SponsorSize']]);
  }
  $pdo->commit();

}
catch(Exception $e) {
  file_put_contents('error.log', $e, FILE_APPEND);
  $pdo->rollBack();
  $db_problem = true;
}

if($db_problem) :
?>
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  <?php echo $db_error_msg ; ?>
</div>
<p>
Please press the back button and try again.  If the problem persists, please email the <a href="mailto:{{ site.email_comm }}">MRDC committee</a>.
</p>
<?php else: ?>
<p>
  Your submission was successfully processed.  Thank you for registering for this year's MRDC!  Please sign up for the <a href="{{ site.email_teams_signup }}">mailing list</a> if you have not done so already.
</p>
<?php endif; ?>

