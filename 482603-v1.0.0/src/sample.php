<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_FULL_SPECIAL_CHARS))) ==> Filters:[Filtered(", &, ', <, >)]
- Sanitization: addcslashes_prm__<s>(;:'") ==> Filters:[][Note: Escapes characters with \ but can be bypassed because \ is not escaped. E.g. \" to bypass the escaping of ".]
- Filters complete: Filters:[Filtered(", &, ', <, >)]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. It is possible to create a javascript context with: javascript:alert(1)
-->
<?php
# Init

# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_FULL_SPECIAL_CHARS]);
$tainted = $tainted["t"];
$sanitized = addcslashes($tainted, ";:'\"");
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
trigger_error($context, E_USER_ERROR);

?>