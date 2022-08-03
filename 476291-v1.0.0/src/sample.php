<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_ADD_SLASHES) ==> Filters:[Escape[\](", ', \)]
- Sanitization: ctype_alnum ==> Filters:[specials]
- Filters complete: Filters:[specials, Escape[\](", ', \)]
- Dataflow: assignment
- Context: xss_html_param
- Sink: vprintf_prm__<s>(This%d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_ADD_SLASHES);
if(ctype_alnum($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("<img src=\"" . $dataflow) . "\"/>");
  vprintf("This%d", $context);
}

?>