<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: json_encode_prm__<c>(ENT_NOQUOTES) ==> Filters:[Filtered(&), Escape[\](", \)]
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
$tainted = $_REQUEST;
$sanitized = json_encode($tainted, ENT_NOQUOTES);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
user_error($context);

?>