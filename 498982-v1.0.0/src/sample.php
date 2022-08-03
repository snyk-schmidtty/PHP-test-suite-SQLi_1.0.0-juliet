<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_UNSAFE_RAW) ==> Filters:[]
- Sanitization: preg_match_prm__<s>(_^[A-Za-z]*$_) ==> Filters:[nums, specials]
- Filters complete: Filters:[nums, specials]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: vprintf_prm__<s>(This%d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_UNSAFE_RAW);
if(preg_match("/^[A-Za-z]*$/", $tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("<a href=\"" . $dataflow) . "\">link</a>");
  vprintf("This%d", $context);
}

?>