<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: str_shuffle ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_javascript
- Sink: echo_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. The ; can be used to chain commands
-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = str_shuffle($tainted);
$dataflow = $sanitized;
$pre = "<script>alert(\"Hello";
$post = "\");</script>";
$context = ($pre . ($dataflow . $post));
echo($context);

?>