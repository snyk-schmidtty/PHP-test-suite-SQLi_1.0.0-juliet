<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: str_shuffle ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: printf_func_prm__<s>(Print this: %d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

1. Create script tag with <script>
2. Apostrophe are useless inside plain html context for XSS
-->
<?php
# Init

# Sample
$tainted = apache_request_headers();
$tainted = $tainted["t"];
$sanitized = str_shuffle($tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
printf("Print this: %d", $context);

?>