<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: in_array_prm__<$>(legal)_<true>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: mssql_sqlsrv_prepare_prm__<$>(db)

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

$legal = ["safe1", "safe2"];


# Sample
$tainted = apache_request_headers();
$tainted = $tainted["t"];
if(in_array($tainted, $legal, true))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
  $stmt = sqlsrv_prepare($db, $context);
  $result = sqlsrv_execute($stmt);
  while(($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>