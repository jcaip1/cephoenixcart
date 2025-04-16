<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class cm_header_breadcrumb extends abstract_executable_module {

    const CONFIG_KEY_BASE = 'MODULE_CONTENT_HEADER_BREADCRUMB_';

    public function __construct() {
      parent::__construct(__FILE__);
    }

    public function execute() {
      global $breadcrumb, $cPath_array, $category_tree, $brand, $Linker;

      // add the products model to the breadcrumb trail
      if (isset($_GET['products_id'])) {
        $model_sql = "SELECT COALESCE(";
        if ( 'True' === $this->base_constant('PRODUCT_SEO_OVERRIDE') ) {
          $model_sql .= "NULLIF(pd.products_seo_title, ''), ";
        }
        $model_sql .= <<<'EOSQL'
NULLIF(p.products_model, ''), pd.products_name) AS products_model
 FROM products p INNER JOIN products_description pd ON p.products_id = pd.products_id
 WHERE p.products_id = %d AND pd.language_id = %d
EOSQL;

        $model_query = $GLOBALS['db']->query(sprintf($model_sql, (int)$_GET['products_id'], (int)$_SESSION['languages_id']));
        if ($model = $model_query->fetch_assoc()) {
          $breadcrumb->prepend($model['products_model'], $Linker->build('product_info.php', ['products_id' => (int)$_GET['products_id']]));
        }
      }

      // add category names or the manufacturer name to the breadcrumb trail
      if (isset($cPath_array)) {
        $categories = $cPath_array;
        while (count($categories) > 0) {
          $cPath = implode('_', $categories);
          $category_id = array_pop($categories);
          if ( ( 'True' !== $this->base_constant('CATEGORY_SEO_OVERRIDE') )
            || Text::is_empty($breadcrumb_category = $category_tree->get($category_id, 'seo_title')) )
          {
            $breadcrumb_category = $category_tree->get($category_id, 'name');
          }

          $breadcrumb->prepend($breadcrumb_category, $Linker->build('index.php', ['cPath' => $cPath]));
        }
      } elseif (!empty($_GET['manufacturers_id'])) {
        if ( ( 'True' !== $this->base_constant('MANUFACTURER_SEO_OVERRIDE') ) || Text::is_empty($breadcrumb_brand = $brand->getData('manufacturers_seo_title'))) {
          $breadcrumb_brand = $brand->getData('manufacturers_name');
        }

        $breadcrumb->prepend($breadcrumb_brand, $Linker->build('index.php', ['manufacturers_id' => (int)$_GET['manufacturers_id']]));
      }

      foreach (array_reverse(MODULE_CONTENT_HEADER_BREADCRUMB_TITLES) as $text => $page) {
        if (is_string($page) && (strlen($page) > 0)) {
          $link = $Linker->build($page);
        } else {
          $link = HTTP_SERVER;
        }

        $breadcrumb->prepend($text, $link);
      }

      if (('Schema' === $this->base_constant('LOCATION')) || ('Both' === $this->base_constant('LOCATION'))) {
        $schema_breadcrumb = [
          '@context' => 'https://schema.org',
          '@type' => 'BreadcrumbList',
          'itemListElement' => [],
        ];

        foreach ($breadcrumb->_trail as $i => $v) {
          $schema_breadcrumb['itemListElement'][] = [
            '@type' => 'ListItem',
            'position' => "$i",
            'item' => [
              '@id' => "{$v['link']}",
              'name' => strip_tags($v['title'] ?? ''),
            ],
          ];
        }

        $data = json_encode($schema_breadcrumb);
        $GLOBALS['Template']->add_block('<script type="application/ld+json">' . $data . '</script>', 'footer_scripts');
      }

      if (('Header' === $this->base_constant('LOCATION')) || ('Both' === $this->base_constant('LOCATION'))) {
        $tpl_data = [ 'group' => $this->group, 'file' => __FILE__ ];
        include 'includes/modules/content/cm_template.php';
      }
    }

    protected function get_parameters() {
      return [
        $this->config_key_base . 'STATUS' => [
          'title' => 'Enable Module',
          'value' => 'True',
          'desc' => 'Do you want to enable this module?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        $this->config_key_base . 'CONTENT_WIDTH' => [
          'title' => 'Content Container',
          'value' => 'col-sm-12',
          'desc' => 'What container should the content be shown in? (col-*-12 = full width, col-*-6 = half width).',
        ],
        $this->config_key_base . 'SORT_ORDER' => [
          'title' => 'Sort Order',
          'value' => '0',
          'desc' => 'Sort order of display. Lowest is displayed first.',
        ],
        $this->config_key_base . 'LOCATION' => [
          'title' => 'Location',
          'value' => 'Both',
          'desc' => 'Where you want the breadcrumb to be used.  Display in the Header, post as Schema entries, or Both.',
          'set_func' => "Config::select_one(['Header', 'Schema', 'Both'], ",
        ],
        $this->config_key_base . 'PRODUCT_SEO_OVERRIDE' => [
          'title' => 'Product SEO Override?',
          'value' => 'True',
          'desc' => 'Do you want to allow product names in the breadcrumb to be over-ridden by your SEO Titles (if set)?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        $this->config_key_base . 'MANUFACTURER_SEO_OVERRIDE' => [
          'title' => 'Manufacturer SEO Override?',
          'value' => 'True',
          'desc' => 'Do you want to allow manufacturer names in the breadcrumb to be over-ridden by your SEO Titles (if set)?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
        $this->config_key_base . 'CATEGORY_SEO_OVERRIDE' => [
          'title' => 'SEO Breadcrumb Override?',
          'value' => 'True',
          'desc' => 'Do you want to allow category names in the breadcrumb to be over-ridden by your SEO Titles (if set)?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
      ];
    }

  }

