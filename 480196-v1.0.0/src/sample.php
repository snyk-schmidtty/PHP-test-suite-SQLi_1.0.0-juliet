<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_ADD_SLASHES))) ==> Filters:[Escape[\](", ', \)]
- Sanitization: filter_var_prm__<c>(FILTER_UNSAFE_RAW) ==> Filters:[]
- Filters complete: Filters:[Escape[\](", ', \)]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: user_error_prm_

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. It is possible to create a javascript context with: javascript:alert(1)
-->
<?php
# Init

# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_ADD_SLASHES]);
$tainted = $tainted["t"];
$sanitized = filter_var($tainted, FILTER_UNSAFE_RAW);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
user_error($context);

?>