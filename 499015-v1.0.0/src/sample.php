<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: zlib_encode_prm__<c>(ZLIB_ENCODING_DEFLATE) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: sqlite3_query_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$db = new SQLite3("/var/www/db/database.db");


# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = zlib_encode($tainted, ZLIB_ENCODING_DEFLATE);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
$results = $db->query($context);
while(($row = $results->fetchArray()))
{
  echo(htmlentities(print_r($row, true)));
}

?>