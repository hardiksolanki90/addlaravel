<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use View;

class FrontController extends Controller
{
    protected $component;

    protected $obj;

    protected $page;

    protected $css_files = [];

    protected $js_files = [];

    public function __construct()
    {
        View::addlocation(resource_path('front/' . config('adlara.front_theme') . '/templates'));
        parent::__construct();
    }

    public function template($view)
    {
        $this->initMeta();
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
          'component' => $this->component,
          'page' => $this->page,
          'css_files' => $this->css_files,
          'js_files' => $this->js_files,
          'user' => $this->context->user,
          'flash' => session('front_flash')
        ];
    }

    private function initMeta()
    {
        if (!isset($this->obj->meta_title)) {
          $url = url()->current();
          $new_url = str_replace(url('') . '/', '', $url);
          $this->obj = $this->context->page->findByUrl($new_url);

          if (!isset($this->obj->meta_title)) {
            return true;
          }
        }

        if ($this->obj->meta_title) {
          $this->page['meta_title'] = $this->obj->meta_title . (($this->page['title_prefix']) && $this->page['title_prefix'] ? ' | ' . $this->page['title_prefix'] : '');
        }
        $this->page['meta_keywords'] = $this->obj->meta_keywords;
        $this->page['meta_description'] = $this->obj->meta_description;
    }

    private function getCSS()
    {
        $this->addCSS(theme('css/app.css'));
        $this->addCSS('//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
        $this->addCSS(theme('css/front.css', true));
        $this->addCSS(theme('css/slider.css', true));
        $this->addCSS(theme('css/toast.css', true));
    }

    private function getJS()
    {
        $this->addJS(theme('js/slider.js', true));
        $this->addJS(theme('js/app.js'));
        $this->addJS(theme('js/front.js', true));
        $this->addJS(theme('js/toast.js', true));
    }

    protected function addCSS($css)
    {
        $this->css_files[] = $css;
    }

    protected function addJS($js)
    {
        $this->js_files[] = $js;
    }

    protected function flash($status, $message)
    {
        session()->flash('front_flash', [
          'status' => $status,
          'message' => $message
        ]);
    }
}
