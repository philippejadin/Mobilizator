<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Image;
use Storage;
use Illuminate\Support\Str;
use App\Setting;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a settings edition screen.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Update settings from the edit form.
     */
    public function update(Request $request)
    {
        //dd($request);
        if (Auth::user()->isAdmin()) {
            setting()->set('name', $request->get('name'));

            if ($request->has('homepage_presentation')) {
                foreach ($request->get('homepage_presentation') as $locale => $value) {
                    setting()->localized($locale)->set('homepage_presentation', $value);
                }
            }
            if ($request->has('homepage_presentation_for_members')) {
                foreach ($request->get('homepage_presentation_for_members') as $locale => $value) {
                    setting()->localized($locale)->set('homepage_presentation_for_members', $value);
                }
            }

            if ($request->has('help_text')) {
                foreach ($request->get('help_text') as $locale => $value) {
                    setting()->localized($locale)->set('help_text', $value);
                }
            }


            if ($request->has('email_new_user')) {
                foreach ($request->get('email_new_user') as $locale => $value) {
                    setting()->localized($locale)->set('email_new_user', $value);
                }
            }

            if ($request->has('email_new_user_follow_up')) {
                foreach ($request->get('email_new_user_follow_up') as $locale => $value) {
                    setting()->localized($locale)->set('email_new_user_follow_up', $value);
                }
            }

            if ($request->has('email_new_group')) {
                foreach ($request->get('email_new_group') as $locale => $value) {
                    setting()->localized($locale)->set('email_new_group', $value);
                }
            }

            if ($request->has('email_new_group_follow_up')) {
                foreach ($request->get('email_new_group_follow_up') as $locale => $value) {
                    setting()->localized($locale)->set('email_new_group_follow_up', $value);
                }
            }

            setting()->set('user_can_create_groups', $request->has('user_can_create_groups') ? 1 : 0);
            setting()->set('user_can_create_secret_groups', $request->has('user_can_create_secret_groups') ? 1 : 0);
            setting()->set('notify_admins_on_group_create', $request->has('notify_admins_on_group_create') ? 1 : 0);
            setting()->set('user_can_register', $request->has('user_can_register') ? 1 : 0);




            setting()->setArray('user_tags', $request->get('user_tags'));
            setting()->setArray('group_tags', $request->get('group_tags'));


            setting()->set('custom_footer', $request->get('custom_footer'));

            // handle app logo
            if ($request->hasFile('logo')) {
                Storage::makeDirectory('public/logo');

                Image::make($request->file('logo'))->fit(128, 128)->save(storage_path() . '/app/public/logo/favicon.png');

                Image::make($request->file('logo'))->fit(640, 640)->save(storage_path() . '/app/public/logo/logo.jpg');

                Image::make($request->file('logo'))->widen(1024)->save(storage_path() . '/app/logo.png');
            }

            flash('Settings saved');

            return view('admin.settings.index');
        } else {
            flash(trans('messages.not_allowed'));

            return redirect()->action('DashboardController@index');
        }
    }
}
