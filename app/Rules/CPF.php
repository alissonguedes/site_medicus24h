<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

/**
 * CPF
 *
 * Verifica CPF é válido
 * @access	public
 */
class CPF implements Rule {

	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function passes($attribute, $value) {

		$regex  = '/(\W|a-z|A-Z)+/';
		$string = preg_replace($regex, '', $value);

		if (preg_match("/^{$string[0]}{11}$/", $string) || (strlen($string) != 11 && strlen($string) != 14)) {
			return false;
		}

		for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $string[$i++] * $s--);

		if ($string[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
			return false;
		}

		for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $string[$i++] * $s--);

		if ($string[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
			return false;
		}

		return true;

	}

	public function message() {
		return 'CPF Inválido';
	}

}
