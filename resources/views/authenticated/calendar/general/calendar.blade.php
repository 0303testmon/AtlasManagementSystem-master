@extends('layouts.sidebar')

@section('content')
    <div class="vh-100 pt-5" style="background:#ECF1F6;">
        <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
            <div class="w-75 m-auto border" style="border-radius:5px;">

                <p class="text-center">{{ $calendar->getTitle() }}</p>
                <div class="">
                    {!! $calendar->render() !!}
                    {{-- 0916 add --}}
                    {{-- <div class="adjust-table-btn m-auto text-right">
                        <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting"
                            onclick="return confirm('登録してよろしいですか？')"> --}}
                    {{-- 0916 add --}}
                </div>
            </div>
            <div class="text-right w-75 m-auto">
                <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
            </div>
        </div>
    </div>
@endsection
