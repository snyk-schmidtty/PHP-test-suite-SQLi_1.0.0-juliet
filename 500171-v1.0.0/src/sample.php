<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: str_replace_prm__<s>(')_<s>('''') ==> Filters:[Escape[double](')]
- Filters complete: Filters:[Escape[double](')]
- Dataflow: assignment
- Context: xss_html_param
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. It is possible to create javascript parameters for: img attributes: onerror
-->
<?php
# Init

# Sample
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = str_replace("'", "''", $tainted);
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
trigger_error($context, E_USER_ERROR);

?>