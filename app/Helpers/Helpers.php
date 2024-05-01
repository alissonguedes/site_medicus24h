<?php

use App\Models\System\ConfigModel;
use App\Models\System\MenuModel;
use App\Models\System\ModuloModel;
use Illuminate\Support\Facades\DB;
use PhpImap\Mailbox;

if (!function_exists('formatBytes')) {

	function formatBytes($size, $precision = 2)
	{
		if ($size > 0) {
			$size     = (int) $size;
			$base     = log($size) / log(1024);
			$suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

			return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
		} else {
			return $size;
		}
	}

}

if (!function_exists('data')) {
	function data($data, $format = 'd.m.Y H:i:s', $new_format = 'd/m/Y H:i:s')
	{
		$mes  = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
		$data = date($format, strtotime($data));
		$data = preg_replace('/\.(\d){2}\./', $new_format . $mes[date('m', strtotime($data)) - 1] . $new_format, $data);

		return $data;
	}
}

if (!function_exists('idade')) {

	function idade($data, $exibir_horas = false)
	{

		if (!$data) {
			return 'Idade não informada';
		}

		$date  = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
		$date  = date_create($date);
		$hoje  = date_create();
		$idade = date_diff($date, $hoje);

		$ano = $idade->y > 0 ? ($idade->y . ($idade->y === 1 ? ' ano' : ' anos')) : null;
		$mes = $idade->m > 0 ? ($idade->m . ($idade->m === 1 ? ' mês' : ' meses')) : null;
		$dia = $idade->d > 0 ? ($idade->d . ($idade->d === 1 ? ' dia' : ' dias')) : null;

		$tempo = $ano . ($ano && $mes ? ', ' : null) . $mes . ($dia ? ' e ' : null) . $dia;

		if ($exibir_horas) {
			$tempo .= ' - ' . $idade->h . 'h' . $idade->i . 'm' . $idade->s . 's';
		}

		return $tempo;

	}

}

if (!function_exists('date_translate')) {
	function date_translate($input_date, $input_format)
	{

		$to_format   = null;
		$output      = null;
		$str         = null;
		$calendar    = [];
		$days        = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
		$shortDays   = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
		$abrevDays   = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'];
		$months      = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
		$monthsShort = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

		// $output         = null;
		// $str            = null;
		// $calendar       = [];
		// $days           = ['Sunday' => 'Domingo', 'Monday' => 'segunda', 'Tuesday' => 'Terça', 'Wednesday' => 'Quarta', 'Thursday' => 'Quinta', 'Friday' => 'Sexta', 'Saturday' => 'Sábado'];
		// $shortDays      = ['Sun' => 'Dom', 'Mon' => 'Seg', 'Tue' => 'Ter', 'Wed' => 'Qua', 'Thu' => 'Qui', 'Fri' => 'Sex', 'Sat' => 'Sáb'];
		// $months         = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
		// $monthsShort    = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
		// $weekdays       = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
		// $weekdaysShort  = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
		// $weekdaysAbbrev = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'];

		// $format  = limpa_string($input_format, '-', false); // preg_replace(/' ', '.', ':', '-', '/', '\d\e'], ' ', $format);
		$formats = explode(' ', $input_format);
		// echo '-> ';
		// print_r($formats);

		$date = limpa_string($input_date, '-', false);
		$date = explode('-', $date);

		foreach ($formats as $f) {

			$d = strtotime($input_date);

			if (limpa_string($f, '', false) === 'l') {
				$calendar[] = $days[date('w', $d)];
			}

			if (limpa_string($f, '', false) === 'd') {
				$calendar[] = date('d', $d);
			}

			if (limpa_string($f, '', false) === 'D') {
				$calendar[] = $shortDays[date('w', $d)];
			}

			if (limpa_string($f, '', false) === 'F') {
				$calendar[] = $months[date('n', $d) - 1];
			}

			if (limpa_string($f, '', false) === 'Y') {
				$calendar[] = date('Y', $d);
			}

			if (limpa_string($f, '', false) === 'y') {
				$calendar[] = date('y', $d);
			}

			$h = limpa_string($f, ' ', false);
			$h = explode(' ', $h);

			if ((isset($h[0]) && $h[0] === 'H') || limpa_string($f, '', false) === 'H') {
				$calendar[] = date('H', $d);
			}

			if ((isset($h[1]) && $h[1] === 'i') || limpa_string($f, '', false) === 'i') {
				$calendar[] = date('i', $d);
			}

			if ((isset($h[2]) && $h[2] === 's') || limpa_string($f, '', false) === 's') {
				$calendar[] = date('s', $d);
			}

			if (preg_match('/\{[a-z0-9]+\}/', $f)) {
				$calendar[] = str_replace(['{', '}'], '', $f);
			}

		}

		if (preg_match('/\{[a-z0-9]+\}/', $input_format)) {

			preg_match_all('/\{[a-z]+\}/', $input_format, $out);
			$f = str_replace(['{', '}'], '', $out[0][0]);
			$f = addcslashes($f, 'a..z');

			$to_format = preg_replace('/\{[a-z]+\}/', $f, $input_format);

		}

		$ex = explode(' ', $input_format);

		foreach ($ex as $ind => $e) {

			if (preg_match('/\{[a-z0-9]+\}/', $e)) {
				$f        = addcslashes($e, 'a..z');
				$o        = str_replace(['{', '}'], '', $f);
				$output[] = $e;
			} else {
				$f  = limpa_string($e, ' ', false);
				$ex = explode(' ', $f);

				if (count($ex) > 1) {
					foreach ($ex as $i => $a) {
						$output[$ind + $i] = $a;
					}
				} else {
					if (!empty($f)) {

						if (preg_match('/\{[a-z0-9]+\}/', $f)) {
							$o        = addcslashes($f, 'a..z');
							$o        = str_replace(['{', '}'], '', $o);
							$output[] = $o;
						} else {
							$o        = $f;
							$output[] = $o;
						}
					}
				}
			}

		}

		$out = date($to_format, strtotime($input_date));

		$f = explode(' ', $to_format);

		$c = null;
		for ($i = 0; $i < count($f); $i++) {

			preg_match_all('/\,|\/|\.|\:|\-|\/\s/', $f[$i], $separator);

			if (count($separator[0]) > 0 && count($separator[0]) < 2) {

				$scal = null;

				for ($s = 0; $s <= count($separator[0]); $s++) {

					if ($scal != $calendar[$i]) {
						$scal = $calendar[$i + $s];
					} else {
						$scal = '';
					}

					$c .= $scal;

					if ($s < count($separator[0])) {
						$c .= $separator[0][$s];
					}

				}

			} else {

				$c .= $calendar[$i];

				if (count($separator[0]) > 1) {
					for ($s = 0; $s <= count($separator); $s++) {
						$c .= $separator[0][$s] . $calendar[$i + $s + 1];
					}
				}

			}

			$c .= ' ';

		}

		return $c;

	}

}

