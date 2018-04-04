<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use DB;
use View;

class AdminController extends Controller
{
    protected $page = [
      'action_links' => []
    ];

    protected $filter;

    protected $component;

    protected $obj;

    public function __construct()
    {
        View::addlocation(resource_path('admin/' . config('adlara.admin_theme') . '/templates'));
        $this->page['title'] = 'Adlara Admin';
        parent::__construct();
    }

    public function template($view)
    {
        $this->default_assigned_variables();
        $data = array_merge($this->assign, $this->assign_default);
        return view($view, $data);
    }

    private function default_assigned_variables()
    {
        $this->getCSS();
        $this->getJS();
        $this->assign_default = [
          'context' => $this->context,
          'form' => $this->context->form,
          'css_files' => $this->css_files,
          'js_files' => $this->js_files,
          'page' => $this->page,
          'component' => $this->component,
          'obj' => $this->obj,
          'sidebar_menu' => $this->getAdminMenu()
        ];
    }

    protected function flash($status, $message)
    {
        if ($status == 'error') {
          $status = 'danger';
        }
        session()->flash('admin_flash', [
          'status' => $status,
          'message' => $message
        ]);
    }

    protected function addCSS($css)
    {
        $this->css_files[] = $css;
    }

    protected function addJS($js)
    {
        $this->js_files[] = $js;
    }

    protected function getCSS()
    {
        $this->addCSS(theme('css/app.css'));
        $this->addCSS('//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
        $this->addCSS('//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.css');
        $this->addCSS('//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css');
        $this->addCSS('//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css');
    }

    protected function getJS()
    {
        $this->addJS(theme('js/app.js'));
        $this->addJS('//cdn.jsdelivr.net/npm/sweetalert2');
        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js');
        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js');
        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js');
        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js');
        $this->addJS(theme('js/custom.js'));
    }

    protected function setActionLink($text, $slug, $icon)
    {
        return $this->page['action_links'][] = [
          'text' => $text,
          'slug' => $slug,
          'icon' => $icon
        ];
    }

    protected function getAdminMenu()
    {
        $co['page'] = [
          'text' => 'Pages'
        ];

          $co['page']['child'][] = [
            'slug' => route('page.list'),
            'text' => 'Pages'
          ];

          $co['page']['child'][] = [
            'slug' => route('page.add'),
            'text' => 'Add'
          ];

        $co['block'] = [
          'text' => 'Blocks'
        ];

          $co['block']['child'][] = [
            'slug' => route('block.list'),
            'text' => 'Blocks'
          ];

          $co['block']['child'][] = [
            'slug' => route('block.add'),
            'text' => 'Add'
          ];

        $co['package'] = [
          'text' => 'Packages'
        ];

          $co['package']['child'][] = [
            'slug' => route('package.list'),
            'text' => 'Packages'
          ];

          $co['package']['child'][] = [
            'slug' => route('package.add'),
            'text' => 'Add'
          ];


        //Main menu defined here
        $menu[] = [
          'head' => 'Components',
          'menu' => $co
        ];

        // $menu[] = [
        //   'head' => 'Settings',
        //   'menu' => $se
        // ];

        return $menu;
    }

    protected function initProcessFilter()
    {
        $filters = Input::all();
        $search = [];
        $date_search = [];
        $skip_filters = ['page', 'generatePDF', 'report'];
        $search_date_available = false;
        $search_date_type = false;
        $search_date_start = false;
        $search_date_end = false;
        $filter_keys = array_keys($filters);
        $date = false;

        foreach ($filter_keys as $key) {
          if (strpos($key, '--start')) {
            $search_date_available = true;
            $search_date_start = true;
          }
          if (strpos($key, '--end')) {
            $search_date_available = true;
            $search_date_end = true;
          }
        }

        if (count($filters)) {
          foreach ($filters as $filter => $value) {
            if (!$value) {
              continue;
            }
            if (!in_array($filter, $skip_filters)) {
              if (strpos($filter, '--start')) {
                $search_date_type = 'start';
                $date = true;
                $filter = str_before($filter, '--');
              }

              if (strpos($filter, '--end')) {
                $search_date_type = 'end';
                $date = true;
                $filter = str_before($filter, '--');
              }

              $filter = str_replace('_', '.', $filter);
              $filter = str_replace('-', '_', $filter);

              if (in_array($filter, $skip_filters)) {
                continue;
              }

              if ($search_date_type && $date) {
                if ($search_date_end && $search_date_start) {
                  if ($search_date_end == 'start') {
                    $exp = '>=';
                  }

                  if ($search_date_type == 'end') {
                    $exp = '<=';
                  }
                  $row = DB::raw('DATE('.$filter.')');
                  $this->filter_search[] = [$row, $exp, date('Y-m-d', strtotime($value))];
                  $date = false;
                } else {
                  $row = DB::raw('DATE('.$filter.')');
                  $this->filter_search[] = [$row, '=', date('Y-m-d', strtotime($value))];
                }
                $this->filter = true;
              } else {
                $this->filter = true;
                $this->filter_search[] = [$filter, 'LIKE', '%' . $value . '%'];
              }
            }
          }
        }
    }

    public function initProcessDelete($id)
    {
        $var = $this->component->variable;
        if (c($this->context->$var->find($id))) {
          $delete = $data->delete();
          $this->flash('success', ucfirst($this->component->name) . ' deleted successfully');
        } else {
          $this->flash('error', 'There is some problem deleting ' . ucfirst($this->component->name));
        }
        return redirect(url()->previous());
    }
}
