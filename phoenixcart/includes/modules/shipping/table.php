<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class table extends abstract_shipping_module {

    const CONFIG_KEY_BASE = 'MODULE_SHIPPING_TABLE_';

// class methods
    public function quote($method = '') {
      switch ($this->base_constant('MODE') ) {
        case 'price':
          $order_total = $this->get_shippable_total();
          break;
        case 'weight':
          $order_total = $GLOBALS['shipping_weight'];
          break;
        case 'quantity':
          $order_total = $this->count_items();
          break;
      }

      $table_cost = preg_split("/[:,]/" , $this->base_constant('COST'));
      for ($i = 0, $n = count($table_cost); $i < $n; $i += 2) {
        if ($order_total <= $table_cost[$i]) {
          $shipping = (float)$table_cost[$i+1];
          break;
        }
      }

      if ('weight' === $this->base_constant('MODE')) {
        $shipping *= $GLOBALS['shipping_num_boxes'];
      }

      $this->quotes = [
        'id' => $this->code,
        'module' => MODULE_SHIPPING_TABLE_TEXT_TITLE,
        'methods' => [[
          'id' => $this->code,
          'title' => MODULE_SHIPPING_TABLE_TEXT_WAY,
          'cost' => $shipping + (float)$this->calculate_handling(),
        ]],
      ];

      $this->quote_common();

      return $this->quotes;
    }

    protected function get_parameters() {
      return [
        $this->config_key_base . 'STATUS' => [
          'title' => 'Enable Table Method',
          'value' => 'True',
          'desc' => 'Do you want to offer table rate shipping?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        $this->config_key_base . 'COST' => [
          'title' => 'Shipping Table',
          'value' => '25:8.50,50:5.50,10000:0.00',
          'desc' => 'The shipping cost is based on the total cost or weight of items. Example: 25:8.50,50:5.50,etc.. Up to 25 charge 8.50, from there to 50 charge 5.50, etc',
        ],
        $this->config_key_base . 'MODE' => [
          'title' => 'Table Method',
          'value' => 'weight',
          'desc' => 'The shipping cost is based on the order total or the total weight of the items ordered.',
          'set_func' => "Config::select_one(['weight', 'price', 'quantity'], ",
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

    protected function get_shippable_total() {
      global $order, $currencies;

      $order_total = (('physical' === $order->content_type) ? $_SESSION['cart']->show_total() : 0);

      if ('mixed' === $order->content_type) {
        foreach ($order->products as $product) {
          foreach (($product['attributes'] ?? []) as $option => $value) {
            $virtual_check = $GLOBALS['db']->query(sprintf(<<<'EOSQL'
SELECT COUNT(*) AS total
  FROM products_attributes pa
    INNER JOIN products_attributes_download pad
      ON pa.products_attributes_id = pad.products_attributes_id
  WHERE pa.products_id = %d AND pa.options_values_id = %d
EOSQL
              , (int)$product['id'], (int)$value['value_id']))->fetch_assoc();

            if ($virtual_check['total'] > 0) {
              // if any attribute is downloadable, the product is virtual
              // and doesn't count; so skip to the next product
              // without adding the line total
              continue 2;
            }
          }

          $order_total += $currencies->calculate_price($product['final_price'], $product['tax'], $product['qty']);
        }
      }

      return $order_total;
    }

    function count_items() {
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
