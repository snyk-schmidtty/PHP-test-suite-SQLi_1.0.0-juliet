<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_SPECIAL_CHARS) ==> Filters:[Filtered(", &, ', <, >)]
- Sanitization: addcslashes_prm__<s>(;:'") ==> Filters:[][Note: Escapes characters with \ but can be bypassed because \ is not escaped. E.g. \" to bypass the escaping of ".]
- Filters complete: Filters:[Filtered(", &, ', <, >)]
- Dataflow: assignment
- Context: xss_html_param
- Sink: user_error_prm_

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_SPECIAL_CHARS);
$sanitized = addcslashes($tainted, ";:'\"");
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
user_error($context);

?>