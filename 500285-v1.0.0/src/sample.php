<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_SPECIAL_CHARS) ==> Filters:[Filtered(", &, ', <, >)]
- Sanitization: str_ireplace_prm__<s>(')_<s>() ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(", &, ', <, >)]
- Dataflow: assignment
- Context: sql_quotes
- Sink: pdo_query_prm__<$>(pdo)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_SPECIAL_CHARS);
$sanitized = str_ireplace("'", "", $tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$results = $pdo->query($context);
foreach ($results as $row){
  echo(htmlentities(print_r($row, true)));
}

?>