<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: json_encode_prm__<c>(ENT_NOQUOTES) ==> Filters:[Filtered(&), Escape[\](", \)]
- Filters complete: Filters:[Filtered(&), Escape[\](", \)]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: print_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. It is possible to create a javascript context with: javascript:alert(1)
-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$sanitized = json_encode($tainted, ENT_NOQUOTES);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
print($context);

?>