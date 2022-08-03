<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: htmlspecialchars_1 ==> Filters:[Filtered(", &, <, >)]
- Filters complete: Filters:[Filtered(", &, <, >)]
- Dataflow: assignment
- Context: xss_quotes
- Sink: vprintf_prm__<s>(This%s)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = htmlspecialchars($tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
vprintf("This%s", $context);

?>