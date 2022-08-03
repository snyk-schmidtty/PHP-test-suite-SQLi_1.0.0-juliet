<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: hash_prm__<s>(ripemd160)_<false>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: exit

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = hash("ripemd160", $tainted, false);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
exit($context);

?>