<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: cast_prm__TYPE_DOUBLE ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
- Sink: user_error_prm_

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = (double)($tainted);
$dataflow = $sanitized;
$pre = "<script>alert(Hello";
$post = ");</script>";
$context = ($pre . ($dataflow . $post));
user_error($context);

?>