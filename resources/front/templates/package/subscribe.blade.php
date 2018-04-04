@extends('layouts.app-logo-only')
@section('content')
<div class="content">
  <div class="container">
    <h2 class="text-center mtb15 uppercase">Secured payment screen. Complete the order.</h2>
    <div class="form_wrapper">
      {!! $form->start('order-form', 'myForm', '') !!}
      <div class="_fh">
        1. Your basic information
      </div>
      <div class="flex space-between">
        {!! $form->text([
          'name' => 'fullname',
          'label' => 'Full name',
          'required' => true,
        ]) !!}

        {!! $form->choice([
          'name' => 'country',
          'label' => 'Country',
          'required' => true,
          'options' => [
            'India', 'Japan'
          ]
        ]) !!}
      </div>
      <div class="flex space-between">
        {!! $form->text([
          'name' => 'email',
          'label' => 'Email',
          'required' => true,
        ]) !!}

        {!! $form->text([
          'name' => 'password',
          'label' => 'Password',
          'type' => 'password',
          'required' => true,
        ]) !!}
      </div>
      <div class="_fh">
        <hr>
        2. Add payment information
      </div>
      <div class="flex space-between cm">
        <div class="w100 m75">
          {!! $form->text([
            'name' => 'card-number',
            'label' => 'Card number',
            'required' => true,
            'length' => 20,
            'type' => 'tel'
            ]) !!}
        </div>
        <div class="w175 m75">
          {!! $form->text([
            'name' => 'card-expiry',
            'label' => 'Card expiry',
            'required' => true,
            'type' => 'tel',
            ]) !!}
        </div>
        <div class="w175 m75">
          {!! $form->text([
            'name' => 'card-cvv',
            'label' => 'CVV/CVC',
            'required' => true,
            'type' => 'tel',
            'length' => '3',
            ]) !!}
        </div>
      </div>
      <hr>
      <div class="flex space-between">
        <div class="">
          <p class="bold m0">Package</p>
          {{ $package->name }} - <strong>${{ number_format($package->price, 2) }}</strong>
        </div>
        <button type="submit" name="button" class="btn btn-primary btn-lg">Make Payment</button>
      </div>
      {!! $form->end() !!}
    </div>
  </div>
</div>

@endsection
