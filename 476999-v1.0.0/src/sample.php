<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_NUMBER_INT) ==> Filters:[letters, specials]
- Sanitization: str_replace_prm__<array>(<ae>(<s>(")), <ae>(<s>(')), <ae>(<s>(\<)) , <ae>(<s>(\>)))_<s>() ==> Filters:[Filtered(", ', <, >)]
- Filters complete: Filters:[letters, specials, Filtered(", ', <, >)]
- Dataflow: assignment
- Context: xss_quotes
- Sink: printf_func_prm__<s>(Print this: %d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_NUMBER_INT);
$sanitized = str_replace(["\"", "'", "<", ">"], "", $tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
printf("Print this: %d", $context);

?>