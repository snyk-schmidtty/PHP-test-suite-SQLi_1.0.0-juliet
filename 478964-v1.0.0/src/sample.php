<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: sscanf_prm__<s>(foo %s) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
- Sink: echo_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. The ; can be used to chain commands
-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = sscanf($tainted, "foo %s");
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$pre = "<script>alert(Hello";
$post = ");</script>";
$context = ($pre . ($dataflow . $post));
echo($context);

?>