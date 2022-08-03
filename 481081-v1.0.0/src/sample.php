<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: substr_replace_prm__<s>(bob)_<i>(50) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_quotes
- Sink: exit

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>
2. Quotes are useless inside plain html context for XSS
-->
<?php
# Init

# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = substr_replace($tainted, "bob", 50);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
exit($context);

?>