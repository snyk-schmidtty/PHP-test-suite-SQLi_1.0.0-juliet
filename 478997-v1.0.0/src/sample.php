<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: parse_str ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: mysqli_multi_query_prm__<$>(db)

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
$tainted = getallheaders();
$tainted = $tainted["t"];
parse_str($tainted, $sanitized);
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
mysqli_multi_query($db, $context);
$results = $db->use_result();
while(($row = $results->fetch_row()))
{
  echo(htmlentities(print_r($row, true)));
}

?>