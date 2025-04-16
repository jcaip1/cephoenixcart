<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  abstract class abstract_payment_module extends abstract_zoneable_module {

    public $public_title;
    public $order_status;

    function __construct() {
      parent::__construct();

      $this->public_title = self::get_constant(static::CONFIG_KEY_BASE . 'TEXT_PUBLIC_TITLE')
                         ?? self::get_constant(static::CONFIG_KEY_BASE . 'PUBLIC_TITLE');

      $this->order_status = (int)($this->base_constant('ORDER_STATUS_ID') ?? 0);
      $this->order_status = ($this->order_status > 0) ? $this->order_status : 0;
    }

    public function update_status() {
      if ($this->enabled && isset($GLOBALS['order']->billing['country']['id'])) {
        $this->update_status_by($GLOBALS['order']->billing);
      }
    }

    public function javascript_validation() {
      return false;
    }

    public function selection() {
      return [
        'id' => $this->code,
        'module' => $this->public_title ?? $this->title,
      ];
    }

    public function pre_confirmation_check() {
      return false;
    }

    public function confirmation() {
      return false;
    }

    public function process_button() {
      return false;
    }

    public function before_process() {
      return false;
    }

    public function after_process() {
      return false;
    }

    public function get_error() {
      return false;
    }

    public static function ensure_order_status($constant_name, $order_status_name, $public_flag = 0, $downloads_flag = 0) {
      if (defined($constant_name)) {
        return constant($constant_name);
      }

      $check_sql = "SELECT orders_status_id FROM orders_status WHERE orders_status_name = '" . $GLOBALS['db']->escape($order_status_name) . "' LIMIT 1";
      $check_query = $GLOBALS['db']->query($check_sql);

      if (mysqli_num_rows($check_query) < 1) {
        $next_id = $GLOBALS['db']->query("SELECT MAX(orders_status_id) + 1 AS next_id FROM orders_status")->fetch_assoc()['next_id'] ?? 1;

        $GLOBALS['db']->query(sprintf(<<<'EOSQL'
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag)
 SELECT
   %d AS orders_status_id,
   l.languages_id AS language_id,
   '%s' AS orders_status_name,
   %d AS public_flag,
   %d AS downloads_flag
 FROM languages l
 ORDER BY l.sort_order
EOSQL
          , (int)$next_id, $GLOBALS['db']->escape($order_status_name), (int)$public_flag, (int)$downloads_flag));

        $check_query = $GLOBALS['db']->query($check_sql);
      }

      $check = $check_query->fetch_assoc();
      return $check['orders_status_id'];
    }

  }
