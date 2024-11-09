@extends('layouts.sidebar')

{{-- @section('content')
<div class="w-75 m-auto">
  <div class="w-100">
    <p>{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
@endsection --}}

@section('content')
    <div class="w-75" style="margin:10% auto auto auto">
        <div class="card">
            <div class="w-100 card-body">
                <p style="text-align: center">{{ $calendar->getTitle() }}</p>
                <p>{!! $calendar->render() !!}</p>
            </div>
        </div>
    </div>
@endsection