if (!function_exists('convert_to_date')) {
	function convert_to_date($input_date, $to_format = 'Y-m-d', $bd = true)
	{

		$format   = null;
		$datetime = explode(' ', $input_date);

		// if (count($datetime) > 1) {
		//     $date_str = $datetime[0];
		//     $time_str = $datetime[1];
		// } else {
		//     $date_str = $input_date;
		$time_str = null;
		// }

		$date_str = str_replace(['-', '/'], '-', $input_date);

		if (preg_match('/^(\d{2})\-(\d{2})-(\d{4})$/', $date_str)) {
			// $date = explode('-', $input_date);
			// $date = array_reverse($date);
			// $date = implode('-', $date);
			$date = strtotime($date_str);
			$date = date($to_format, $date);
		} else if (preg_match('/^(\d{2})\-(\d{2})\-(\d{4})(\s)(\d{2})\:(\d{2})(\:(\d{2}))?$/', $date_str)) {
			$date = strtotime($date_str);
			$date = date($to_format, $date);
		} else if (preg_match('/(\d{4})\-(\d{2})\-(\d{2})((\d{2})\:(\d{2})(\:(\d{2}))?)/', $date_str)) {
			$date = $date_str . (!is_null($time_str) ? ' ' . $time_str : null);
		} else if (preg_match('/^([dDjlLNSwWzFmMntoYyaABgGhHisueIOPTZcrU]((\s?\W?)?)+)+$/', $date_str)) {
			$format = $date_str;
			$date   = date($format, strtotime('now'));
		}

		if (is_null($format)) {
			$format = !is_null($time_str) ? 'Y-m-d H:i:s' : 'Y-m-d';
		}

		if (!$bd) {
			// try {

			// $date = \Carbon\Carbon::createFromFormat($to_format, $date)->format($to_format);

			$datec = strtotime($date);
			$datec = date('Y-m-d H:i:s', $datec);
			// $datec = date_format($d, $to_format);

			// echo $datec;

			// return $date;

			return date_translate($datec, $to_format);

			// } catch (Exception $e) {
			//     throw new ErrorException($to_format . ' ' . $e);
			// }
		} else {

			$date = \Carbon\Carbon::createFromFormat($to_format, $date)->format($format);

			return $date;

		}

	}

}

if (!function_exists('convert_time')) {
	function convert_time($time)
	{
		$seconds = intval($time);

		$negative = $seconds < 0;

		if ($negative) {
			$seconds = -$seconds;
		}

		$h = floor($seconds / 3600);
		$m = floor(($seconds - ($h * 3600)) / 60);
		$s = floor($seconds % 60);
		$d = floor(($seconds - ($h * 3600)) / 366);

		$h = $h > 0 ? $h . ' hora' . ($h > 1 ? 's' : null) : 0;
		$m = $h == 0 && $m > 0 ? $m . ' minuto' . ($m > 1 ? 's' : null) : 0;
		$s = $h == 0 && $m == 0 && $s <= 60 ? $s . ' segundo' . ($s > 1 ? 's' : null) : 0;

		if ($h > 0) {
			return $h;
		} else if ($m > 0 && $m < 60) {
			return $m;
		} else if ($s >= 0 && $s < 60) {
			return $s;
		}

	}
}

if (!function_exists('get_config')) {
	function get_config($config)
	{
		$cfg = new ConfigModel();
		// return $cfg->getConfigByKey($config)->first()->value ?? null;
		return $cfg->getConfigByKey($config) ?? null;
	}
}

if (!function_exists('mail_config')) {
	function mail_config($config = '*')
	{
		$cfg = new ConfigModel();
		// return $cfg->getConfigByKey($config)->first()->value ?? null;
		return $cfg->getMailConfig($config) ?? null;
	}
}

if (!function_exists('lang')) {
	function lang($return_id = false)
	{

		$sigla = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : get_config('language');

		if (!$return_id) {
			return $sigla;
		}

		$cfg = new ConfigModel();

		$id = $cfg->select('id')
			->from('tb_sys_idioma')
			->where('sigla', $sigla)
			->get()
			->first();

		return $id->id ?? $sigla;

	}
}

if (!function_exists('tradutor')) {

	function tradutor($traducao, $lang = null, $except = null)
	{
		$idioma = is_null($lang) ? lang() : $lang;

		// Formata a data e hora de acordo com o Idioma
		if (is_object($traducao)) {
			$date = (string) $traducao;

			switch ($idioma) {
				case 'en':$formato = 'Y-m-d h:ia';
					break;
				case 'pt-br':$formato = 'd/m/Y H\hi';
					break;
				case 'hr':$formato = 'd-m-y h:ia';
					break;
			}

			return date($formato, strtotime($date));
		}

		$return = is_string($traducao) ? json_decode($traducao, true) : $traducao;

		if (is_array($return) && array_key_exists($idioma, $return)) {
			if (!empty($return[$idioma])) {
				return $return[$idioma];
			}
		} else {
			return tradutor([$idioma => $traducao]);
		}

		$catch = [
			'en'    => 'Translation not available for this language',
			'hr'    => 'A fordítás nem érhetó el ezen a nyelven',
			'pt-br' => 'Tradução não disponível para este idioma',
		];

		$except = !is_null($except) ? $except : $catch;

		return $except[$idioma];
	}

}

if (!function_exists('hashCode')) {
	function hashCode($str, $min = 32, $max = 92)
	{
		$pass          = hash('whirlpool', $str);
		$salt          = hash('sha512', $str);
		$password      = substr($pass, $min, 92) . substr($salt, $min, 54);
		$password_hash = hash('sha512', hash('md5', $password));
		$hash          = substr(hash('whirlpool', hash('sha512', $pass . $salt . $password . $password_hash)), 0, 90);

		return !empty($str) ? substr(hash('whirlpool', hash('sha512', $hash)), 0, 77) : null;

		// return !empty($str) ? substr(hash('sha512', $str), 0, 50) : null;
	}
}

if (!function_exists('configuracoes')) {
	function configuracoes()
	{
	}
}

/**
 * Remove caratecres especiais
 * Converte todos os caracteres de um arquivo para caixa baixa
 * Remove espaçamentos.
 */
