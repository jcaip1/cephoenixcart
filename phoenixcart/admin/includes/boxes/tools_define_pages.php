<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  foreach ( $cl_box_groups as &$group ) {
    if ( $group['heading'] == BOX_HEADING_TOOLS ) {
      $group['apps'][] = [
        'code' => 'info_pages.php',
        'title' => MODULES_ADMIN_MENU_TOOLS_DEFINE_PAGES,
        'link' => $GLOBALS['Admin']->link('info_pages.php'),
      ];

      break;
    }
  }
