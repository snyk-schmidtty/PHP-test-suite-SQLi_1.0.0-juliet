<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: parse_str ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_javascript
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

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
$tainted = $_COOKIE;
$tainted = $tainted["t"];
parse_str($tainted, $sanitized);
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$pre = "<script>alert(\"Hello";
$post = "\");</script>";
$context = ($pre . ($dataflow . $post));
trigger_error($context, E_USER_ERROR);

?>