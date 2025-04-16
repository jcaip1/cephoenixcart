<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class cd_date_account_created extends abstract_customer_data_module {

    const CONFIG_KEY_BASE = 'MODULE_CUSTOMER_DATA_DATE_ACCOUNT_CREATED_';

    const PROVIDES = [
      'date_account_created',
      'date_account_last_modified',
      'date_last_logon',
      'number_of_logons',
    ];
    const REQUIRES = [  ];

    protected function get_parameters() {
      return [
        static::CONFIG_KEY_BASE . 'STATUS' => [
          'title' => 'Enable Date Account Created module',
          'value' => 'True',
          'desc' => 'Do you want to add the module to your shop?',
          'set_func' => "Config::select_option(['True', 'False'], ",
        ],
      ];
    }

    public function get($field, &$customer_details) {
      switch ($field) {
        case 'date_account_created':
          if (!isset($customer_details[$field])) {
            $customer_details[$field] = $customer_details['date_account_created']
              ?? $customer_details['customers_info_date_account_created'] ?? null;
          }

          return $customer_details[$field];
        case 'last_modified':
        case 'date_account_last_modified':
          if (!isset($customer_details[$field])) {
            $customer_details[$field] = $customer_details['date_account_last_modified']
              ?? $customer_details['customers_info_date_account_last_modified'] ?? null;
          }

          return $customer_details[$field];
        case 'date_last_logon':
          if (!isset($customer_details[$field])) {
            $customer_details[$field] = $customer_details['date_last_logon']
              ?? $customer_details['customers_info_date_of_last_logon'] ?? null;
          }

          return $customer_details[$field];
        case 'number_of_logons':
          if (!isset($customer_details[$field])) {
            $customer_details[$field] = $customer_details['number_of_logons']
              ?? $customer_details['customers_info_number_of_logons'] ?? null;
          }

          return $customer_details[$field];
      }
    }

    public function build_db_aliases(&$db_tables, $table = 'both') {
      Guarantor::guarantee_subarray($db_tables, 'customers_info');
      $db_tables['customers_info']['customers_info_date_account_created'] = 'date_account_created';
      $db_tables['customers_info']['customers_info_date_account_last_modified'] = 'date_account_last_modified';
      $db_tables['customers_info']['customers_info_date_of_last_logon'] = 'date_last_logon';
      $db_tables['customers_info']['customers_info_number_of_logons'] = 'number_of_logons';
    }

    public function add_order_by(&$columns, $criterion, $direction) {
      Guarantor::guarantee_subarray($columns, 'customers_info');
      $columns['customers_info']['customers_info_date_account_created'] = $direction;
    }

  }
