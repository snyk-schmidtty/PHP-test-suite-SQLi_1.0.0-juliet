<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: sha1_prm__<false>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_quotes
- Sink: exit

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = sha1($tainted, false);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
exit($context);

?>