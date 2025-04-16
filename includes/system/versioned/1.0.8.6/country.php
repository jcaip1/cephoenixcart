<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class Country {

    protected static $countries;

    public static function fetch($country_id) {
      $countries = $GLOBALS['db']->query("SELECT countries_name, countries_iso_code_2, countries_iso_code_3 FROM countries WHERE countries_id = " . (int)$country_id . " ORDER BY countries_name");
      $countries_values = $countries->fetch_assoc();
      return [
        'countries_name' => $countries_values['countries_name'],
        'countries_iso_code_2' => $countries_values['countries_iso_code_2'],
        'countries_iso_code_3' => $countries_values['countries_iso_code_3'],
      ];
    }

    public static function fetch_name($country_id) {
      if (!empty(static::$countries)) {
        $country_name = array_column(static::$countries, 'countries_name', 'countries_id')[$country_id] ?? null;
        if ($country_name) {
          return $country_name;
        }
      }

      $countries_query = $GLOBALS['db']->query("SELECT countries_name FROM countries WHERE countries_id = " . (int)$country_id);
      $country = $countries_query->fetch_assoc();
      return $country['countries_name'];
    }

    public static function fetch_all() {
      if (empty(static::$countries)) {
        static::$countries = $GLOBALS['db']->fetch_all("SELECT countries_id, countries_name FROM countries WHERE status = 1 ORDER BY countries_name");
      }

      return static::$countries;
    }

    public static function fetch_options() {
      return $GLOBALS['db']->fetch_all("SELECT countries_id AS id, countries_name AS text FROM countries WHERE status = 1 ORDER BY countries_name");
    }

    public static function draw_menu($name, $selected = '', $parameters = [], $default = PULL_DOWN_DEFAULT) {
      $countries = static::fetch_options();
      if ($default) {
        $countries = array_merge(
          [['id' => '', 'text' => $default]],
          $countries);
      }

      return (new Select($name, $countries, $parameters))->set_selection($selected);
    }

    public static function match_classification($classification, $country_id) {
      switch ($classification) {
        case 'national':
          return STORE_COUNTRY == $country_id;
        case 'international':
          return STORE_COUNTRY != $country_id;
        case 'both':
          return true;
      }

      return false;
    }
    
    public static function fetch_id_from_iso($iso) {
      $location = Text::input($iso);
      
      $countries_query = $GLOBALS['db']->query("SELECT countries_id FROM countries WHERE countries_iso_code_2 = '" . $location . "' OR countries_iso_code_3 = '" . $location . "'");
      $country = $countries_query->fetch_assoc();
      
      return $country['countries_id'] ?? '';
    }

  }

