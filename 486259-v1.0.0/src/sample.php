<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: str_ireplace_prm__<s>(')_<s>() ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(')]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: echo_func

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
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = str_ireplace("'", "", $tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
echo($context);

?>