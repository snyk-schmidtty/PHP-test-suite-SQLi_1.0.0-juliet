<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: hash_prm__<s>(ripemd160)_<false>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: vprintf_prm__<s>(This%s)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = hash("ripemd160", $tainted, false);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
vprintf("This%s", $context);

?>