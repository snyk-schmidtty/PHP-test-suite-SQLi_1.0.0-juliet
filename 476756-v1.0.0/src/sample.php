<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: gzcompress_prm_ ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: vprintf_prm__<s>(This%d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = gzcompress($tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
vprintf("This%d", $context);

?>