<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: json_encode_prm__<c>(ENT_NOQUOTES) ==> Filters:[Filtered(&), Escape[\](", \)]
- Filters complete: Filters:[Filtered(&), Escape[\](", \)]
- Dataflow: assignment
- Context: sql_quotes
- Sink: sqlite3_query_prm__<$>(db)

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
$db = new SQLite3("/var/www/db/database.db");


# Sample
$tainted = apache_request_headers();
$sanitized = json_encode($tainted, ENT_NOQUOTES);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$results = $db->query($context);
while(($row = $results->fetchArray()))
{
  echo(htmlentities(print_r($row, true)));
}

?>