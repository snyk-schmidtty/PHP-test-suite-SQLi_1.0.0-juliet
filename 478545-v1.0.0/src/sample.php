<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_NUMBER_FLOAT))) ==> Filters:[letters, specials]
- Sanitization: filter_var_prm__<c>(FILTER_SANITIZE_SPECIAL_CHARS) ==> Filters:[Filtered(", &, ', <, >)]
- Filters complete: Filters:[letters, specials, Filtered(", &, ', <, >)]
- Dataflow: assignment
- Context: xss_plain
- Sink: vprintf_prm__<s>(This%s)

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
$sanitized = filter_var($tainted, FILTER_SANITIZE_SPECIAL_CHARS);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
vprintf("This%s", $context);

?>