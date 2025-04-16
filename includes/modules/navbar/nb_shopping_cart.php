<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class nb_shopping_cart extends abstract_block_module {

    const CONFIG_KEY_BASE = 'MODULE_NAVBAR_SHOPPING_CART_';

    public $group = 'navbar_modules_right';

    function getOutput() {
      $tpl_data = ['group' => $this->group, 'file' => __FILE__];
      include 'includes/modules/block_template.php';
    }

    protected function get_parameters() {
      return [
        'MODULE_NAVBAR_SHOPPING_CART_STATUS' => [
          'title' => 'Enable Module',
          'value' => 'True',
          'desc' => 'Do you want to add the module to your Navbar?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        'MODULE_NAVBAR_SHOPPING_CART_CONTENT_PLACEMENT' => [
          'title' => 'Content Placement Group',
          'value' => 'Right',
          'desc' => 'Where should the module be loaded?  Lowest is loaded first, per Group.',
          'set_func' => "Config::select_one(['Home', 'Left', 'Center', 'Right'], ",
        ],
        'MODULE_NAVBAR_SHOPPING_CART_SORT_ORDER' => [
          'title' => 'Sort Order',
          'value' => '550',
          'desc' => 'Sort order of display. Lowest is displayed first.',
        ],
      ];
    }

  }
