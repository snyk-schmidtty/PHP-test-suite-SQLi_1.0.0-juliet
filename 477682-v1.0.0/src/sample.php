<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: cast_sortof_prm__<i>(0.0) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_quotes
- Sink: echo_func

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
$sanitized = ($tainted + 0.0);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
echo($context);

?>