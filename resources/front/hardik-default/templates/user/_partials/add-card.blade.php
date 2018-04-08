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
              Add new card
            </div>
            {!! $form->start('add-card', 'payment-form', route('user.cards.add')) !!}
            <div class="card-body">
              {!! $form->text([
                'name' => 'card-number',
                'label' => 'Card number',
                'required' => true,
                'length' => 20,
                'type' => 'tel'
              ]) !!}
              <div class="flex half-row">
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
            </div>
            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
            <div class="card-footer flex space-between">
              <input id="nonce" name="payment_method_nonce" type="hidden" />
              <button type="submit" class="btn btn-primary btn-lg" name="button">Add Card</button>
              <a href="{{ route('user.cards') }}" class="btn btn-secondary btn-lg">
                <i class="ion-ios-undo-outline"></i>
                Cancel
              </a>
            </div>
            {!! $form->end() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection()
@section('footer_script')
<script type="text/javascript">
var form = document.querySelector('.payment-form');
var client_token = "{{ $client_token }}";
braintree.dropin.create({
  authorization: client_token,
  selector: '#bt-dropin',
  paypal: {
    flow: 'vault'
  }
}, function (createErr, instance) {
  if (createErr) {
    console.log('Create Error', createErr);
    return;
  }
  form.addEventListener('submit', function (event) {
    event.preventDefault();
    instance.requestPaymentMethod(function (err, payload) {
      if (err) {
        console.log('Request Payment Method Error', err);
        return;
      }
      // Add the nonce to the form and submit
      document.querySelector('#nonce').value = payload.nonce;
      form.submit();
    });
  });
});
</script>
@endsection
