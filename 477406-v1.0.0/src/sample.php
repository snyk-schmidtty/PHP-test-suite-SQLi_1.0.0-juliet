<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: bindec ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_html_param_a
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
$sanitized = bindec($tainted);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
exit($context);

?>