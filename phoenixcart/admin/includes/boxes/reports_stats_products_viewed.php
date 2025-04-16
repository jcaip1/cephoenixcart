<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  foreach ( $cl_box_groups as &$group ) {
    if ( $group['heading'] == BOX_HEADING_REPORTS ) {
      $group['apps'][] = [
        'code' => 'stats_products_viewed.php',
        'title' => MODULES_ADMIN_MENU_REPORTS_PRODUCTS_VIEWED,
        'link' => $GLOBALS['Admin']->link('stats_products_viewed.php'),
      ];

      break;
    }
  }
