<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: str_replace_prm__<s>(')_<s>() ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(')]
- Dataflow: assignment
- Context: xss_javascript
- Sink: vprintf_prm__<s>(This%s)

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
$tainted = apache_request_headers();
$tainted = $tainted["t"];
$sanitized = str_replace("'", "", $tainted);
$dataflow = $sanitized;
$pre = "<script>alert(\"Hello";
$post = "\");</script>";
$context = ($pre . ($dataflow . $post));
vprintf("This%s", $context);

?>