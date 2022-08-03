<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: json_encode_prm__<c>(ENT_COMPAT) ==> Filters:[Filtered(&), Escape[\](", \)]
- Filters complete: Filters:[Filtered(&), Escape[\](", \)]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: user_error_prm_

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
$tainted = $_GET;
$sanitized = json_encode($tainted, ENT_COMPAT);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
user_error($context);

?>