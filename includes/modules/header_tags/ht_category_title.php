<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class ht_category_title extends abstract_executable_module {

    const CONFIG_KEY_BASE = 'MODULE_HEADER_TAGS_CATEGORY_TITLE_';

    public function __construct() {
      parent::__construct(__FILE__);
    }

    public function execute() {
      global $current_category_id, $category_tree;

      if ( ($current_category_id > 0) && ('index.php' === basename(Request::get_page())) ) {
        if ( (MODULE_HEADER_TAGS_CATEGORY_TITLE_SEO_TITLE_OVERRIDE !== 'True')
          || Text::is_empty($category_title =  $category_tree->get($current_category_id, 'seo_title')) )
        {
          $category_title = $category_tree->get($current_category_id, 'name');
        }

        $GLOBALS['Template']->set_title(
          $category_title
          . MODULE_HEADER_TAGS_CATEGORY_SEO_SEPARATOR
          . $GLOBALS['Template']->get_title());
      }
    }

    protected function get_parameters() {
      return [
        $this->config_key_base . 'STATUS' => [
          'title' => 'Enable Category Title Module',
          'value' => 'True',
          'desc' => 'Do you want to allow category titles to be added to the page title?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        $this->config_key_base . 'SORT_ORDER' => [
          'title' => 'Sort Order',
          'value' => '0',
          'desc' => 'Sort order of display. Lowest is displayed first.',
        ],
        $this->config_key_base . 'SEO_TITLE_OVERRIDE' => [
          'title' => 'SEO Title Override?',
          'value' => 'True',
          'desc' => 'Do you want to allow category titles to be over-ridden by your SEO Titles (if set)?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
      ];
    }

  }
