<?php

use App\Models\Model;

if (!function_exists('lang')) {

	function lang($return_id = false)
	{

		$sigla = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : config('site.language');

		if (!$return_id) {
			return $sigla;
		}

		$model = new Model();
		$model->setConnection(env('DB_SYSTEM_CONNECTION'));

		$id = $model->select('id')
			->from('tb_sys_idioma')
			->where('sigla', $sigla)
			->get()
			->first();

		return $id->id ?? $sigla;

	}

}

if (!function_exists('getMenu')) {

	function getMenu($local, $id = null, $path = null)
	{

		$model = new Model();
		$model->setConnection(env('DB_SYSTEM_CONNECTION'));

		$menu_list = [];
		$modulo    = explode('/', request()->path());
		$path      = '/' . (is_string($path) ? $path : $modulo[0]);

		$modulo = $model->select('id')
			->from('tb_acl_modulo')
			->where('path', $path)
			->get()
			->first();

		if (isset($modulo)) {
			$idModulo = $modulo->id;
		}

		$menus = $model->select(
			'Menu.id',
			'Menu.status',
			DB::raw('(SELECT titulo FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = "' . lang(true) . '") AS titulo'),
			DB::raw('(SELECT descricao FROM tb_acl_menu_descricao WHERE id_menu = Menu.id AND id_idioma = "' . lang(true) . '") AS descricao'),
		)
			->from('tb_acl_menu AS Menu')
			->join('tb_acl_modulo_grupo_menu AS MG_Menu', 'MG_Menu.id_menu', 'Menu.id')
			->whereIn('MG_Menu.id_modulo_grupo', function ($query) use ($idModulo, $modulo, $path) {

				$query = $query->select('id')
					->from('tb_acl_modulo_grupo')
					->whereColumn('id_modulo_grupo', 'id')
					->where('id_modulo', $idModulo);

				// If Is Restrict Modulo

			})
			->whereColumn('MG_Menu.id_menu', 'Menu.id')
			->where('Menu.status', '1')
			->where('MG_Menu.status', '1')
			->get();

		if ($menus->count() > 0) {

			foreach ($menus as $menu) {

				$items = $model->select(
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
					->whereIn('Item.id', function ($query) use ($menu, $path, $idModulo, $model) {

						$query->select('I.id_item')
							->from('tb_acl_menu_item_menu AS I')
							->whereColumn('I.id_item', 'Item.id')
							->where('I.status', '1')
						// ->where('I.id_menu', $menu->id)
							->whereIn('I.id_menu', function ($query) use ($menu, $path, $idModulo, $model) {

								$query->select('id_menu')
									->from('tb_acl_modulo_grupo_menu AS G')
									->whereColumn('G.id_menu', 'I.id_menu')
									->where('G.id_menu', $menu->id)
									->where('id_modulo_grupo', function ($query) use ($menu, $path, $idModulo) {

										$query = $query->select('id')
											->from('tb_acl_modulo_grupo')
											->whereColumn('id', 'id_modulo_grupo')
											->where('id_modulo', $idModulo);

										// If Is Restrict Modulo

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

						if (!is_null($item->item_type)) {

							$menu_list[$menu->id][] = [
								'id'       => $item->id,
								'titulo'   => $item->item_type,
								'category' => true,
							];

						}

						$route = $model->select('name')
							->from('tb_acl_modulo_routes')
							->where('id_controller', $item->id_controller)
							->where('status', '1')
							->where('type', 'any')
							->where(function ($query) {

								$query->where('id_parent', null)
									->orWhere('id_parent', '0');

							});

						if ($item->id_route) {
							$route->where('id', $id_route);
						}

						$route = $route->first();

						$menu_list[$menu->id][$item->id] = [
							'id'            => $item->id,
							'id_parent'     => $item->id_parent,
							'id_controller' => $item->controller,
							'id_route'      => $item->id_route,
							'route'         => $route->name,
							'icon'          => $item->icon,
							'divider'       => $item->divider,
							'item_type'     => $item->item_type,
							'titulo'        => $item->titulo,
							'descricao'     => $item->descricao,
							'category'      => false,
							'children'      => [],
						];

						$submenus = $model->from('tb_acl_menu_item')
							->where('id_parent', $item->id)
							->where('status', '1')
							->whereIn('id', function ($query) use ($menu) {

								$query->select('id_item')
									->from('tb_acl_menu_item_menu')
									->whereColumn('id_item', 'id')
									->where('status', '1')
									->where('id_menu', $menu->id);

							})->get();

						if ($submenus->count() > 0) {
							$menu_list[$menu->id][$item->id]['children'] = getMenu($local, $item->id);
						}

					}

				}
			}

		}

		return $menu_list;

	}

}

if (!function_exists('make_menu')) {

	function make_menu($local, $path = null, $id = null)
	{

		if (!empty($attributes)) {
			foreach ($attributes as $ind => $val) {
				$params .= ' ' . $ind . '="' . $val . '"';
			}
		}

		$ul = [];

		$items = getMenu($local, $id, $path);

		if (count($items) > 0) {

			foreach ($items as $ind => $menus) {

				$ul[$ind] = $menus;

			}

			return view('navigation', ['ul' => $ul]);

		}

	}

}
