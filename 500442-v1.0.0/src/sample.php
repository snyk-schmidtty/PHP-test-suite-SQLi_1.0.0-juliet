<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: cast_prm__TYPE_LONG ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_javascript
- Sink: vprintf_prm__<s>(This%d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = (int)($tainted);
$dataflow = $sanitized;
$pre = "<script>alert(\"Hello";
$post = "\");</script>";
$context = ($pre . ($dataflow . $post));
vprintf("This%d", $context);

?>