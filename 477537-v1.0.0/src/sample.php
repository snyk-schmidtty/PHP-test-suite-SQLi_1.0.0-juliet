<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_SPECIAL_CHARS))) ==> Filters:[Filtered(", &, ', <, >)]
- Sanitization: sscanf_prm__<s>(foo %d) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials, Filtered(", &, ', <, >)]
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
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_SPECIAL_CHARS]);
$tainted = $tainted["t"];
$sanitized = sscanf($tainted, "foo %d");
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
$results = $db->query($context);
while(($row = $results->fetchArray()))
{
  echo(htmlentities(print_r($row, true)));
}

?>