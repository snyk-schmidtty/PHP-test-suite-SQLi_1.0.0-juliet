<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: zlib_encode_prm__<c>(ZLIB_ENCODING_DEFLATE) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: sql_quotes
- Sink: pdo_prepare_prm__<$>(pdo)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = zlib_encode($tainted, ZLIB_ENCODING_DEFLATE);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$stmt = $pdo->prepare($context);
$results = $stmt->execute([]);
foreach ($stmt->fetchAll() as $row){
  echo(htmlentities(print_r($row, true)));
}

?>