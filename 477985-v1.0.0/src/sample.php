<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_NUMBER_FLOAT) ==> Filters:[letters, specials]
- Sanitization: addslashes ==> Filters:[Escape[\](", ', \)]
- Filters complete: Filters:[letters, specials, Escape[\](", ', \)]
- Dataflow: assignment
- Context: sql_quotes
- Sink: mysqli_prepare_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$servername = "mysql";
$username = "username";
$password = "password";
$dbName = "myDB";
$db = new mysqli($servername, $username, $password, $dbName);


# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_NUMBER_FLOAT);
$sanitized = addslashes($tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$stmt = mysqli_prepare($db, $context);
mysqli_stmt_execute($stmt);
$results = mysqli_stmt_get_result($stmt);
while(($row = $results->fetch_row()))
{
  echo(htmlentities(print_r($row, true)));
}

?>