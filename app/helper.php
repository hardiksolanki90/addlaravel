<?php

use \Illuminate\Http\Request;

function pre($array, $exit = true)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';

    if ($exit) {
      exit();
    }
}

function theme($file, $global = false)
{
    if ($global) {
      return url('resources/_shared/' . $file);
    }

    if (config('adlara.app_scope') == 'admin') {
      return url('resources/admin/' . config('adlara.admin_theme') . '/' . $file);
    }

    return url('resources/front/' . config('adlara.front_theme') . '/' . $file);
}

function json($status, $message, $data = array())
{
    echo json_encode([
      'status' => $status,
      'message' => $message,
      'data' => $data
    ]);
    exit();
}

function jsonResponse($status, $message, $data = array())
{
    return response()->json([
      'status' => $status,
      'message' => $message,
      'data' => $data
    ]);
}

function media($name, $size = null, $type = 'image')
{
    return url('storage/media/' . $type . '/' . $name);
}

function AdminURL($url = null)
{
    return url(config('adlara.admin_route') . ($url ? '/' . $url : ''));
}

function t($string)
{
    return $string;
}

/**
 * output value if found in object or array
 * @param  [object/array] $model             Eloquent model, object or array
 * @param  [string] $key
 * @param  [boolean] $alternative_value
 * @return [type]
 */
function model($model, $key, $alternative_value = null, $type = 'object')
{
    if (is_object($model)) {
        if (isset($model->$key)) {
            return $model->$key;
        }
    }

    if (is_array($model)) {
        if (isset($model[$key]) && $model[$key]) {
            return $model[$key];
        }
    }

    return $alternative_value;
}

function c($data)
{
    if (isset($data->id) && $data->id) {
      return true;
    }

    return false;
}

function addTab($string, $number = 2) {
  for ($t = 1; $t <= $number; $t++) {
    $string = "\t".$string;
  }
  return $string;
}

function formatLine($string, $tab = 2, $end_line_break = 0) {
  $tabs = '';
  for ($t = 1; $t <= $tab; $t++) {
    $tabs .= "\t";
  }

  return PHP_EOL . $tabs.$string . PHP_EOL;
}

function formatLine2($string, $tab = 2, $end_line_break = 0) {
  $tabs = '';
  for ($t = 1; $t <= $tab; $t++) {
    $tabs .= "\t";
  }

  $string = $tabs . $string;
  return $string . PHP_EOL;
}

function formatLine3($string, $tab = 2, $end_line_break = 0) {
  $tabs = '';
  for ($t = 1; $t <= $tab; $t++) {
    $tabs .= "\t";
  }

  return $tabs.$string;
}

function writeHTML($file, $pass)
{
    $context = config('adlara.context');
    $html = view($file, $pass);
    $core = $context->tools;
    $core->prepareHTML($html);
    $html = $core->buildHTML();
    return $html;
}

function writeFile($file_path, $file, $html = 'Html')
{
    $dir = $file_path;
    if (!file_exists($dir)) {
      mkdir($dir);
    }

    $file = fopen($dir . '/' . $file, 'w');
    fwrite($file, $html);
    fclose($file);
}

function makeColumn($field)
{
    if (is_array($field)) {
      $co = [];
      foreach ($field as $key => $f) {
        $field[$key] = str_slug($f);
        $field[$key] = str_replace('-', '_', $f);
        $field[$key] = str_replace(' ', '_', $field[$key]);
        $field[$key] = strtolower($field[$key]);
      }
      return $field;
    } else {
      $column = str_slug($field);
      $column = str_replace('-', '_', $column);
      return $column;
    }
}

function makeColumnToString($column)
{
    $column = ucfirst($column);
    $column = explode('_', $column);
    return implode(' ', $column);
}

function getNumber($string)
{
    return filter_var($string, FILTER_SANITIZE_NUMBER_INT);
}

function makeObject($string)
{
    $object = explode('_', $string);
    foreach ($object as $key => $d) {
      $object[$key] = ucfirst($d);
    }
    $object = implode('', $object);
    $object = str_replace('_', '', $object);
    return ucfirst($object);
}

function block($identifier)
{
    $context = config('adlara.context');
    $block = $context->block
    ->where('identifier', $identifier)
    ->where('status', 1)
    ->first();
    if (c($block)) {
      return $block->content;
    }
}

function filter($content)
{
    $content = filter_replace('BLOCK', 'block', $content);
    $content = filter_replace('MEDIA', 'media', $content);
    $content = filter_replace('URL', 'custom_url', $content);
    return $content;
}

function custom_url($url)
{
    return env('APP_URL_PLAIN') . '/' . $url;
}

function filter_replace($identifier, $function, $content)
{
    $actual_content = $content;
    $block = preg_match_all('/%'.$identifier.'_(.*?)%/', $content, $results);
    if (count($results[1])) {
      foreach ($results[1] as $result) {
        $output = call_user_func_array($function, [strip_tags($result)]);
        if ($output) {
          $actual_content = str_replace('%' . $identifier . '_' . $result . '%', $output, $actual_content);
        }
      }
    }

    return $actual_content;
}

function toArray($object)
{
    return json_decode(json_encode($object), True);
}
