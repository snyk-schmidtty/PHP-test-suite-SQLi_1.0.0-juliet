<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_NUMBER_INT))) ==> Filters:[letters, specials]
- Sanitization: is_int ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: mysqli_multi_query_method_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$servername = "mysql";
$username = "username";
$password = "password";
$dbName = "myDB";
$db = new mysqli($servername, $username, $password, $dbName);


# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_NUMBER_INT]);
$tainted = $tainted["t"];
if(is_int($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
  $db->multi_query($context);
  $results = $db->use_result();
  while(($row = $results->fetch_row()))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>