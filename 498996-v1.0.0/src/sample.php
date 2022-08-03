<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: hash_hmac_prm__<s>(md5)_<s>(salt) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_html_param
- Sink: echo_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = hash_hmac("md5", $tainted, "salt");
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
echo($context);

?>