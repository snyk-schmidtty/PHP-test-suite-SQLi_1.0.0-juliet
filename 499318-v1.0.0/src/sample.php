<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: htmlentities_prm__<c>(ENT_NOQUOTES) ==> Filters:[Filtered(&, <, >)]
- Filters complete: Filters:[Filtered(&, <, >)]
- Dataflow: assignment
- Context: xss_quotes
- Sink: print_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

1. Escape quotes with "
-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = htmlentities($tainted, ENT_NOQUOTES);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
print($context);

?>