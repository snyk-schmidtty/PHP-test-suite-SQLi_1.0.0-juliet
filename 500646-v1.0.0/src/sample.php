<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: str_word_count_prm__<i>(0) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: printf_func_prm__<s>(Print this: %d)

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
$sanitized = str_word_count($tainted, 0);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
printf("Print this: %d", $context);

?>