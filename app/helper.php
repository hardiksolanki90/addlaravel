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

function AdminURL($url = null)
{
    return url(config('adlara.admin_route') . ($url ? '/' . $url : ''));
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
