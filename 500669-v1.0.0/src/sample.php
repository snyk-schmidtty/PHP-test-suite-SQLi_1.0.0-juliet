<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: htmlentities_1 ==> Filters:[Filtered(", &, <, >)]
- Filters complete: Filters:[Filtered(", &, <, >)]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: vprintf_prm__<s>(This%d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

1. Escape the apostrophe with '
-->
<?php
# Init

# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = htmlentities($tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
vprintf("This%d", $context);

?>