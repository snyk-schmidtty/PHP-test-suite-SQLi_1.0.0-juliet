<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: zlib_encode_prm__<c>(ZLIB_ENCODING_DEFLATE) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: sql_plain
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


# Sample
$tainted = apache_request_headers();
$tainted = $tainted["t"];
$sanitized = zlib_encode($tainted, ZLIB_ENCODING_DEFLATE);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
$stmt = sqlsrv_prepare($db, $context);
$result = sqlsrv_execute($stmt);
while(($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)))
{
  echo(htmlentities(print_r($row, true)));
}

?>