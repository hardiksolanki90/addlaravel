@extends('layouts.app')
@section('content')
<div class="content mtb15">
  <div class="container">
    <div class="flex space-between row">
      <div class="_lc col-md-3">
        @include('user._partials.menu')
      </div>
      <div class="_rc col-md-9">
          <div class="card">
            <div class="card-header">
              Profile
            </div>
            {!! $form->start('profile', 'myForm', route('user.profile')) !!}
            <div class="card-body">
              {!! $form->text([
                'name' => 'name',
                'label' => 'Full Name',
                'value' => model($user, 'name'),
                'required' => true,
              ]) !!}
              {!! $form->text([
                'name' => 'email',
                'label' => 'Email',
                'value' => model($user, 'email'),
                'required' => true,
              ]) !!}
              {!! $form->text([
                'name' => 'password',
                'label' => 'New Password',
                'value' => ''
              ]) !!}
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-lg" name="button">Save Profile</button>
            </div>
            {!! $form->end() !!}
          </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection()
