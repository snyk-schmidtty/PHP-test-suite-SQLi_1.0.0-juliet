<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: addcslashes_prm__<s>(;:'") ==> Filters:[][Note: Escapes characters with \ but can be bypassed because \ is not escaped. E.g. \" to bypass the escaping of ".]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: vprintf_prm__<s>(This%d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

1. Create script tag with <script>
2. Apostrophe are useless inside plain html context for XSS
-->
<?php
# Init

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = addcslashes($tainted, ";:'\"");
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
vprintf("This%d", $context);

?>