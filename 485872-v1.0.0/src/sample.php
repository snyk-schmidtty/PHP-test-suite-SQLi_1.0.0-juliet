<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: json_encode_prm__<c>(ENT_COMPAT) ==> Filters:[Filtered(&), Escape[\](", \)]
- Filters complete: Filters:[Filtered(&), Escape[\](", \)]
- Dataflow: assignment
- Context: xss_plain
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

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
$tainted = $_GET;
$sanitized = json_encode($tainted, ENT_COMPAT);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
trigger_error($context, E_USER_ERROR);

?>