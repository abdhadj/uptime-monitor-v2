<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SiteStoreRequest;
use App\Http\Requests\SiteDestroyRequest;
use App\Http\Requests\SiteNotificationEmailDestroyRequest;
use App\Http\Requests\SiteNotificationEmailStoreRequest;
use App\Models\Site;
use Illuminate\Support\Arr;


class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiteStoreRequest $request)
    {
        $site = $request->user()->sites()->create($request->only(['domain']));

        return redirect()->route('dashboard', $site);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteDestroyRequest $request, Site $site)
    {
        $site->delete();

        return redirect()->route('dashboard');
    }

    public function SiteNotificationEmailDestroy(SiteNotificationEmailDestroyRequest $request, Site $site){
        $site->update([
            'notification_emails' => array_diff(
                $site->notification_emails, [$request->email]
            )
        ]);

        return back();
    }

    public function SiteNotificationEmail(SiteNotificationEmailStoreRequest $request, Site $site){
        $site->update([
            'notification_emails' => Arr::prepend(
                $site->notification_emails, $request->email
            )
        ]);

        return back();
    }
}
