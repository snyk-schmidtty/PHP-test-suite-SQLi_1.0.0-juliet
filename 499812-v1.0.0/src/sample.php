<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: htmlentities_1 ==> Filters:[Filtered(", &, <, >)]
- Filters complete: Filters:[Filtered(", &, <, >)]
- Dataflow: assignment
- Context: xss_plain
- Sink: printf_func_prm__<s>(Print this: %d)

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
$sanitized = htmlentities($tainted);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
printf("Print this: %d", $context);

?>