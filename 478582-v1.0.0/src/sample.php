<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_UNSAFE_RAW))) ==> Filters:[]
- Sanitization: md5_prm__<false>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: user_error_prm_

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
$sanitized = md5($tainted, false);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
user_error($context);

?>