<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: intval ==> Filters:[letters, specials]
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
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = intval($tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
echo($context);

?>