<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_FULL_SPECIAL_CHARS) ==> Filters:[Filtered(", &, ', <, >)]
- Sanitization: htmlspecialchars_prm__<c>(ENT_QUOTES) ==> Filters:[Filtered(", &, ', <, >)]
- Filters complete: Filters:[Filtered(", &, ', <, >)]
- Dataflow: assignment
- Context: sql_plain
- Sink: pdo_query_prm__<$>(pdo)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$sanitized = htmlspecialchars($tainted, ENT_QUOTES);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
$results = $pdo->query($context);
foreach ($results as $row){
  echo(htmlentities(print_r($row, true)));
}

?>