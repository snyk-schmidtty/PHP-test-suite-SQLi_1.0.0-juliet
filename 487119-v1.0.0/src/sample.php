<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_ADD_SLASHES) ==> Filters:[Escape[\](", ', \)]
- Sanitization: str_ireplace_prm__<s>(')_<s>() ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered('), Escape[\](", ', \)]
- Dataflow: assignment
- Context: xss_quotes
- Sink: print_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>
2. Quotes are useless inside plain html context for XSS
-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_ADD_SLASHES);
$sanitized = str_ireplace("'", "", $tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
print($context);

?>