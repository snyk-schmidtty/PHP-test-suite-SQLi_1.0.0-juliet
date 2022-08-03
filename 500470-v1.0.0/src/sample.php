<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: gettype_check_prm__<s>(boolean) ==> Filters:[nums, letters, specials]
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
$tainted = $_GET;
$tainted = $tainted["t"];
if(gettype($tainted) == "boolean")
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
  $results = $db->query($context);
  while(($row = $results->fetchArray()))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>