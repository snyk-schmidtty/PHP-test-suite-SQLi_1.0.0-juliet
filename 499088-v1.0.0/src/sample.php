<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: str_word_count_prm__<i>(0) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_html_param
- Sink: exit

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
$sanitized = str_word_count($tainted, 0);
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
exit($context);

?>