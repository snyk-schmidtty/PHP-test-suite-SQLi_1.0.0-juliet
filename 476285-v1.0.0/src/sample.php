<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_UNSAFE_RAW))) ==> Filters:[]
- Sanitization: str_word_count_prm__<i>(0) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
- Sink: vprintf_prm__<s>(This%d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_UNSAFE_RAW]);
$tainted = $tainted["t"];
$sanitized = str_word_count($tainted, 0);
$dataflow = $sanitized;
$pre = "<script>alert(Hello";
$post = ");</script>";
$context = ($pre . ($dataflow . $post));
vprintf("This%d", $context);

?>