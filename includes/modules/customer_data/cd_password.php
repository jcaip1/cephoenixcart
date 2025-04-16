<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class cd_password extends abstract_customer_data_module {

    const CONFIG_KEY_BASE = 'MODULE_CUSTOMER_DATA_PASSWORD_';

    const PROVIDES = [ 'password' ];
    const REQUIRES = [  ];

    protected function get_parameters() {
      return [
        static::CONFIG_KEY_BASE . 'STATUS' => [
          'title' => 'Enable Password module',
          'value' => 'True',
          'desc' => 'Do you want to add the module to your shop?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        static::CONFIG_KEY_BASE . 'GROUP' => [
          'title' => 'Customer data group',
          'value' => '6',
          'desc' => 'In what group should this appear?',
          'use_func' => 'customer_data_group::fetch_name',
          'set_func' => 'Config::select_customer_data_group(',
        ],
        static::CONFIG_KEY_BASE . 'REQUIRED' => [
          'title' => 'Require Password module (if enabled)',
          'value' => 'True',
          'desc' => 'Do you want the password to be required in customer registration?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        static::CONFIG_KEY_BASE . 'MIN_LENGTH' => [
          'title' => 'Minimum Length',
          'value' => '5',
          'desc' => 'Minimum length of password',
        ],
        static::CONFIG_KEY_BASE . 'PAGES' => [
          'title' => 'Pages',
          'value' => 'account_password;create_account;customers',
          'desc' => 'On what pages should this appear?',
          'set_func' => 'Customers::select_pages(',
          'use_func' => 'abstract_module::list_exploded',
        ],
        static::CONFIG_KEY_BASE . 'SORT_ORDER' => [
          'title' => 'Sort Order',
          'value' => '6200',
          'desc' => 'Sort order of display. Lowest is displayed first.',
        ],
        static::CONFIG_KEY_BASE . 'TEMPLATE' => [
          'title' => 'Template',
          'value' => 'includes/modules/customer_data/cd_whole_row_input.php',
          'desc' => 'What template should be used to surround this input?',
        ],
      ];
    }

    public function get($field, &$customer_details) {
      switch ($field) {
        case 'password':
          if (!isset($customer_details[$field])) {
            $customer_details[$field] = $customer_details['password']
              ?? $customer_details['customers_password'] ?? null;
          }
          return $customer_details[$field];
      }
    }

    public function display_input($customer_details = null, $entry_base = 'ENTRY_PASSWORD') {
      $label_text = constant($entry_base);

      $input_id = 'inputPassword';
      
      $placeholder = '';
      if (defined($entry_base . '_TEXT') && !Text::is_empty(constant($entry_base . '_TEXT'))) {
        $placeholder = constant($entry_base . '_TEXT');
      }      
      
      $attributes = [
        'id' => $input_id,
        'autocapitalize' => 'none',
        'autocomplete' => isset($customer_details['password'])
                        ? 'current-password'
                        : 'new-password',
        'placeholder' => $placeholder,
        'minlength' => $this->base_constant('MIN_LENGTH'),
      ];      

      $input = new Input('password', $attributes, 'password');

      if ($this->is_required()) {
        $input->require();
        $input .= FORM_REQUIRED_INPUT;
      }

      include Guarantor::ensure_global('Template')->map($this->base_constant('TEMPLATE'));
    }

    public function process(&$customer_details, $entry_base = 'ENTRY_PASSWORD') {
      $customer_details['password'] = Text::input($_POST['password']);

      if (strlen($customer_details['password']) < $this->base_constant('MIN_LENGTH')
        && ($this->is_required()
          || !empty($customer_details['password'])
          )
        )
      {
        $GLOBALS['messageStack']->add_classed(
          $GLOBALS['message_stack_area'] ?? 'customer_data',
          sprintf(constant($entry_base . '_ERROR'), $this->base_constant('MIN_LENGTH')));

        return false;
      }

      return true;
    }

    public function build_db_values(&$db_tables, $customer_details, $table = 'both') {
      if (empty($customer_details['password'])) {
        return;
      }

      Guarantor::guarantee_subarray($db_tables, 'customers');
      $db_tables['customers']['customers_password'] = Password::hash($customer_details['password']);
    }

    public function build_db_aliases(&$db_tables, $table = 'both') {
      Guarantor::guarantee_subarray($db_tables, 'customers');
      $db_tables['customers']['customers_password'] = 'password';
    }

  }
