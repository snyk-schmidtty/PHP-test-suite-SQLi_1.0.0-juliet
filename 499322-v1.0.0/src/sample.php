<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: ternerary_white_listing ==> Filters:[nums, letters, specials]
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
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = (($tainted == "DESC") ? "DESC" : "ASC");
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
print($context);

?>