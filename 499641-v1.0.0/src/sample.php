<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: crypt ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_quotes
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
$sanitized = crypt($tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
user_error($context);

?>