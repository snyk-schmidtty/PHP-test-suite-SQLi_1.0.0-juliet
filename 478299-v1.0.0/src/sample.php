<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: ctype_alnum ==> Filters:[specials]
- Filters complete: Filters:[specials]
- Dataflow: assignment
- Context: sql_quotes
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
$tainted = $_COOKIE;
$tainted = $tainted["t"];
if(ctype_alnum($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
  $result = sqlsrv_query($db, $context);
  while(($row = sqlsrv_fetch_object($result)))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>