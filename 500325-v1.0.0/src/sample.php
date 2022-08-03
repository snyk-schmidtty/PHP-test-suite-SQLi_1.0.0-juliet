<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_NUMBER_INT))) ==> Filters:[letters, specials]
- Sanitization: is_string ==> Filters:[]
- Filters complete: Filters:[letters, specials]
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
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_NUMBER_INT]);
$tainted = $tainted["t"];
if(is_string($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = ("Hello" . $dataflow);
  vprintf("This%s", $context);
}

?>