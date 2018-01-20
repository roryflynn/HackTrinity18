<?php
	$FLAG = "HackTrinity{they_call_it_pseudo_random_for_a_reason}";

	function generate_numbers() {
		return explode("\n", shell_exec("cd /javacode/ && java GenerateLottoNumbers"));
	}
?>