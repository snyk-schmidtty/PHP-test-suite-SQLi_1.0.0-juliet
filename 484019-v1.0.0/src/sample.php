<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: json_encode_prm__<c>(ENT_COMPAT) ==> Filters:[Filtered(&), Escape[\](", \)]
- Filters complete: Filters:[Filtered(&), Escape[\](", \)]
- Dataflow: assignment
- Context: xss_plain
- Sink: user_error_prm_

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
$tainted = getallheaders();
$sanitized = json_encode($tainted, ENT_COMPAT);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
user_error($context);

?>