@if ($data['type'] == 'select')
<div class="form-group">
  @if ($data['label'])
    <label for="{{ $data['id'] }}">{{ $data['label'] }}</label>
  @endif
  <select class="{{ $data['class'] }} form-control" name="{{ $data['name'] }}" id="{{ $data['id'] }}" {{ ($data['multiple'] ? 'multiple' : '') }}>
    @if ($data['show_label_as_option'] && $data['label'])
      <option value="">{{ $data['label'] }}</option>
    @endif
    @foreach ($data['options'] as $value => $option)
      @if ($data['value_key'] && $data['text_key'])
        <option value="{{ $option[$data['value_key']] }}" {{ ($option[$data['value_key']] == $data['value'] ? 'selected' : '') }}>{{ $option[$data['text_key']] }}</option>
      @elseif ($data['text_as_value'])
        <option value="{{ $option }}" {{ ($option == $data['value'] ? 'selected' : '') }}>{{ $option }}</option>
      @else
        <option value="{{ $value }}" {{ ($value == $data['value'] ? 'selected' : '') }}>{{ $option }}</option>
      @endif
    @endforeach
  </select>
</div>
@endif

@if ($data['type'] == 'radio')
@if ($data['label'])
<label class="_radio_label" for="">{{ $data['label'] }}</label>
@endif
<div class="custom-control custom-radio {{ $data['wrapper_class'] }}">
  @foreach ($data['options'] as $value => $option)
    @if ($data['wrapper_class'] != 'switch')
    <div class="custom-control custom-radio {{ ($data['inline'] ? 'custom-control-inline' : '') }}">
    @endif
      @if ($data['value_key'] && $data['text_key'])
        <input {{ ($data['value'] == $option[$data['value_key']] ? 'checked' : '') }} type="radio" id="{{ $data['name'] }}_{{ $option[$data['value_key']] }}" name="{{ $data['name'] }}" class="custom-control-input" value="{{ $option[$data['value_key']] }}">
        <label class="custom-control-label" for="{{ $data['name'] }}_{{ $option[$data['value_key']] }}">{{ $option[$data['text_key']] }}</label>
      @elseif ($data['text_as_value'])
        <input {{ ($data['value'] == $option ? 'checked' : '') }} type="radio" id="{{ $data['name'] }}_{{ $option }}" name="{{ $data['name'] }}" class="custom-control-input" value="{{ $option }}">
        <label class="custom-control-label" for="{{ $data['name'] }}_{{ $option }}">{{ $option }}</label>
      @else
        <input {{ ($data['value'] == $value ? 'checked' : '') }} type="radio" id="{{ $data['name'] }}_{{ $value }}" name="{{ $data['name'] }}" class="custom-control-input" value="{{ $value }}">
        <label class="custom-control-label" for="{{ $data['name'] }}_{{ $value }}">{{ $option }}</label>
      @endif
    @if ($data['wrapper_class'] != 'switch')
    </div>
    @endif
  @endforeach
  <a class="slider"></a>
</div>
@endif

@if ($data['type'] == 'checkbox')
<div class="custom-control custom-checkbox">
  @if ($data['label'])
    <label class="_checkbox_label" for="">{{ $data['label'] }}</label>
  @endif
  @foreach ($data['options'] as $value => $option)
    @if ($data['value_key'] && $data['text_key'])
      <div class="custom-control custom-checkbox">
        <input type="checkbox" id="{{ $data['name'] }}_{{ $option[$data['value_key']] }}" name="{{ $data['name'] }}" class="custom-control-input" value="{{ $option[$data['value_key']] }}">
        <label class="custom-control-label" for="{{ $data['name'] }}_{{ $option[$data['value_key']] }}">{{ $option[$data['text_key']] }}</label>
      </div>
    @elseif ($data['text_as_value'])
      <div class="custom-control custom-checkbox {{ ($data['inline'] ? 'custom-control-inline' : '') }}">
        <input type="checkbox" id="{{ $data['name'] }}_{{ $option }}" name="{{ $data['name'] }}" class="custom-control-input" value="{{ $option }}">
        <label class="custom-control-label" for="{{ $data['name'] }}_{{ $option }}">{{ $option }}</label>
      </div>
    @else
      <div class="custom-control custom-checkbox {{ ($data['inline'] ? 'custom-control-inline' : '') }}">
        <input type="checkbox" id="{{ $data['name'] }}_{{ $value }}" name="{{ $data['name'] }}" class="custom-control-input" value="{{ $value }}">
        <label class="custom-control-label" for="{{ $data['name'] }}_{{ $value }}">{{ $option }}</label>
      </div>
    @endif
  @endforeach
</div>
@endif
