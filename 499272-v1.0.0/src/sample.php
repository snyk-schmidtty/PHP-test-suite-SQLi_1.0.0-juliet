<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_ADD_SLASHES) ==> Filters:[Escape[\](", ', \)]
- Sanitization: cast_sortof_prm__<i>(0) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials, Escape[\](", ', \)]
- Dataflow: assignment
- Context: xss_html_param
- Sink: printf_func_prm__<s>(Print this: %d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_ADD_SLASHES);
$sanitized = ($tainted + 0);
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
printf("Print this: %d", $context);

?>