<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: filter_var_prm__<c>(FILTER_UNSAFE_RAW) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: pdo_prepare_prm__<$>(pdo)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape the apostrophe with '
2. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = filter_var($tainted, FILTER_UNSAFE_RAW);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
$stmt = $pdo->prepare($context);
$results = $stmt->execute([]);
foreach ($stmt->fetchAll() as $row){
  echo(htmlentities(print_r($row, true)));
}

?>