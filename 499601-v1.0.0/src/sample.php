<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_NUMBER_INT) ==> Filters:[letters, specials]
- Sanitization: is_integer ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: print_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_NUMBER_INT);
if(is_integer($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("<a href=\"" . $dataflow) . "\">link</a>");
  print($context);
}

?>