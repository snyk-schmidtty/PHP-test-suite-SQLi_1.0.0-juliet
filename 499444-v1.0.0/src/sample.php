<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: strtr_prm__<s>(')_<s>(\w) ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(')]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: db2_prepare_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$dsn = "DATABASE=myDB;HOSTNAME=ibm_db2;PORT=50000;PROTOCOL=TCPIP;UID=db2inst1;PWD=ibm_db2_pw;";
$db = db2_connect($dsn, "", "");


# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = strtr($tainted, "'", " ");
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
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