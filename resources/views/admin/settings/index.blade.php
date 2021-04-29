@extends('app')

@section('content')




{!! Form::open(['action' => 'Admin\SettingsController@update', 'files' => true]) !!}

<div class="flex justify-between sticky top-0 bg-white py-4 mb-8 border-b border-gray-300 z-50">
    <h1>{{ __('Settings') }}</h1>


    <div>
        {!! Form::submit(trans('messages.save'), ['class' => 'btn btn-lg btn-primary shadow']) !!}
    </div>

</div>

<div class="flex">
    <div class="w-1/3 mr-4">
        <div class="nav nav-pills sticky flex-col mr-4" style="top:8rem;" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" data-toggle="pill" href="#presentation" role="tab"
                aria-selected="true">Presentation & logo</a>
            <a class="nav-link" data-toggle="pill" href="#emails" role="tab">Emails</a>
            <a class="nav-link" data-toggle="pill" href="#permissions" role="tab">Permissions</a>
            <a class="nav-link" data-toggle="pill" href="#notifications" role="tab">Notifications</a>
            <a class="nav-link" data-toggle="pill" href="#custom" role="tab">Custom content</a>
            <a class="nav-link" data-toggle="pill" href="#tags" role="tab">Tags</a>
        </div>
    </div>


    <div class="w-2/3">
        <div class="tab-content" id="v-pills-tabContent">

            <div class="tab-pane fade show active" id="presentation">
                <div class="setting">
                    <h2>{{ __('Application name') }}</h2>
                    <div class="form-group">
                        <div class="setting-help">
                            {{ __('The name of your application. Used everywhere, in titles, in emails, etc... Choose a short and catchy name') }}
                        </div>
                        {!! Form::text('name', setting('name'), ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="setting">
                    <h2>{{ __('Application logo') }}</h2>
                    <div class="form-group">
                        <div class="setting-help">
                            {{ __('This logo will be used in the top left area and as a favicon') }}
                        </div>
                        <input name="logo" id="logo" type="file" title="{{ trans('messages.select_one_file') }}">
                    </div>
                </div>

                <div class="setting">
                    <h2>{{ __('Home page presentation text : for anonymous users') }}
                    </h2>
                    <div class="form-group">
                        <div class="setting-help">
                            {{ __('This is shown on the homepage for non connected user. Make it attractive :-)') }}
                        </div>

                        <x-setting-localized name="homepage_presentation" />
                    </div>
                </div>

                <div class="setting">
                    <h2>{!! __('Home page presentation text <em>for logged-in users</em>') !!}
                    </h2>
                    <div class="setting-help">
                        {{ __('You can use it for announcements for example') }}
                    </div>
                    <x-setting-localized name="homepage_presentation_for_members" />
                </div>

                <div class="setting">

                    <h2>{{ __('Help page') }}</h2>
                    <div class="setting-help">
                        {{ __('A single help page you can customize, available on the user menu, for logged in user') }}
                    </div>
                    <div class="form-group">
                        <x-setting-localized name="help_text" />
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show active" id="emails">
                <div class="help">
                    The system sends welcome emails on user registration and on group creation, instantly, and a week after. You can define the content of the email here 
                </div>


                <div class="setting">
                    <h2>Welcome emails</h2>
                    <div class="form-group">
                        <div class="setting-help">
                            Welcome email sent each time a user creates an account.
                        </div>
                        <x-setting-localized name="email_new_user" />
                    </div>
                </div>

                <div class="setting">
                    <h2>Welcome emails, follow-up</h2>
                    <div class="form-group">
                        <div class="setting-help">
                            A second email sent one week after a user created an account.
                        </div>
                        <x-setting-localized name="email_new_user_follow_up" />
                    </div>
                </div>


                <div class="setting">
                    <h2>New group created</h2>
                    <div class="form-group">
                        <div class="setting-help">
                            Welcome email sent each time a user creates a group.
                        </div>
                        <x-setting-localized name="email_new_group" />
                    </div>
                </div>

                <div class="setting">
                    <h2>New group created, follow-up</h2>
                    <div class="form-group">
                        <div class="setting-help">
                            A second email sent one week after a user created an group.
                        </div>
                        <x-setting-localized name="email_new_group_follow_up" />
                    </div>
                </div>

                
            </div>


            <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                <div class="setting">

                    <h2>{{ __('Group creation') }}</h2>
                    <div class="form-group">
                        {!! Form::checkbox('user_can_create_groups', 'yes' , setting('user_can_create_groups',true))
                        !!}
                        {{ __('Allow regular users to create groups (if you uncheck this box, only admins will be able to create groups)') }}

                        <br />

                        {!! Form::checkbox('user_can_create_secret_groups','yes' ,
                        setting('user_can_create_secret_groups')) !!}
                        {!! __('Allow regular users to create <strong>secret</strong> groups (if you uncheck this
                        box,
                        only admins will be able to create secret groups)')!!}

                        <br />
                        {!! Form::checkbox('user_can_register','yes' ,
                        setting('user_can_register', true)) !!}
                        {!! __('Allow anyone to create a new user account on this server (unchecking this box will
                        disable registration)')!!}

                    </div>


                </div>


            </div>

            <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                <div class="form-group">
                    {!! Form::checkbox('notify_admins_on_group_create','yes' ,
                    setting('notify_admins_on_group_create'))
                    !!}
                    {{ __('Notify administrators when a new group is created') }}
                </div>
            </div>


            <div class="tab-pane fade setting" id="custom" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <h2>{{ __('Custom footer code') }}</h2>
                <div class="form-group">
                    <div class="setting-help">
                        {{ __('You can add html / css / js at the footer of each page here') }}
                    </div>
                    <textarea name="custom_footer" class="form-control">{!!setting('custom_footer')!!}</textarea>

                </div>

            </div>

            <div class="tab-pane fade setting" id="tags" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <h2>{{ __('Tags') }}</h2>
                <div class="form-group">
                    {{ __('Limit the allowed tags for tagging users') }}.<br />
                    <div class="setting-help">
                        {{ __('Enter a coma separated list of allowed tags or leave blank to allow free tagging') }}
                    </div>
                    <select style="width: 100%" name="user_tags[]" class="js-tags form-control" data-tags="true"
                        multiple="multiple">
                        @if (is_array(setting()->getArray('user_tags')))
                        @foreach (setting()->getArray('user_tags') as $tag)
                        <option value="{{$tag}}" selected="selected">{{$tag}}</option>
                        @endforeach
                        @endif
                    </select>

                </div>

                <div class="form-group">
                    {{ __('Limit the allowed tags for tagging groups') }}.<br />
                    <div class="setting-help">
                        {{ __('Enter a coma separated list of allowed tags or leave blank to allow free tagging') }}
                    </div>

                    <select style="width: 100%" name="group_tags[]" class="js-tags form-control" data-tags="true"
                        multiple="multiple">
                        @if (is_array(setting()->getArray('group_tags')))
                        @foreach (setting()->getArray('group_tags') as $tag)
                        <option value="{{$tag}}" selected="selected">{{$tag}}</option>
                        @endforeach
                        @endif
                    </select>

                </div>

            </div>


        </div>


    </div>




    {!! Form::close() !!}


</div>

@endsection