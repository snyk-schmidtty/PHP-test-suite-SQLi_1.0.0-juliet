<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: strpos_prm__<s>(needle) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: vprintf_prm__<s>(This%s)

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
$sanitized = strpos($tainted, "needle");
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
vprintf("This%s", $context);

?>