@if (!$data['material'])
<div class="form-group">
  @if ($data['label'])
    <label for="{{ $data['id'] }}">{{ $data['label'] }}</label>
  @endif
  @if (!$data['textarea'])
    <input id="{{ $data['id'] }}" class="form-control {{ $data['class'] }}" type="{{ $data['type'] }}" name="{{ $data['name'] }}" value="{{ $data['value'] }}" {{ ($data['required'] ? '' : '') }}>
  @else
    <textarea id="{{ $data['id'] }}" class="form-control {{ $data['class'] }}" type="{{ $data['type'] }}" name="{{ $data['name'] }}" rows="3" {{ ($data['required'] ? 'required' : '') }}>{{ $data['value'] }}</textarea>
  @endif
</div>
@endif
