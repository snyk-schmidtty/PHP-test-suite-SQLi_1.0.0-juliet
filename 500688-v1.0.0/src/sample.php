<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_UNSAFE_RAW))) ==> Filters:[]
- Sanitization: cast_prm__TYPE_LONG ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_plain
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_UNSAFE_RAW]);
$tainted = $tainted["t"];
$sanitized = (int)($tainted);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
trigger_error($context, E_USER_ERROR);

?>