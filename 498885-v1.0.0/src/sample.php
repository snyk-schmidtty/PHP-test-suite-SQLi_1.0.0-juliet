<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: hash_prm__<s>(ripemd160)_<false>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: print_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = hash("ripemd160", $tainted, false);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
print($context);

?>