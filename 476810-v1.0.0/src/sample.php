<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_NUMBER_FLOAT))) ==> Filters:[letters, specials]
- Sanitization: sscanf_prm__<s>(foo %s) ==> Filters:[]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_NUMBER_FLOAT]);
$tainted = $tainted["t"];
$sanitized = sscanf($tainted, "foo %s");
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
trigger_error($context, E_USER_ERROR);

?>