<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: strtr_prm__<s>(')_<s>(\w) ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(')]
- Dataflow: assignment
- Context: xss_quotes
- Sink: echo_func

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
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = strtr($tainted, "'", " ");
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
echo($context);

?>