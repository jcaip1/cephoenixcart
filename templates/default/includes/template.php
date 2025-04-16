<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class default_template {

    protected $_grid_content_width = BOOTSTRAP_CONTENT;

    protected $_base_hook_directories = [
      DIR_FS_CATALOG . 'templates/default/includes/hooks/',
    ];

    protected $_base_override_directories = [
      DIR_FS_CATALOG . 'templates/default/includes/override/',
    ];

    protected $_template_mapping = [
    ];

    public function __construct() {
      $hooks =& Guarantor::ensure_global('hooks', 'shop');
      foreach ($this->_base_hook_directories as $directory) {
        if (file_exists($directory) && is_dir($directory)) {
          $hooks->add_directory($directory);
          $GLOBALS['class_index']->find_all_hooks_under($directory);
        }
      }

      foreach ($this->_base_override_directories as $directory) {
        if (file_exists($directory) && is_dir($directory)) {
          $GLOBALS['class_index']->find_all_files_under($directory);
        }
      }

      $GLOBALS['breadcrumb'] = new breadcrumb();
    }

    public static function extract_relative_path($file, $base_path = DIR_FS_CATALOG) {
      if ('/' !== DIRECTORY_SEPARATOR) {
        $file = str_replace(DIRECTORY_SEPARATOR, '/', $file);
      }

      return Text::ltrim_once($file, $base_path);
    }

    public static function _get_template_mapping_for($file, $type) {
      switch ($type) {
        case 'page':
          return DIR_FS_CATALOG . 'templates/default/includes/pages/' . basename($file);
        case 'component':
          return DIR_FS_CATALOG . 'templates/default/includes/components/' . basename($file);
        case 'module':
          return dirname($file) . '/templates/tpl_' . basename($file);
        case 'ext':
          $file = static::extract_relative_path($file);
          return DIR_FS_CATALOG . "templates/default/includes/$file";
        case 'translation':
          return DIR_FS_CATALOG . $file;
        case 'literal':
        default:
          return DIR_FS_CATALOG . "templates/default/$file";
      }
    }

    public function get_template_mapping_for($file, $type) {
      $template_file = $this->_template_mapping[$file]
                    ?? static::_get_template_mapping_for($file, $type);

      return file_exists($template_file) ? $template_file : null;
    }

    public function setGridContentWidth($width) {
      $this->_grid_content_width = $width;
    }

    public function getGridContentWidth() {
      return $this->_grid_content_width;
    }

    public function getGridColumnWidth() {
      return (12 - BOOTSTRAP_CONTENT) / 2;
    }

  }
