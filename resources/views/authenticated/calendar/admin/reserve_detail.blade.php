@extends('layouts.sidebar')

@section('content')
    <div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
        <div class="w-50 m-auto h-75">
            {{-- 1005 add --}}
            {{-- {{ dd($date) }}; --}}
            <p><span>{{ $date }}日</span><span class="ml-3">{{ $part }}部</span></p>
            <div class=""
                style="padding:5px; box-shadow: 4px 4px 8px #dddddd; border-radius: 10px; background-color:#fff">
                <table class="table1 m-auto " width="100%">
                    <tr class="text-center" style="background-color: #4E91B5; color:#fff">
                        <th>ID</th>
                        <th>名前</th>
                        <th>場所</th>
                    </tr>
                    {{-- 1005 add --}}
                    @foreach ($reservePersons as $reservePerson)
                        @foreach ($reservePerson->users as $user)
                            <tr class="text-center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->over_name }} {{ $user->under_name }}</td>
                                <td>リモート</td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
