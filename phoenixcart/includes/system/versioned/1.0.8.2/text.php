<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class Text {

    /**
     * Break words longer than maximum.
     * @param string $s
     * @param int $maximum
     * @param string $break_marker
     */
    public static function break(string $s, int $maximum, string $break_marker = '-') {
      return array_reduce(
        explode(' ', $s),
        function ($carry, $word) use ($maximum, $break_marker) {
          return $carry . Text::rtrim_once(chunk_split($word, $maximum, $break_marker), $break_marker) . ' ';
        }, '');
    }

    /**
     * Sanitize and normalize HTTP input.
     * @param string $s
     * @return string
     */
    public static function input(string $s) {
      return trim(static::sanitize($s));
    }

    public static function is_empty(string $s = null) {
      return is_null($s) || ('' === trim($s));
    }

    public static function is_prefixed_by(string $s, string $prefix) {
      return (substr($s, 0, strlen($prefix)) === $prefix);
    }

    public static function is_suffixed_by(string $s, string $suffix) {
      return (substr($s, -strlen($suffix)) === $suffix);
    }

    public static function ltrim_once(string $s, string $prefix) {
      $length = strlen($prefix);
      if (substr($s, 0, $length) === $prefix) {
        return substr($s, $length);
      }

      return $s;
    }

    public static function output(string $s, $translate = false) {
      return strtr(trim($s), $translate ?: ['"' => '&quot;']);
    }

    public static function prepare(string $s) {
      return trim($s);
    }

    public static function rtrim_once(string $s, string $suffix) {
      $displacement = -strlen($suffix);
      if (substr($s, $displacement) === $suffix) {
        $s = substr($s, 0, $displacement);
      }

      return $s;
    }

    public static function sanitize(string $s) {
      return preg_replace(
        ['{ +}', '{[<>]}'],
        [' ', '_'],
        trim($s));
    }

  }
