<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: doubleval ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_plain
- Sink: user_error_prm_

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
$sanitized = doubleval($tainted);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
user_error($context);

?>