<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: crypt ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: exit

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = crypt($tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
exit($context);

?>