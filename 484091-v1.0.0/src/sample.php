<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_ADD_SLASHES))) ==> Filters:[Escape[\](", ', \)]
- Sanitization: htmlentities_prm__<c>(ENT_QUOTES) ==> Filters:[Filtered(", &, ', <, >)]
- Filters complete: Filters:[Filtered(", &, ', <, >), Escape[\](", ', \)]
- Dataflow: assignment
- Context: sql_plain
- Sink: db2_prepare_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$dsn = "DATABASE=myDB;HOSTNAME=ibm_db2;PORT=50000;PROTOCOL=TCPIP;UID=db2inst1;PWD=ibm_db2_pw;";
$db = db2_connect($dsn, "", "");


# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_ADD_SLASHES]);
$tainted = $tainted["t"];
$sanitized = htmlentities($tainted, ENT_QUOTES);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
$stmt = db2_prepare($db, $context);
if($stmt == false)
{
  die(db2_stmt_errormsg());
}
$result = db2_execute($stmt, []);
while(($row = db2_fetch_array($stmt)))
{
  echo(htmlentities(print_r($row, true)));
}

?>