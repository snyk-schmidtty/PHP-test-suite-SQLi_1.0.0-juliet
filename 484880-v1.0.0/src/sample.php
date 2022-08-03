<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: str_replace_prm__<s>(\w)_<s>() ==> Filters:[]
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
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = str_replace(" ", "", $tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
trigger_error($context, E_USER_ERROR);

?>