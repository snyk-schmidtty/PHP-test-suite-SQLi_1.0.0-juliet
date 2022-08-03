<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: gzdeflate_prm__<i>(9) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: user_error_prm_

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = gzdeflate($tainted, 9);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
user_error($context);

?>