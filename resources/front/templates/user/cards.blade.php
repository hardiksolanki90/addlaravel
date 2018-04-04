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
            <div class="card-header flex space-between">
              <div class="">Saved Card</div>
              <a href="{{ route('user.cards.add') }}" class="btn btn-success">
                <i class="ion-ios-plus-outline"></i>
                Add new card
              </a>
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer">

            </div>
          </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection()
