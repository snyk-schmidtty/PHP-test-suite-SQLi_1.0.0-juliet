<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_ADD_SLASHES) ==> Filters:[Escape[\](", ', \)]
- Sanitization: str_getcsv_prm_ ==> Filters:[Filtered(,)]
- Filters complete: Filters:[Filtered(,), Escape[\](", ', \)]
- Dataflow: assignment
- Context: xss_html_param
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. It is possible to create javascript parameters for: img attributes: onerror
-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_ADD_SLASHES);
$sanitized = str_getcsv($tainted);
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
trigger_error($context, E_USER_ERROR);

?>