<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: filter_var_prm__<c>(FILTER_SANITIZE_NUMBER_INT) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_javascript
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = apache_request_headers();
$tainted = $tainted["t"];
$sanitized = filter_var($tainted, FILTER_SANITIZE_NUMBER_INT);
$dataflow = $sanitized;
$pre = "<script>alert(\"Hello";
$post = "\");</script>";
$context = ($pre . ($dataflow . $post));
trigger_error($context, E_USER_ERROR);

?>