<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: cast_prm__TYPE_STRING ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: print_func

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
$sanitized = (string)($tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
print($context);

?>