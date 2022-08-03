<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: base64_encode ==> Filters:[nums, letters, specials]
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
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = base64_encode($tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
exit($context);

?>