if (!function_exists('limpa_string')) {

	function limpa_string($string, $replace = '-', $to_lower = true)
	{
		$output = [];
		$a      = ['Á' => 'a', 'À' => 'a', 'Â' => 'a', 'Ä' => 'a', 'Ã' => 'a', 'Å' => 'a', 'á' => 'a', 'à' => 'a', 'â' => 'a', 'ä' => 'a', 'ã' => 'a', 'å' => 'a', 'a' => 'a', 'Ç' => 'c', 'ç' => 'c', 'Ð' => 'd', 'É' => 'e', 'È' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i', 'Ñ' => 'n', 'ñ' => 'n', 'Ó' => 'o', 'Ò' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'Õ' => 'o', 'ó' => 'o', 'ò' => 'o', 'ô' => 'o', 'ö' => 'o', 'õ' => 'o', 'ø' => 'o', 'œ' => 'o', 'Š' => 'o', 'Ú' => 'u', 'Ù' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'Ý' => 'y', 'Ÿ' => 'y', 'ý' => 'y', 'ÿ' => 'y', 'Ž' => 'z', 'ž' => 'z'];
		$string = strtr($string, $a);
		$regx   = [' ', '.', '+', '@', '#', '!', '$', '%', '¨', '&', '*', '(', ')', '_', '-', '+', '=', ';', ':', ',', '\\', '|', '£', '¢', '¬', '/', '?', '°', '´', '`', '{', '}', '[', ']', 'ª', 'º', '~', '^', "\'", '"'];

		$tolowercase = $to_lower ? strtolower($string) : $string;
		$replacement = str_replace($regx, '|', trim($tolowercase));
		$explode     = explode('|', $replacement);

		for ($i = 0; $i < count($explode); ++$i) {
			if (!empty($explode[$i])) {
				$output[] = trim($explode[$i]);
			}
		}

		return implode($replace, $output);
	}
}

if (!function_exists('download')) {

	function download($path, $filename)
	{
		$headers = null;

		// $headers .= ('Content-Description: File Transfer');
		// $headers .= ('Content-Type: application/octet-stream');
		// $headers .= ('Content-Disposition: attachment; filename=' . $filename);
		// $headers .= ('Content-Transfer-Encoding: binary');
		// $headers .= ('Expires: 0');
		// $headers .= ('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		// $headers .= ('Pragma: public');
		// $headers .= ('Content-Length: ' . Storage::size($path));

		return Storage::download($path, $filename);

	}
}

/**
 * Função para exibir o endereço.
 *
 * @param array $config [ col, set, div ]
 * @param col => string - the column name
 * @param set => boolean - show or hide from list
 * @param div => string - separator caracter
 * @param array [ 'col' => 'column1', 'set' => boolean, 'div' => '<separator>']
 */
if (!function_exists('exibir_endereco')) {

	function exibir_endereco(array $config = [
		['col' => 'address', 'set' => true, 'div' => ', '],
		['col' => 'address_nro', 'set' => true, 'div' => '<br> '],
		['col' => 'cep', 'set' => true, 'div' => ' - '],
		['col' => 'bairro', 'set' => true, 'div' => ', '],
		['col' => 'complemento', 'set' => true, 'div' => '<br>'],
		['col' => 'cidade', 'set' => true, 'div' => ', '],
		['col' => 'uf', 'set' => true, 'div' => ' - '],
		['col' => 'pais', 'set' => true, 'div' => ''],
	]) {
		$endereco = null;

		foreach ($config as $ind => $val) {
			$local = null;

			if (!empty($val) && !is_null($config[$ind++])) {
				if (!empty(get_config($val['col']))) {
					$local = get_config($val['col']);
				}

				if ($ind < count($config)) {
					if (!is_null(get_config($config[$ind++]['col']))) {
						/*
						 * Aqui, verifica se a condição do próximo array
						 * é válida para exibir o próximo caráctere separador
						 */
						if (!is_null($local)) {
							if ($ind < count($config)) {
								$local .= $val['div'];
							}
						}
					}
				}
			}

			$endereco .= $local;
		}

		return $endereco;
	}

}

if (!function_exists('base_url')) {

	function base_url()
	{

		$path     = '/';
		$base_url = explode('/', request()->getRequestUri());

		foreach ($base_url as $ind => $base) {

			if ($base_url[$ind] == '') {
				$base_url[$ind] = '/';
			}

			$dir = app_path() . '/Http/Controllers/' . ucfirst(str_replace('/', '', $base_url[$ind]));
			if ($base_url[$ind] != '/' && is_dir($dir)) {
				$path = $base;
				break;
			}

		}

		return url($path) . '/';

	}
}

if (!function_exists('site_url')) {

	function site_url()
	{

		return url('/') . '/';

	}

}

/** Função para gerar lista de menus editáveis com NestableJS */
if (!function_exists('Nestable')) {

	function Nestable($list, $children = true)
	{

		$ol = '';

		if ($children) {
			$ol = '<div class="dd" id="nestable">';
		}

		$ol .= '<ol class="dd-list">';

		foreach ($list as $l) {

			$ol .= '<li class="dd-item" data-id="' . $l['id'] . '">';
			$ol .= '<div class="dd-handle dd3-handle"></div>';

			$ol .= '<div class="dd3-content">' . $l['item'] . '
						<a href="#" class="red-text right remove-menu">Excluir</a>
						<div style="display: none;">Teste</div>
					</div>';

			if (isset($l['children'])) {

				foreach ($l['children'] as $c) {
					$ol .= Nestable($c, false);
				}

			}

			$ol .= '</li>';

		}

		if ($children) {
			$ol .= '</div>';
		}

		$ol .= '</ol>';

		return $ol;

	}

}

/**
 * @deprecated
 * Fução para obter os menus da página
 */
if (!function_exists('getMenus')) {

	function getMenus($local, $id, $attributes = [], $path = null)
	{

		$menuModel   = new MenuModel();
		$moduloModel = new ModuloModel();
		$modulo      = explode('/', request()->path());
		$path        = '/' . (!is_null($path) ? $path : $modulo[0]);

		$idModulo = $moduloModel->select('id')
			->from('tb_acl_modulo')
			->where('path', $path)
			->get()
			->first();

		if (isset($idModulo)) {
			$idModulo = $idModulo->id;
		}

		$menus = $menuModel->select(
			'Menu.id',
			'Menu.status',
			DB::raw('(SELECT titulo FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = "' . lang(true) . '") AS titulo'),
			DB::raw('(SELECT descricao FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = "' . lang(true) . '") AS descricao')
		)
			->from('tb_acl_menu AS Menu')
			->join('tb_acl_modulo_grupo_menu AS MG_Menu', 'MG_Menu.id_menu', 'Menu.id')
			->whereIn('MG_Menu.id_modulo_grupo', function ($query) use ($idModulo, $moduloModel, $path) {
				$q = $query->select('id')
					->from('tb_acl_modulo_grupo')
					->whereColumn('id_modulo_grupo', 'id')
					->where('id_modulo', $idModulo);

				if ($moduloModel->getIsRestrictModulo($path)) {
					if (session()->exists('userdata') && session()->exists('app_session')) {
						$id_grupo = session()->get('userdata')[session()->get('app_session')]['id_grupo'];
						$q->where('id_grupo', $id_grupo);
					}
				}

			})
			->whereColumn('MG_Menu.id_menu', 'Menu.id');

		$getMenus = $menus->where('Menu.status', '1')
			->where('MG_Menu.status', '1')
			->get();

		$ul     = null;
		$params = null;

		if ($getMenus->count() > 0) {

			if (!empty($attributes)) {
				foreach ($attributes as $ind => $val) {
					$params .= ' ' . $ind . '="' . $val . '"';
				}
			}

			$ul = '<ul' . $params . '>';

			foreach ($getMenus as $menu) {

				$items = $menuModel->select(
					'Item.id',
					'Item.id_controller',
					'Item.id_parent',
					'Item.id_route',
					'Item.icon',
					'Item.divider',
					'Item.item_type',
					DB::raw('(SELECT titulo FROM tb_acl_menu_item_descricao WHERE id_item = Item.id AND id_idioma = "' . lang(true) . '") AS titulo'),
					DB::raw('(SELECT descricao FROM tb_acl_menu_item_descricao WHERE id_item = Item.id AND id_idioma = "' . lang(true) . '") AS descricao'),
				)
					->from('tb_acl_menu_item AS Item')
					->whereIn('Item.id', function ($query) use ($menu, $path, $idModulo, $moduloModel) {
						$query->select('I.id_item')
							->from('tb_acl_menu_item_menu AS I')
							->whereColumn('I.id_item', 'Item.id')
							->where('I.status', '1')
							->where('I.id_menu', $menu->id)
							->whereIn('I.id_menu', function ($query) use ($menu, $path, $idModulo, $moduloModel) {
								$query->select('id_menu')
									->from('tb_acl_modulo_grupo_menu AS G')
									->whereColumn('G.id_menu', 'I.id_menu')
									->where('G.id_menu', $menu->id)
									->where('id_modulo_grupo', function ($query) use ($menu, $path, $idModulo, $moduloModel) {
										$query = $query->select('id')
											->from('tb_acl_modulo_grupo')
											->whereColumn('id', 'id_modulo_grupo')
											->where('id_modulo', $idModulo);
										if ($moduloModel->getIsRestrictModulo($path)) {
											if (Auth::user()) {
												$id_grupo = Auth::user()->id_grupo;
												$query->where('id_grupo', $id_grupo);
											}

											// if (session()->exists('userdata') && session()->exists('app_session')) {
											//     $id_grupo = session()->get('userdata')[session()->get('app_session')]['id_grupo'];
											//     $query->where('id_grupo', $id_grupo);
											// }
										}
									});
							});
					})
					->where('id_parent', $id)
					->where('status', '1')
					->orderBy('ordem', 'asc')
					->orderBy('descricao', 'asc')
					->get();

				if ($items->count() > 0) {

					// if (!$id) {
					//     $ul .= '<li><h6 class="menu-description">' . $menu->titulo . '</h6></li>';
					// }

					foreach ($items as $item) {

						// $ul .= '<li class="menu-description"><h6>' . $item->item_type . '</h6></li>';

						if (isset($item->item_type)) {
							$ul .= '<li class="navigation-header">
									<span class="navigation-header-text" style="font-weight: 600; color: var(--grey-lighten-1)">
										' . $item->item_type . '
									</span>
									<i class="navigation-header-icon material-icons-outlined">more_horiz</i>
								</li>';
						}

						$submenus = $menuModel->from('tb_acl_menu_item')
							->where('id_parent', $item->id)
							->where('status', '1')
							->whereIn('id', function ($query) use ($menu) {
								$query->select('id_item')
									->from('tb_acl_menu_item_menu')
									->whereColumn('id_item', 'id')
									->where('status', '1')
									->where('id_menu', $menu->id);
							})
							->first();

						$route = $menuModel->select('name')
							->from('tb_acl_modulo_routes')
							->where('status', '1')
							->where('type', 'any')
							->where(function ($query) {
								$query->where('id_parent')
									->orWhere('id_parent', '0');
							})
							->where('id_controller', $item->id_controller);

						$id_route = $item->id_route > 0 ? $item->id_route : null;

						if (!is_null($id_route)) {
							$route->where('id', $id_route);
						}

						$route = $route->first();

						if (isset($route)) {

							if ($item->divider) {
								$ul .= '<li class="divider" style="margin: 10px 0;"></li>';
							}

							$target = 'target="' . (strtolower($item->titulo) == 'dashboard' ? '_self' : $item->target) . '"' ?? null;
							$a      = null;

							if (isset($submenus)) {

								$a = 'class="collapsible-header waves-effect waves-cyan" href="javascript:void(0);" tabindex="0"';

							} else {

								if (isset($route)) {
									$a = 'href="' . go($route->name) . '"';
								} else {
									$a = 'href="#"';
								}

							}

							$tooltip = null; // data-tooltip="' . $item->titulo . '" data-position="right"
							$ul .= '<li ' . $tooltip . '>';

							$ul .= '<a ' . $a . ' ' . $target . '>';
							$ul .= $item->icon ? (preg_match('[^fa\-]', $item->icon) ? '<span class="fa-icon fa-solid ' . $item->icon . '"></span>' : '<span class="material-symbols-outlined">' . $item->icon . '</span>') : '<span class="material-symbols-outlined">radio_button_unchecked</span>';

							$label = (object) ['titulo' => $item->titulo ?? 'no title'];
							$ul .= '<span class="menu-title">' . $label->titulo . '</span>';
							$ul .= '</a>';

							if (isset($submenus)) {

								$ul .= '<div class="collapsible-body">';

								$ul .= getMenus($local, $item->id, [
									'class'            => 'collapsible collapsible-sub',
									'data-collapsible' => 'accordion',
								]);

								$ul .= '</div>';

							}

						}

					}

				}

			}

			$ul .= '</ul>';
		}

		return $ul;

	}

	/*
	 * Novo menu
	 * O menu antigo não separava por grupos
	 */
	function getMenus_Original($local, $id, $attributes = [])
	{

		// is_null($lang) ? (isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : get_config('language')) : $lang;

		$ul = null;

		$menuModel   = new MenuModel();
		$moduloModel = new ModuloModel();
		$modulo      = explode('/', request()->path())[0];
		$modulo      = '/' . $modulo;

		$idModulo = $moduloModel->select('id')
			->from('tb_acl_modulo')
			->where('path', $modulo)
			->get()
			->first();

		$getMenus = $menuModel->select(
			'Menu.*',
			DB::raw('(SELECT titulo FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = ' . lang(true) . ') AS titulo'),
			DB::raw('(SELECT descricao FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = ' . lang(true) . ') AS descricao')
		)
			->from(DB::raw('tb_acl_menu AS Menu, tb_acl_modulo AS Modulo, tb_acl_modulo_grupo_menu AS MMenu'))
			->whereColumn('MMenu.id_menu', 'Menu.id')
			->whereColumn('MMenu.id_modulo_grupo', 'Modulo.id')
			->where('Modulo.id', function ($query) use ($modulo) {
				$query->select('id')
					->from('tb_acl_modulo')
					->where('path', $modulo);
			})

		// ->where('id', function ($query) use ($local) {
		//     $query->select('value')
		//         ->from('tb_sys_config')
		//         ->where('config', $local)
		//         ->where('value', get_config($local))
		//         ->whereColumn('id_modulo', 'id_modulo');
		// })

			->where('Menu.status', '1')
			->where('Modulo.status', '1')
			->where('MMenu.status', '1');

		if ($moduloModel->getIsRestrictModulo($modulo)) {

			if (session()->exists('userdata') && session()->exists('app_session')) {
				$getMenus = $getMenus->where('Menu.id_grupo', session()
						->get('userdata')[session()->get('app_session')]['id_grupo']);
			}

		}

		$getMenus = $getMenus->get();

		if ($getMenus->count() > 0) {

			foreach ($getMenus as $menu) {

				$items = $menuModel->select('Item.*')
					->from(DB::raw('tb_acl_menu_item AS Item'))
					->where('id_parent', $id)
					->whereIn('Item.id', function ($query) use ($menu) {
						$query->select('id_item')
							->from('tb_acl_menu_item_menu')
							->whereColumn('id_item', 'id')
							->where('status', '1')
							->where('id_menu', $menu->id);
					})
					->where('status', '1')
					->orderBy('ordem', 'asc')
					->orderBy('descricao', 'asc')
					->get();

				if ($items->count() > 0) {

					$params = null;

					if (!empty($attributes)) {
						foreach ($attributes as $ind => $val) {
							$params .= ' ' . $ind . '="' . $val . '"';
						}
					}

					$ul = '<ul' . $params . '>';

					$ul .= '<li><h6 class="menu-description">' . $menu->titulo . '</h6></li>';

					foreach ($items as $item) {

						$submenus = $menuModel->from('tb_acl_menu_item')
							->where('id_parent', $item->id)
							->where('status', '1')
							->whereIn('id', function ($query) use ($menu) {
								$query->select('id_item')
									->from('tb_acl_menu_item_menu')
									->whereColumn('id_item', 'id')
									->where('status', '1')
									->where('id_menu', $menu->id);
							})
							->get()
							->first();

						$route = $menuModel->select('name')
							->from('tb_acl_modulo_routes')
							->where('status', '1')
							->where('type', 'any')
							->where(function ($query) {
								$query->where('id_parent')
									->orWhere('id_parent', '0');
							})
							->where('id_controller', $item->id_controller);

						$id_route = $item->id_route > 0 ? $item->id_route : null;

						if (!is_null($id_route)) {
							$route->where('id', $id_route);
						}

						$route = $route->first();

						if (isset($route)) {

							$label = $menuModel->select('descricao AS titulo')
								->from('tb_acl_menu_item_descricao')
								->where('id_item', $item->id)
								->first();

							if (!isset($label)) {
								$label = (object) ['titulo' => 'no title'];
							}

							if ($item->divider) {
								$ul .= '<li class="divider" style="margin: 10px 0;"></li>';
							}

							// if ($item->item_type) {
							//     $ul .= '<li><h6 class="menu-description">' . $item->item_type . '</h6></li>';
							// }

							$target = 'target="' . $item->target . '"' ?? null;
							$a      = null;

							if (isset($submenus)) {
								// if ($submenus->count() > 0) {

								$a = 'class="collapsible-header waves-effect waves-cyan" href="javascript:void(0);" tabindex="0"';

							} else {

								if (isset($route)) {
									$a = 'href="' . route($route->name) . '"';
								} else {
									$a = 'href="#"';
								}

							}

							$ul .= '<li>';

							$ul .= '<a ' . $a . ' ' . $target . '>';
							$ul .= $item->icon ? (preg_match('[^fa\-]', $item->icon) ? '<span class="fa-icon fa-solid ' . $item->icon . '"></span>' : '<span class="material-symbols-outlined">' . $item->icon . '</span>') : '<span class="material-symbols-outlined">radio_button_unchecked</span>';

							$ul .= '<span class="menu-title">' . $label->titulo . '</span>';
							$ul .= '</a>';

							// if ($submenus->count() > 0) {
							if (isset($submenus)) {

								$ul .= '<div class="collapsible-body">';

								$ul .= getMenus($local, $item->id, [
									'class'            => 'collapsible collapsible-sub',
									'data-collapsible' => 'accordion',
								]);

								$ul .= '</div>';

							}

							$ul .= ' </li>';

						}

					}

					$ul .= '</ul>';

				}

			}

		}

		return $ul;

	}

}

if (!function_exists('getMenuApp')) {

	function getMenuApp($local, $id = null, $path = null)
	{

		$menu_list   = [];
		$menuModel   = new MenuModel();
		$moduloModel = new ModuloModel();
		$modulo      = explode('/', request()->path());
		$path        = '/' . (!is_null($path) ? $path : $modulo[0]);

		$idModulo = $moduloModel->select('id')
			->from('tb_acl_modulo')
			->where('path', $path)
			->get()
			->first();

		if (isset($idModulo)) {
			$idModulo = $idModulo->id;
		}

		$menus = $menuModel->select(
			'Menu.id',
			'Menu.status',
			DB::raw('(SELECT titulo FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = "' . lang(true) . '") AS titulo'),
			DB::raw('(SELECT descricao FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = "' . lang(true) . '") AS descricao')
		)
			->from('tb_acl_menu AS Menu')
			->join('tb_acl_modulo_grupo_menu AS MG_Menu', 'MG_Menu.id_menu', 'Menu.id')
			->whereIn('MG_Menu.id_modulo_grupo', function ($query) use ($idModulo, $moduloModel, $path) {
				$q = $query->select('id')
					->from('tb_acl_modulo_grupo')
					->whereColumn('id_modulo_grupo', 'id')
					->where('id_modulo', $idModulo);

				if ($moduloModel->getIsRestrictModulo($path)) {
					if (session()->exists('userdata') && session()->exists('app_session')) {
						$id_grupo = session()->get('userdata')[session()->get('app_session')]['id_grupo'];
						$q->where('id_grupo', $id_grupo);
					}
				}

			})
			->whereColumn('MG_Menu.id_menu', 'Menu.id');

		$getMenus = $menus->where('Menu.status', '1')
			->where('MG_Menu.status', '1')
			->get();

		$ul     = null;
		$params = null;

		if ($getMenus->count() > 0) {

			foreach ($getMenus as $menu) {

				$items = $menuModel->select(
					'Item.id',
					'Item.id_controller',
					'Item.id_parent',
					'Item.id_route',
					'Item.icon',
					'Item.divider',
					'Item.item_type',
					DB::raw('(SELECT titulo FROM tb_acl_menu_item_descricao WHERE id_item = Item.id AND id_idioma = "' . lang(true) . '") AS titulo'),
					DB::raw('(SELECT descricao FROM tb_acl_menu_item_descricao WHERE id_item = Item.id AND id_idioma = "' . lang(true) . '") AS descricao'),
				)
					->from('tb_acl_menu_item AS Item')
					->whereIn('Item.id', function ($query) use ($menu, $path, $idModulo, $moduloModel) {
						$query->select('I.id_item')
							->from('tb_acl_menu_item_menu AS I')
							->whereColumn('I.id_item', 'Item.id')
							->where('I.status', '1')
							->where('I.id_menu', $menu->id)
							->whereIn('I.id_menu', function ($query) use ($menu, $path, $idModulo, $moduloModel) {
								$query->select('id_menu')
									->from('tb_acl_modulo_grupo_menu AS G')
									->whereColumn('G.id_menu', 'I.id_menu')
									->where('G.id_menu', $menu->id)
									->where('id_modulo_grupo', function ($query) use ($menu, $path, $idModulo, $moduloModel) {
										$query = $query->select('id')
											->from('tb_acl_modulo_grupo')
											->whereColumn('id', 'id_modulo_grupo')
											->where('id_modulo', $idModulo);
										if ($moduloModel->getIsRestrictModulo($path)) {
											if (Auth::user()) {
												$id_grupo = Auth::user()->id_grupo;
												$query->where('id_grupo', $id_grupo);
											}
										}
									});
							});
					})
					->where('id_parent', $id)
					->where('status', '1')
					->orderBy('ordem', 'asc')
					->orderBy('descricao', 'asc')
					->get();

				if ($items->count() > 0) {

					foreach ($items as $item) {

						// dump($item);

						if (!is_null($item->item_type)) {
							$menu_list[$menu->id][] = [
								'id'       => $item->id,
								'titulo'   => $item->item_type,
								'category' => true,
							];
						}

						$submenus = $menuModel->from('tb_acl_menu_item')
							->where('id_parent', $item->id)
							->where('status', '1')
							->whereIn('id', function ($query) use ($menu) {
								$query->select('id_item')
									->from('tb_acl_menu_item_menu')
									->whereColumn('id_item', 'id')
									->where('status', '1')
									->where('id_menu', $menu->id);
							})
							->first();

						$route = $menuModel->select('name')
							->from('tb_acl_modulo_routes')
							->where('status', '1')
							->where('type', 'any')
							->where(function ($query) {
								$query->where('id_parent')
									->orWhere('id_parent', '0');
							})
							->where('id_controller', $item->id_controller);

						$id_route = $item->id_route > 0 ? $item->id_route : null;

						if (!is_null($id_route)) {
							$route->where('id', $id_route);
						}

						if (!is_null($id_route)) {
							$route->where('id', $id_route);
						}

						$route = $route->first();

						$a = null;

						// if (isset($route)) {

						if ($item->divider) {
							$ul .= '<li class="divider" style="margin: 10px 0;"></li>';
						}

						$target = 'target="' . $item->target . '"' ?? null;

						// if (isset($submenus)) {

						// 	$a = 'class="collapsible-header waves-effect waves-cyan" href="javascript:void(0);" tabindex="0"';

						// } else {

						if (isset($route)) {
							$a = $route->name; // $a = 'href="' . go($route->name) . '"';
						} else {
							$a = 'href="#"';
						}

						// }

						// }

						$menu_list[$menu->id][$item->id] = [
							'id'            => $item->id,
							'id_parent'     => $item->id_parent,
							'id_controller' => $item->controller,
							'id_route'      => $item->id_route,
							'route'         => $a,
							'icon'          => $item->icon,
							'divider'       => $item->divider,
							'item_type'     => $item->item_type,
							'titulo'        => $item->titulo,
							'descricao'     => $item->descricao,
							'category'      => false,
							'children'      => [],
						];

						if (isset($submenus)) {

							$menu_list[$menu->id][$item->id]['children'] = getMenuApp($local, $item->id);

						}

					}

				}

				// if ($items->count() > 0) {

				// 	// if (!$id) {
				// 	//     $ul .= '<li><h6 class="menu-description">' . $menu->titulo . '</h6></li>';
				// 	// }

				// 	foreach ($items as $item) {

				// 		// $ul .= '<li class="menu-description"><h6>' . $item->item_type . '</h6></li>';

				// 		if (isset($item->item_type)) {
				// 			$ul .= '<li class="navigation-header">
				// 					<span class="navigation-header-text" style="font-weight: 600; color: var(--grey-lighten-1)">
				// 						' . $item->item_type . '
				// 					</span>
				// 					<i class="navigation-header-icon material-icons-outlined">more_horiz</i>
				// 				</li>';
				// 		}

				// 		$submenus = $menuModel->from('tb_acl_menu_item')
				// 			->where('id_parent', $item->id)
				// 			->where('status', '1')
				// 			->whereIn('id', function ($query) use ($menu) {
				// 				$query->select('id_item')
				// 					->from('tb_acl_menu_item_menu')
				// 					->whereColumn('id_item', 'id')
				// 					->where('status', '1')
				// 					->where('id_menu', $menu->id);
				// 			})
				// 			->first();

				// 		$route = $menuModel->select('name')
				// 			->from('tb_acl_modulo_routes')
				// 			->where('status', '1')
				// 			->where('type', 'any')
				// 			->where(function ($query) {
				// 				$query->where('id_parent')
				// 					->orWhere('id_parent', '0');
				// 			})
				// 			->where('id_controller', $item->id_controller);

				// 		$id_route = $item->id_route > 0 ? $item->id_route : null;

				// 		if (!is_null($id_route)) {
				// 			$route->where('id', $id_route);
				// 		}

				// 		$route = $route->first();

				// 		if (isset($route)) {

				// 			if ($item->divider) {
				// 				$ul .= '<li class="divider" style="margin: 10px 0;"></li>';
				// 			}

				// 			$target = 'target="' . $item->target . '"' ?? null;
				// 			$a      = null;

				// 			if (isset($submenus)) {

				// 				$a = 'class="collapsible-header waves-effect waves-cyan" href="javascript:void(0);" tabindex="0"';

				// 			} else {

				// 				if (isset($route)) {
				// 					$a = 'href="' . go($route->name) . '"';
				// 				} else {
				// 					$a = 'href="#"';
				// 				}

				// 			}

				// 			$tooltip = null; // data-tooltip="' . $item->titulo . '" data-position="right"
				// 			$ul .= '<li ' . $tooltip . '>';

				// 			$ul .= '<a ' . $a . ' ' . $target . '>';
				// 			$ul .= $item->icon ? (preg_match('[^fa\-]', $item->icon) ? '<span class="fa-icon fa-solid ' . $item->icon . '"></span>' : '<span class="material-symbols-outlined">' . $item->icon . '</span>') : '<span class="material-symbols-outlined">radio_button_unchecked</span>';

				// 			$label = (object) ['titulo' => $item->titulo ?? 'no title'];
				// 			$ul .= '<span class="menu-title">' . $label->titulo . '</span>';
				// 			$ul .= '</a>';

				// 			if (isset($submenus)) {

				// 				$ul .= '<div class="collapsible-body">';

				// 				$ul .= getMenus($local, $item->id, [
				// 					'class'            => 'collapsible collapsible-sub',
				// 					'data-collapsible' => 'accordion',
				// 				]);

				// 				$ul .= '</div>';

				// 			}

				// 		}

				// 	}

				// }

			}

			// $ul .= '</ul>';
		}

		return $menu_list;
		// return $ul;

	}

}

if (!function_exists('make_menu')) {

	function make_menu($local, $id = null, $attributes = [])
	{

		if (!empty($attributes)) {
			foreach ($attributes as $ind => $val) {
				$params .= ' ' . $ind . '="' . $val . '"';
			}
		}

		$items = getMenuApp($local, $id);

		if (count($items) > 0) {

			foreach ($items as $menus) {

				foreach ($menus as $menu) {

					// <div class="menu-item">
					// 		<a href="{{ route('clinica.pacientes.index') }}" class="">
					// 			<div class="btn-menu circle z-depth-3 white mb-2 waves-effect">
					// 				<i class="material-icons red-text text-darken-2">users</i>
					// 			</div>
					// 			<span class="title white-text">Recursos médicos {{ $i }}</span>
					// 		</a>
					// 	</div>

					// echo '<ol class="menu">';

					if ($menu['category']) {

						echo '<div class="col s12"><h3 class="menu-description">' . $menu['titulo'] . '</h3></div>';

					} else {

						$href = empty($menu['children']) ? route($menu['route']) : 'javascript:void(0);';
						$icon = $menu['icon'] ? (preg_match('[^fa\-]', $menu['icon']) ? '<i class="fa-icon fa-solid ' . $menu['icon'] . ' red-text text-darken-2" style="font-size: 42px; line-height: 52px;"></i>' : '<i class="material-symbols-outlined red-text text-darken-2" style="font-size: 42px; line-height: 52px;">' . $menu['icon'] . '</i>') : '<i class="material-symbols-outlined red-text text-darken-2" style="font-size: 42px; line-height: 52px;">radio_button_unchecked</i>';

						if (empty($menu['children'])) {
							echo '<div class="col s4 m3 l3 buttons">';
							echo '<div class="menu-item">';
							echo '<div data-href="' . $href . '" target="_self" class="transparent no-border">';
							echo '<div class="btn-menu circle z-depth-3 white mb-2 waves-effect">';
							echo $icon;
							echo '</div>';
							echo '<span class="title white-text">' . $menu['titulo'] . '</span>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
						} else {
							// echo '<div class="col s12">' . $menu['titulo'] . '</div>';
							// echo '<div class="col s12"><h4 class="menu-description">' . $menu['titulo'] . '</h4></div>';
							if (count($menu['children']) > 0) {
								echo '<div id="menu-children-' . $menu['id'] . '" class="">' . make_menu($menu['children'], $menu['id']) . '</div>';
							}

						}

					}

				}

			}

			// echo '</ol>';

		}

	}

}

if (!function_exists('RecursiveRemove')) {

	function RecursiveRemove($path)
	{

		die('Para utilizar esta função, comente esta linha dentro do arquivo.');

		$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

		$files = null;

		foreach ($rii as $file) {

			if ($file->isDir()) {
				continue;
			}

			$files = $file->getPathname();
			unlink($files);

		}

	}

}

if (!function_exists('go')) {

	function go($url, $params = null)
	{

		$route  = $url;
		$modulo = new ModuloModel();

		$route = $modulo->getRoute($url);

		return isset($route->name) ? route($route->name, $params ?? null) : $route;

	}

}

if (!function_exists('gera_cartao')) {

	function gera_cartao($codigo = null, $format = false, $separator = ' ')
	{

		$faker = new Faker\Factory();

		if (empty($codigo)) {

			$codigo = $faker->create('pt_BR')->imei();

		}

		if (!isValidImei($codigo)) {
			return $codigo . ' -> not Valid';
		}

		if ($format) {
			$number = substr($codigo, 0, 3) . $separator . substr($codigo, 3, 3) . $separator . substr($codigo, 6, 6) . $separator . substr($codigo, 12, 3);
		} else {
			$number = $codigo;
		}

		return $number;
	}

	function sumDig($n)
	{
		$a = 0;
		while ($n > 0) {
			$a = $a + $n % 10;
			$n = $n / 10;
		}
		return $a;
	}

	function isValidImei($n)
	{

		$s   = (string) ($n);
		$len = strlen($s);

		if ($len != 15) {
			return false;
		}
		$sum = 0;
		for ($i = $len; $i >= 1; $i--) {
			$d = (int) ($n % 10);
			if ($i % 2 === 0) {
				$d = 2 * $d;
			}
			$sum += sumDig($d);
			$n = $n / 10;
		}
		return ($sum % 10 === 0);
	}

}

if (!function_exists('credit_card')) {

	function credit_card($ncard = null, $min = 16, $max = 16)
	{

		if (empty($ncard)) {

			$ncard = rand(4, 6);

			for ($start = $min, $end = $max; $start < $min, $end > 0; $start++, $end--) {

				if (strlen($ncard) < $max) {
					$ncard .= rand(0, 9);
				}

			}

		}

		$last_val = (int) substr($ncard, -1);

		$doubles = [];

		for ($i = 0, $t = strlen($ncard); $i < $t; $i++) {

			$doubles[] = substr($ncard, $i, 1) * ($i % 2 == 0 ? 2 : 1);

		}

		$sum = 0;

		foreach ($doubles as $double) {
			for ($i = 0, $t = strlen($double); $i < $t; ++$i) {
				$sum += (int) substr($double, $i, 1);
			}
		}

		if ($last_val === (10 - $sum % 10) % 10) {

			return true;

		} else {

			// credit_card();

		}

		return false;

	}

}

if (!function_exists('random')) {

	function random($array = [])
	{

		if (empty($array)) {
			return 'Conjunto de elementos não foi definido.';
		}

		$rand = rand(0, count($array) - 1);

		return $array[$rand];

	}
}

if (!function_exists('Mailbox') && !function_exists('getFolders')) {

	/**
	 * Function to MailBox
	 * @link https://github.com/gregoirer/laravel-imap/blob/master/README.md
	 */
	function Mailbox($folder = 'INBOX', $limit = 10, $page = 1)
	{

		$mail = mail_config();

		$data = [
			'folders'   => [],
			'folder'    => [],
			'mails'     => [],
			'exception' => null,
		];

		if ($mail) {

			$account = [
				'host'           => $mail->host,
				'port'           => $mail->port,
				'protocol'       => $mail->protocol,
				'encryption'     => $mail->encryption,
				'validate_cert'  => $mail->validate_cert,
				'username'       => $mail->username,
				'password'       => $mail->password,
				'authentication' => $mail->authentication,
				'proxy'          => [
					'socket'          => $mail->proxy_socket,
					'request_fulluri' => $mail->request_fulluri,
					'username'        => $mail->proxy_username,
					'password'        => $mail->proxy_password,
				],
				'timeout'        => $mail->timeout,
				'extensions'     => $mail->extensions,
			];

			config(['imap.accounts.default' => $account]);

			try {

				/** @var \Webklex\PHPIMAP\Client $client */
				$client = ImapClient::connect($account);

				//Connect to the IMAP Server
				$client->connect();

				//Get all Mailboxes
				/** @var \Webklex\PHPIMAP\Support\FolderCollection $folders */
				$f               = ($folder == 'inbox' || $folder == 'INBOX') ? strtoupper($folder) : ucfirst($folder);
				$data['folders'] = $client->getFolders();
				$data['folder']  = $client->getFolder($f);

				if (isset($folder)) {

					$messages = $data['folder']->messages()->all()->limit($limit, $page)->get();

					foreach ($messages as $m) {
						$data['mails'][] = $m;
					}

				}

			} catch (Exception $e) {

				return (view('mail.errors.403', $data));

			}

			return $data;

		}

	}

	function getFolders($folder)
	{

		$j = 0;

		if ($j === 0) {
			echo '<ol class="dd-list">';
		}

		for ($i = 0; $i < count($folder); $i++) {
			if (isset($folder[$i]->name) && isset($folder[$i]->path)) {
				echo '<li class="dd-item dd3-item" data-id-item="' . $folder[$i]->path . '">';
				echo '<div class="dd-handle dd3-handle"></div>';
				echo '<div class="dd3-content">';
				echo '<a href="' . route('mailbox.index', [Auth::id(), strtolower($folder[$i]->name)]) . '">' . $folder[$i]->path . '</a>';
				echo '</div>';
				echo '</li>';

				if (!empty($folder[$i]->children)) {
					getFolders($folder[$i]->children);
					$j++;
				}
			}
		}

		if ($j === 0) {
			echo '</ol>';
		}

	}

}

// if (!function_exists('get_files')) {
// function get_files(string $local, array $includes = [], string $html = null)
// }
// }

if (!function_exists('includes')) {

	// function includes(string $dir = null, array $array = []) {

	//     // if ( || empty($array)) {
	//     //     continue;
	//     // }

	//     $is_url = '/^http(s)?\:\/\/([\w]+)?/i';
	//     $path = null;
	//     $modulo = 'defaults';
	//     $mdir = null;
	//     $scripts = [];
	//     $files = [];

	//     if (!empty($dir) && preg_match('/[\w]\.[\w]/', $dir)) {

	//         $filePath = explode('.', $dir);

	//         if (count($filePath) > 1) {

	//             $modulo = $filePath[0];
	//             $mdir = $filePath[1];

	//         }

	//     }

	//     /**
	//      * Definir o script por ordem de prioridade
	//      * @var $script_file
	//      * @var $default_script_file
	//      * @var $path_file
	//      * @var $app_file
	//      */

	//     $config_file = resource_path('includes.php');

	//     if (!file_exists($config_file)) {
	//         return false;
	//     }

	//     $config = !empty($array) ? $array : include $config_file;

	//     // if (!in_array($modulo, array_keys($config))) {
	//     //     dump($modulo, $config);
	//     //     return null;
	//     // }

	//     if (!array_key_exists($modulo, $config)) {

	//         foreach ($config as $key => $val) {

	//             if (is_array($val)) {
	//                 $scripts[] = includes($dir, $val);
	//             } else {
	//                 $scripts[] = preg_match($is_url, $val) ? $val : asset($val);
	//             }

	//         }

	//     } else {

	//         foreach ($config[$modulo] as $key => $val) {

	//             if (!empty($val)) {

	//                 if (is_array($val)) {
	//                     $scripts[] = includes($dir, $val);
	//                 } else {
	//                     $scripts[] = preg_match($is_url, $val) ? $val : asset($val);
	//                 }

	//             }

	//         }

	//     }

	//     if (!empty($scripts)) {

	//         $link = null;

	//         foreach ($scripts as $script) {

	//             $ext = explode('.', $script);
	//             $ext = $ext[count($ext) - 1];

	//             if (!empty($script)) {
	//                 if ($ext === 'css') {
	//                     $files['styles'][] = '<link rel="stylesheet" media="screen" href="' . $script . '">';
	//                 } elseif ($ext === 'js') {
	//                     $files['scripts'][] = '<script defer src="' . $script . '"></script>';
	//                 }
	//             }

	//         }

	//     }

	//     $url = '';

	//     if (array_key_exists($mdir, $files)) {

	//         foreach ($files[$mdir] as $f) {
	//             echo $f;
	//         }

	//     }

	//     // dd($mdir, $files, array_key_exists($mdir, $files));

	// }

	function includes(string $dir = null, array $array = [])
	{

		$is_url  = '/^http(s)?\:\/\/([\w]+)?/i';
		$path    = null;
		$modulo  = 'defaults';
		$mdir    = null;
		$scripts = [];
		$files   = [];

		$pagina = explode('/', request()->url());
		$pagina = $pagina[count($pagina) - 1];

		/**
		 * Definir o script por ordem de prioridade
		 * @var $script_file
		 * @var $default_script_file
		 * @var $path_file
		 * @var $app_file
		 */

		$config_file = resource_path('includes.php');

		if (!file_exists($config_file)) {
			return false;
		}

		$config = !empty($array) ? $array : include $config_file;

		$get = Arr::get($config, $dir);

		if ($get) {

			foreach ($get as $g) {
				if (is_array($g)) {

					$scripts[] = includes($dir, $get);

				} else {

					$ext  = explode('.', $g);
					$ext  = $ext[count($ext) - 1];
					$file = preg_match($is_url, $g) ? $g : asset($g);

					if ($ext == 'css') {
						echo '<link rel="stylesheet" href="' . $file . '">
	';
					} else if ($ext == 'js') {
						echo '<script src="' . $file . '"></script>
';
					}

				}

			}

		}

		// if (!array_key_exists($modulo, $config)) {

		//     foreach ($config as $key => $val) {

		//         if (is_array($val)) {
		//             $scripts[] = includes($dir, $val);
		//         } else {
		//             $scripts[] = preg_match($is_url, $val) ? $val : asset($val);
		//         }

		//     }

		// } else {

		//     foreach ($config[$modulo] as $key => $val) {

		//         if (!empty($val)) {

		//             if (is_array($val)) {
		//                 $scripts[] = includes($dir, $val);
		//             } else {
		//                 $scripts[] = preg_match($is_url, $val) ? $val : asset($val);
		//             }

		//         }

		//     }

		// }

		// if (!empty($scripts)) {

		//     $link = null;

		//     foreach ($scripts as $script) {

		//         $ext = explode('.', $script);
		//         $ext = $ext[count($ext) - 1];

		//         if (!empty($script)) {
		//             if ($ext === 'css') {
		//                 $files['styles'][] = '<link rel="stylesheet" media="screen" href="' . $script . '">';
		//             } elseif ($ext === 'js') {
		//                 $files['scripts'][] = '<script defer src="' . $script . '"></script>';
		//             }
		//         }

		//     }

		// }

		// $url = '';

		// if (array_key_exists($mdir, $files)) {

		//     foreach ($files[$mdir] as $f) {
		//         echo $f;
		//     }

		// }

		// dd($mdir, $files, array_key_exists($mdir, $files));

	}

}

if (!function_exists('getCurrentPath')) {

	function getCurrentPath(string $path = null)
	{

		if (!is_null($path)) {
			return $path;
		}

		$route  = Route::currentRouteName();
		$modulo = new ModuloModel();

		$path = $modulo
			->select('path')
			->from('tb_acl_modulo AS M')
			->where('id', function ($query) use ($route) {
				$query
					->select('id_modulo')
					->from('tb_acl_modulo_controller AS C')
					->whereColumn('id_modulo', 'M.id')
					->where('C.id', function ($query) use ($route) {
						$query
							->select('id_controller')
							->distinct()
							->from('tb_acl_modulo_routes AS R')
							->whereColumn('R.id_controller', 'C.id')
							->where('name', $route);
					});
			})
			->first();

		if (!isset($path)) {
			return false;
		}

		if ($path->path === '/') {
			return 'main';
		}

		return limpa_string($path->path, '.');

	}

}

if (!function_exists('getThemeFiles')) {

	function getThemeFiles($extension = null, $path = null)
	{

		$route = !is_null($path) ? $path : Route::currentRouteName();

		$path = $modulo
			->select('path')
			->from('tb_acl_modulo AS M')
			->where('id', function ($query) use ($route) {
				$query
					->select('id_modulo')
					->from('tb_acl_modulo_controller AS C')
					->whereColumn('id_modulo', 'M.id')
					->where('C.id', function ($query) use ($route) {
						$query
							->select('id_controller')
							->distinct()
							->from('tb_acl_modulo_routes AS R')
							->whereColumn('R.id_controller', 'C.id')
							->where('name', $route);
					});
			})
			->first();

		$path     = $path->path;
		$includes = '';
		$resource = resource_path('_themes' . $path);

		if (is_dir($resource)) {

			$dir = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($resource));

			foreach ($dir as $i => $file) {

				if ($file->isDir()) {
					continue;
				}

				$f       = explode('_themes' . $path, $file);
				$ext     = $file->getExtension();
				$include = asset($path . $f[1]);

				if ($extension === 'css' && $ext === 'css') {
					print '<link rel="stylesheet" media="screen" href="' . $include . '">';
				} else if ($extension === 'js' && $ext === 'js') {
					print '<script src="' . $include . '"></script>';
				}

			}
		}

	}

}

