<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: str_shuffle ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: sql_quotes
- Sink: sqlsrv_query_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. No enclosure and special chars are allowed -> SQL injection
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
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = str_shuffle($tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$result = sqlsrv_query($db, $context);
while(($row = sqlsrv_fetch_object($result)))
{
  echo(htmlentities(print_r($row, true)));
}

?>