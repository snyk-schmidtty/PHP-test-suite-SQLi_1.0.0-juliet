<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: strpos_prm__<s>(needle) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: sqlsrv_query_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$info = ["Database" => "myDB", "UID" => "SA", "PWD" => "Msql12345678!"];
$db = sqlsrv_connect("mssql", $info);
if($db == false)
{
  die(print_r(sqlsrv_errors(), true));
}


# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = strpos($tainted, "needle");
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
$result = sqlsrv_query($db, $context);
while(($row = sqlsrv_fetch_object($result)))
{
  echo(htmlentities(print_r($row, true)));
}

?>