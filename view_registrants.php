---
layout: page
---
<h1>Registered Teams</h1>
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

$sql = 'SELECT Id, Name, Abbr, School, Agreed, DATE_FORMAT(Submitted, \'%l:%i %p, %M %D, %Y\') as Submitted FROM RegistrationTeams'; 
$teams = $pdo->query($sql);

$sql = 'SELECT Name, Type, ShirtSize, Email, Phone FROM RegistrationMembers WHERE TeamId = ?'; 
$statement = $pdo->prepare($sql);

foreach($teams as $team):?>
  <h2><?= htmlspecialchars($team['Name']) ?>
    <small><?= htmlspecialchars($team['Abbr']) ?></small>
  </h2>
  <dl class="dl-horizontal">
    <dt>School</dt>
    <dd><?= htmlspecialchars($team['School']) ?></dd>
    <dt>Agreed</dt>
    <dd><?= $team['Agreed'] ? 'Yes' : 'No' ?></dd>
    <dt>Submitted</dt>
    <dd><?= $team['Submitted'] ?></dd>
  </dl>
  <ul>
  <?php
  $statement->execute([$team['Id']]);
  $members = $statement->fetchAll();
  foreach($members as $member): ?>
    <li>
      <?= htmlspecialchars($member['Name']) ?>
      <?php if($member['Type'] != 'Member'): ?>
        (<?= $member['Type'] ?>)
      <?php endif; ?>
      <dl class="dl-horizontal">
        <dt>Email</dt>
        <dd><?= htmlspecialchars($member['Email']) ?></dd>
        <dt>Phone</dt>
        <dd><?= htmlspecialchars($member['Phone']) ?></dd>
        <dt>Size</dt>
        <dd><?= $member['ShirtSize'] ?></dd>
      </dl>
    </li>
  <?php endforeach; ?>
  </ul>
<?php endforeach;?>
<h1>Shirt Sizes</h1>
<table class="table">
  <thead>
    <tr>
      <th>Size</th>
      <th>Count</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $sql = 'SELECT ShirtSize, COUNT(*) AS Count FROM RegistrationMembers as Members INNER JOIN RegistrationTeams AS Teams ON Members.TeamId = Teams.Id GROUP BY ShirtSize ORDER BY ShirtSize';
  $sizes = $pdo->query($sql);
  foreach($sizes as $size): ?>
    <tr>
      <th scope="row"><?= $size['ShirtSize'] ?></th>
      <td><?= $size['Count'] ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
