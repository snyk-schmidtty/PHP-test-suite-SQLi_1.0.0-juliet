<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: json_encode_prm__<c>(JSON_PRETTY_PRINT)_<i>(512) ==> Filters:[Filtered(&), Escape[\](\)]
- Filters complete: Filters:[Filtered(&), Escape[\](\)]
- Dataflow: assignment
- Context: sql_quotes
- Sink: pdo_query_prm__<$>(pdo)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. Escape quotes with "
3. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = getallheaders();
$sanitized = json_encode($tainted, JSON_PRETTY_PRINT, 512);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$results = $pdo->query($context);
foreach ($results as $row){
  echo(htmlentities(print_r($row, true)));
}

?>