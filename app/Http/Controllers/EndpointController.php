<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EndpointStoreRequest;
use App\Http\Requests\EndpointShowRequest;
use App\Http\Requests\EndpointDestroyRequest;
use App\Http\Requests\EndpointUpdateRequest;
use App\Http\Resources\EndpointResource;
use App\Models\Endpoint;
use App\Models\Site;


class EndpointController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(EndpointShowRequest $request, Endpoint $endpoint)
    {
        return inertia()->render('Endpoint', [
            'endpoint' => EndpointResource::make($endpoint)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EndpointStoreRequest $request, Site $site)
    {
        $site->endpoints()->create($request->only('location', 'frequency'));
        
        return back();
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
    public function update(EndpointUpdateRequest $request, Endpoint $endpoint)
    {
        $endpoint->update($request->only('location', 'frequency'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EndpointDestroyRequest $request, Endpoint $endpoint)
    {
        $endpoint->delete();

        return back();
    }
}
