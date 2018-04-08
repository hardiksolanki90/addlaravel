<?php

namespace App\Classes;

class Form
{
    private $form = [];

    private $required = [];

    private $required_label = [];

    public $token = true;

    private $file_path;

    public function start($name, $class, $action = '')
    {
        $this->file_path = 'admin/' . config('adlara.admin_theme') . '/templates';
        $this->form = new \stdClass;
        $this->form->name = $name;
        $this->form->class = $class;
        $this->form->action = $action;
        return '<form name="'.$name.'" class="'.$class.'" action="'.$action.'">';
    }

    public function end()
    {
        $html = '';
        if (isset($this->required[$this->form->name]) && count($this->required[$this->form->name])) {
            $html .= $this->hidden('required', implode(',', $this->required[$this->form->name]));
            $html .= $this->hidden('required_label', implode(',', $this->required_label[$this->form->name]));
        }

        $html .= $this->hidden('form_class', $this->form->class);
        if ($this->token) {
            $html .= $this->hidden('_token', csrf_token());
        }

        $html .= '</form>';
        return $html;
    }

    public function hidden($name, $value = null)
    {
        return '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.($value ? $value : '').'">';
    }

    public function text(array $data = array())
    {
        $default = [
          'label' => '',
          'id' => $data['name'],
          'class' => '',
          'width' => 'full',
          'length' => 100,
          'value' => '',
          'required' => false,
          'type' => 'text',
          'placeholder' => false,
          'wrapper_class' => '',
          'material' => false,
          'textarea' => false
        ];

        foreach ($default as $key => $value) {
            if (!isset($data[$key])) {
              $data[$key] = $value;
            }
        }

        if ($data['required']) {
          $this->required[$this->form->name][] = $data['name'];
          $this->required_label[$this->form->name][] = $data['label'];
        }

        $key = $this->form->name . '_' . $data['name'] . '_' . $data['value'] . '_' . $this->form->name;

        $html = view($this->file_path . '/form.text', ['data' => $data]);
        $tools = config('adlara.context')->tools;
        $tools->prepareHTML($html);
        return $tools->buildHTML();
        return cache()->remember($key, '2400', function () use ($data) {
          $html = view('form.text', ['data' => $data]);
          $tools = config('adlara.context')->tools;
          $tools->prepareHTML($html);
          return $tools->buildHTML();
        });
    }

    public function choice($data = array())
    {
        $default = [
          'label' => '',
          'options' => [],
          'value' => null,
          'name' => $data['name'],
          'id' => str_replace('[]', '', $data['name']),
          'class' => '',
          'wrapper_class' => '',
          'text_key' => '',
          'value_key' => '',
          'multiple' => false,
          'required' => false,
          'attribute' => '',
          'show_label_as_option' => true,
          'text_as_value' => false,
          'type' => 'select',
          'inline' => false,
          'switch' => false,
          'reverse' => false
        ];

        foreach ($default as $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }

        if (!count($data['options'])) {
          return;
        }

        if ($data['reverse']) {
          $data['options'] = array_reverse($data['options'], true);
        }

        $data_implode = $data;
        $data_implode['options'] = implode(';', $data['options']);
        $data_implode = implode(',', $data_implode);
        $key = $this->form->name . '_' . $data_implode . '_' . '_' . $this->form->name;
        $html = view($this->file_path . '/form.select', ['data' => $data]);
        $tools = config('adlara.context')->tools;
        $tools->prepareHTML($html);
        return $tools->buildHTML();

        return cache()->remember($key, '2400', function () use ($data) {
          $html = view('form.select', ['data' => $data]);
          $tools = config('adlara.context')->tools;
          $tools->prepareHTML($html);
          return $tools->buildHTML();
        });
    }
}
