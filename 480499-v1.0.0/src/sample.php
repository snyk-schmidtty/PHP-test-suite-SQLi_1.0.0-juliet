<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: cast_prm__TYPE_STRING ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_quotes
- Sink: printf_func_prm__<s>(Print this: %s)

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
$tainted = apache_request_headers();
$tainted = $tainted["t"];
$sanitized = (string)($tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
printf("Print this: %s", $context);

?>