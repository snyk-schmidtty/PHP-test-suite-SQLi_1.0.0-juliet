<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_UNSAFE_RAW) ==> Filters:[]
- Sanitization: str_word_count_prm__<i>(1) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_javascript
- Sink: printf_func_prm__<s>(Print this: %s)

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
$tainted = filter_input(INPUT_GET, "t", FILTER_UNSAFE_RAW);
$sanitized = str_word_count($tainted, 1);
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$pre = "<script>alert(\"Hello";
$post = "\");</script>";
$context = ($pre . ($dataflow . $post));
printf("Print this: %s", $context);

?>