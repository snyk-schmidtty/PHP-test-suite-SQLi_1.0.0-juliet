<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: str_replace_prm__<s>(')_<s>() ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(')]
- Dataflow: assignment
- Context: sql_quotes
- Sink: pdo_prepare_prm__<$>(pdo)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = str_replace("'", "", $tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$stmt = $pdo->prepare($context);
$results = $stmt->execute([]);
foreach ($stmt->fetchAll() as $row){
  echo(htmlentities(print_r($row, true)));
}

?>