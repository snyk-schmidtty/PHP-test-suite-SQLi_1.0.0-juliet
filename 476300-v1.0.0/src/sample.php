<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: filter_var_prm__<c>(FILTER_SANITIZE_SPECIAL_CHARS) ==> Filters:[Filtered(", &, ', <, >)]
- Filters complete: Filters:[Filtered(", &, ', <, >)]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: echo_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = filter_var($tainted, FILTER_SANITIZE_SPECIAL_CHARS);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
echo($context);

?>