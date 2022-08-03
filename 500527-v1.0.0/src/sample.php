<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: substr_replace_prm__<s>(bob)_<i>(50) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: sql_quotes
- Sink: sqlite3_query_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$db = new SQLite3("/var/www/db/database.db");


# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = substr_replace($tainted, "bob", 50);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$results = $db->query($context);
while(($row = $results->fetchArray()))
{
  echo(htmlentities(print_r($row, true)));
}

?>