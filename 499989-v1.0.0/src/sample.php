<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: preg_match_all_prm__<s>(_^[A-Za-z0-9]*$_) ==> Filters:[specials]
- Filters complete: Filters:[specials]
- Dataflow: assignment
- Context: xss_quotes
- Sink: print_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
if(preg_match_all("/^[A-Za-z0-9]*$/", $tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("Hello to \"" . $dataflow) . "\"");
  print($context);
}

?>