if (!function_exists('hex2RGB')) {

	function hex2RGB($hexStr, $returnAsString = false, $seperator = ',')
	{
		$hexStr   = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
		$rgbArray = array();
		if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
			$colorVal          = hexdec($hexStr);
			$rgbArray['red']   = 0xFF&($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF&($colorVal >> 0x8);
			$rgbArray['blue']  = 0xFF &$colorVal;
		} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
			$rgbArray['red']   = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue']  = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		} else {
			return false; //Invalid hex color code
		}
		return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
	}

}

if (!function_exists('format')) {
	function format($value, $format = 'cpf')
	{

		// $lenght = 11;
		$value = preg_replace("/\D/", '', $value);
		switch ($format) {
			case 'cpf':
				return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $value);
				break;
			case 'cnpj':
				$length = 17;
				return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $value);
				break;
			case 'telefone':
				return preg_replace("/(\d{2})(\d{4})(\d{4})/", "(\$1) (\$2)\.(\$3/)", $value);
				break;
			case 'celular':
				if (preg_match('/^[55]/', $value)) {
					return preg_replace("/(\d{2})(\d{2})(\d{1})(\d{4})(\d{4})/", "($2) $3 $4.$5", $value);
				} else if (preg_match('/^[^55]/', $value)) {
					if (strlen($value) == 11) {
						if (preg_match('/^[^83]/', $value)) {
							return preg_replace("/(\d{2})(\d{1})(\d{4})(\d{4})/", "(\$1) \$2 \$3.$4", $value);
						}
						return preg_replace("/(\d{2})(\d{1})(\d{4})(\d{4})/", "($1) $2 $3.$4", $value);
					} else {
						if (strlen($value) < 11) {
							if (preg_match('/^[^83]/', $value)) {
								return preg_replace("/(\d{1})(\d{4})(\d{4})/", "\$1 \$2.\$3", $value);
							}
						}
						return preg_replace("/(\d{2})(\d{4})(\d{4})/", "($1) $2.$3", $value);
					}
				}
				break;
		}

	}
}
