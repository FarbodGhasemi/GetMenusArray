<?php
//Get Menus Array
	function getMenus($location) {
		// Get Navigation by Location
		$locations = get_nav_menu_locations();
		// Fetch menu by id
		$menu = wp_get_nav_menu_object($locations[$location]);

		$menus = wp_get_nav_menu_items($menu->term_id);

		$items = [];

		if ($menus) {
			// loop on all navigation items
			foreach (wp_get_nav_menu_items($menu->term_id) as $item) {

				$result = [
					'ID' => $item->ID,
					'title' => $item->title,
					'type' => $item->type,
					'url' => $item->url,
					'class' => array_shift($item->classes),
					'description' => $item->description,
					'childs' => [],
				];

				if ($item->menu_item_parent == 0) {
					$items[$item->ID] = $result;
				} else {
					$items[$item->menu_item_parent]['childs'][$item->ID] = $result;
				}
			}
		}

		return $items;
	}
