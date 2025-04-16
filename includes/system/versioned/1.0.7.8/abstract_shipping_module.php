<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  abstract class abstract_shipping_module extends abstract_zoneable_module {

    public $tax_class;
    protected $icon = '';
    public $quotes;
    protected $country;

    public function __construct() {
      parent::__construct();

      $this->tax_class = $this->base_constant('TAX_CLASS') ?? 0;
    }

    public function update_status() {
      if ($this->enabled && isset($GLOBALS['order']->delivery['country']['id'])) {
        $this->update_status_by($GLOBALS['order']->delivery);
      }
    }

    public function quote_common() {
      global $order;

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = Tax::get_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (!Text::is_empty($this->icon) && ('True' === ($this->base_constant('DISPLAY_ICON') ?? 'True'))) {
        $this->quotes['icon'] = new Image($this->icon, [], htmlspecialchars($this->title));
      }
    }

    public function calculate_handling() {
      return (float)($this->base_constant('HANDLING') ?? 0);
    }

  }

