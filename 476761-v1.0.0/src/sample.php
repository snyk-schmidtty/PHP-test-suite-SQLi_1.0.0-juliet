<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: substr_replace_prm__<s>(bob)_<i>(50) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>
2. Apostrophe are useless inside plain html context for XSS
-->
<?php
# Init

# Sample
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = substr_replace($tainted, "bob", 50);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
trigger_error($context, E_USER_ERROR);

?>