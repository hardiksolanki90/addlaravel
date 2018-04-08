@extends('layouts.app')
@section('content')
<div class="content">
  <h1 class="_pa">IELTS Writing & Speaking Correction Service Packages</h1>
  <div class="container narrow-container">
    @if (count($normal_package))
    <div class="flex space-around">
      @foreach ($normal_package as $pack)
      <div class="package _pl">
        <div class="tag tag-default">Regular Package</div>
        <div class="flex space-between">
          <div class="title">{{ $pack->name }}</div>
          <div class="price"><span>only</span> ${{ $pack->price }}</div>
        </div>
        <div class="_ben">
          {!! $pack->benefits !!}
        </div>
        <a href="{{ route('package.subscribe', ['id' => $pack->id]) }}" class="btn btn-primary w100">Join Now</a>
      </div>
      @endforeach
    </div>
    @endif
    @if (count($combo_package))
    <h2 class="_cp">Combo Packages</h2>
    <div class="flex space-around">
      @foreach ($combo_package as $pack)
      <div class="package _pl">
        <div class="flex space-between">
          <div class="title">{{ $pack->name }}</div>
          <div class="price"><span>only</span> ${{ $pack->price }}</div>
          @if ($pack->save)
          <div class="price-save">
            ${{ $pack->save }}
          </div>
          @endif
        </div>
        <div class="_ben">
          {!! $pack->benefits !!}
        </div>
        <a href="{{ route('package.subscribe', ['id' => $pack->id]) }}" class="btn btn-primary w100">Join Now</a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</div>
@endsection
