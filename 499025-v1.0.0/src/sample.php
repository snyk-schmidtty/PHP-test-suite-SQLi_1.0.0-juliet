<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: base64_encode ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_plain
- Sink: exit

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
$sanitized = base64_encode($tainted);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
exit($context);

?>