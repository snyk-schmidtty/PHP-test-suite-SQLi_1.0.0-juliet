<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: strrpos_prm__<s>(needle) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_html_param
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
$sanitized = strrpos($tainted, "needle");
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
echo($context);

?>