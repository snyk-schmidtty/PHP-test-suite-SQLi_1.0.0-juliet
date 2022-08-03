<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: hash_prm__<s>(ripemd160)_<false>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_plain
- Sink: user_error_prm_

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = hash("ripemd160", $tainted, false);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
user_error($context);

?>