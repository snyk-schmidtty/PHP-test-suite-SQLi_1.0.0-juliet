<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: gzencode_prm__<i>(9) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_html_param
- Sink: printf_func_prm__<s>(Print this: %d)

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
$sanitized = gzencode($tainted, 9);
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
printf("Print this: %d", $context);

?>