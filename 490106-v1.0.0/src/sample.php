<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: preg_replace_prm__<s>(_'_)_<s>() ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(')]
- Dataflow: assignment
- Context: xss_plain
- Sink: vprintf_prm__<s>(This%s)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>
-->
<?php
# Init

# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = preg_replace("/'/", "", $tainted);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
vprintf("This%s", $context);

?>