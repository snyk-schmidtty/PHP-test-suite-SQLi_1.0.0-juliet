<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_UNSAFE_RAW) ==> Filters:[]
- Sanitization: filter_var_prm__<c>(FILTER_SANITIZE_NUMBER_FLOAT) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_plain
- Sink: echo_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_UNSAFE_RAW);
$sanitized = filter_var($tainted, FILTER_SANITIZE_NUMBER_FLOAT);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
echo($context);

?>