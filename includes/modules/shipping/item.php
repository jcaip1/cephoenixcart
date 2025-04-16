<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class item extends abstract_shipping_module {

    const CONFIG_KEY_BASE = 'MODULE_SHIPPING_ITEM_';

// class methods
    public function quote($method = '') {
      $this->quotes = [
        'id' => $this->code,
        'module' => MODULE_SHIPPING_ITEM_TEXT_TITLE,
        'methods' => [[
          'id' => $this->code,
          'title' => MODULE_SHIPPING_ITEM_TEXT_WAY,
          'cost' => ((float)$this->base_constant('COST') * $this->count_items()) + $this->calculate_handling(),
        ]],
      ];

      $this->quote_common();

      return $this->quotes;
    }

    protected function get_parameters() {
      return [
        $this->config_key_base . 'STATUS' => [
          'title' => 'Enable Item Shipping',
          'value' => 'True',
          'desc' => 'Do you want to offer per item rate shipping?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        $this->config_key_base . 'COST' => [
          'title' => 'Shipping Cost',
          'value' => '2.50',
          'desc' => 'The shipping cost will be multiplied by the number of items in an order that uses this shipping method.',
        ],
        $this->config_key_base . 'HANDLING' => [
          'title' => 'Handling Fee',
          'value' => '0',
          'desc' => 'Handling fee for this shipping method.',
        ],
        $this->config_key_base . 'TAX_CLASS' => [
          'title' => 'Tax Class',
          'value' => '0',
          'desc' => 'Use the following tax class on the shipping fee.',
          'use_func' => 'Tax::get_class_title',
          'set_func' => 'Config::select_tax_class(',
        ],
        $this->config_key_base . 'ZONE' => [
          'title' => 'Shipping Zone',
          'value' => '0',
          'desc' => 'If a zone is selected, only enable this shipping method for that zone.',
          'use_func' => 'geo_zone::fetch_name',
          'set_func' => 'Config::select_geo_zone(',
        ],
        $this->config_key_base . 'SORT_ORDER' => [
          'title' => 'Sort Order',
          'value' => '0',
          'desc' => 'Sort order of display.',
        ],
      ];
    }

    protected function count_items() {
      global $order;

      $item_count = ('physical' === $order->content_type)
                  ? ($GLOBALS['total_count'] ?? $_SESSION['cart']->count_contents())
                  : 0;

      if ('mixed' === $order->content_type) {
        foreach ($order->products as $product) {
          foreach (($product['attributes'] ?? []) as $option => $value) {
            $virtual_check = $GLOBALS['db']->query(sprintf(<<<'EOSQL'
SELECT COUNT(*) AS total
 FROM products_attributes pa INNER JOIN products_attributes_download pad
   ON pa.products_attributes_id = pad.products_attributes_id
 WHERE pa.products_id = %d AND pa.options_values_id = %d
EOSQL
              , (int)$product['id'], (int)$value['value_id']))->fetch_assoc();

            if ($virtual_check['total'] > 0) {
              // if any attribute is downloadable, the product is virtual
              // and doesn't count; so skip to the next product
              // without adding the product quantity
              continue 2;
            }
          }

          $item_count += $product['qty'];
        }
      }

      return $item_count;
    }

  }
