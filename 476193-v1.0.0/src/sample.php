<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: count_prm_ ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: vprintf_prm__<s>(This%s)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_GET;
$sanitized = count($tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
vprintf("This%s", $context);

?>