<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: htmlspecialchars_prm__<c>(ENT_NOQUOTES) ==> Filters:[Filtered(&, <, >)]
- Filters complete: Filters:[Filtered(&, <, >)]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: mysqli_real_query_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape the apostrophe with '
2. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$servername = "mysql";
$username = "username";
$password = "password";
$dbName = "myDB";
$db = new mysqli($servername, $username, $password, $dbName);


# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = htmlspecialchars($tainted, ENT_NOQUOTES);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
mysqli_real_query($db, $context);
$results = $db->use_result();
while(($row = $results->fetch_row()))
{
  echo(htmlentities(print_r($row, true)));
}

?>