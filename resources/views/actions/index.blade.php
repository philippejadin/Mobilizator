@extends('app')

@section('content')

@include('groups.tabs')

<div class="tab_content">

    @auth
        <div class="flex mb-4 justify-between">

            <div class="mb-2">
               @include('partials.preferences-calendar')
                @auth
                    @if (Auth::user()->getPreference('availability', 'hide') == 'hide')
                        <a class="btn btn-primary" href="?set_preference=availability&value=show">{{__('Show availability of members')}}</a>
                    @else
                        <a class="btn btn-primary" href="?set_preference=availability&value=hide">{{__('Hide availability of members')}}</a>
                    @endif
                 @endauth
            </div>

            @can('create-action', $group)
                <div>
                  <a class="btn btn-primary"
            href="{{ route('groups.actions.create', $group ) }}">
            <i class="fas fa-pencil-alt"></i>
            <span class="hidden sm:inline ml-2">{{ trans('action.create_one_button') }}</span>
        </a>
</div>
                
            @endcan

        </div>
    @endauth


    @if($type == 'grid')

        <div id="calendar" class="calendar"
            data-json="{{ route('groups.actions.index.json', $group) }}"
            data-locale="{{ App::getLocale() }}"
            data-create-url="{{ route('groups.actions.create', $group) }}"></div>

        @include('actions.ical')
    @endif

    @if($type == 'list')

    

        @if($actions->count() > 0)
            <div class="actions">
                @forelse( $actions as $action)
                    @include('actions.action')
                @empty
                    {{ trans('messages.nothing_yet') }}
                @endforelse
            </div>

            {{ $actions->render() }}

            @include('actions.ical')
        @endif
    @endif



</div>

@endsection