<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: bin2hex ==> Filters:[specials]
- Filters complete: Filters:[specials]
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
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = bin2hex($tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
user_error($context);

?>