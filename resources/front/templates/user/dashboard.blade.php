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
              <div class="flex space-between">
                <div class="">
                  Subscription ID <strong>#456</strong>
                </div>
                <div class="">
                  <span class="badge badge-info">Pending</span>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <h2>Writing Test</h2>
                  {!! $form->start('writing-form', 'myForm', route('user.writing.test')) !!}
                  <label>
                    Submit your file. Make sure your scanned copy is clearly readable.
                    <input type="file" name="file" value="">
                  </label>
                  <button type="submit" class="btn btn-primary" name="button">Save</button>
                  {!! $form->end() !!}
                </div>
                <div class="col-md-6">
                  <h2>Speaking test schedule</h2>
                  <label>
                    Submit your file. Make sure your scanned copy is clearly readable.
                    <input type="file" name="" value="">
                  </label>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="#"><i class="ion-document-text"></i> Download Feedback Report</a>
            </div>
          </div>
          <hr>
          <div class="card">
            <div class="card-header">
              <div class="flex space-between">
                <div>
                  Subscription ID <strong>#456</strong>
                </div>
                <div class="">
                  <span class="badge badge-success">Finished test</span>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <h2>Writing test correction</h2>
                  <label>
                    Submit your file. Make sure your scanned copy is clearly readable.
                    <input type="file" name="" value="">
                  </label>
                </div>
                <div class="col-md-6">
                  <h2>Speaking test schedule</h2>
                  <label>
                    Submit your file. Make sure your scanned copy is clearly readable.
                    <input type="file" name="" value="">
                  </label>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="#">Feedback Report</a>
            </div>
          </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection()
