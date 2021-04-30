@extends('app')



@section('content')

<div class="tab_content">

    <h2>
        {{ trans('messages.users') }}
    </h2>


    {{ $table }}

</div>


@endsection