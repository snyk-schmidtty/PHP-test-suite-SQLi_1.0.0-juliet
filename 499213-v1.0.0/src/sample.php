<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: filter_var_prm__<c>(FILTER_SANITIZE_NUMBER_FLOAT) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_quotes
- Sink: echo_func

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
$sanitized = filter_var($tainted, FILTER_SANITIZE_NUMBER_FLOAT);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
echo($context);

?>