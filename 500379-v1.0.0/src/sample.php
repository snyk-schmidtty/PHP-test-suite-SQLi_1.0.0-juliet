<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: in_array_prm__<$>(legal)_<true>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: sql_plain
- Sink: mysqli_real_query_method_prm__<$>(db)

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

$legal = ["safe1", "safe2"];


# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
if(in_array($tainted, $legal, true))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
  $db->real_query($context);
  $results = $db->use_result();
  while(($row = $results->fetch_row()))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>