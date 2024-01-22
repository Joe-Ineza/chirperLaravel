<?php

namespace App\Http\Controllers;

use App\Models\Chirpp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChirppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return response('Hello World!');
        return Inertia::render('Chirpp/Index', [
            //
            'chirps' => Chirpp::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->chirpp()->create($validated);

        return redirect(route('chirpp.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chirpp  $chirpp
     * @return \Illuminate\Http\Response
     */
    public function show(Chirpp $chirpp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chirpp  $chirpp
     * @return \Illuminate\Http\Response
     */
    public function edit(Chirpp $chirpp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chirpp  $chirpp
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Chirpp $chirpp)
    // {
    //     //
    // }

    public function update(Request $request, Chirpp $chirpp)
    {

        $this->authorize('update', $chirpp);
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirpp->update($validated);

        return redirect(route('chirpp.index'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chirpp  $chirpp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chirpp $chirpp)
    {
        //
        $this->authorize('delete', $chirpp);

        $chirpp->delete();

        return redirect(route('chirpp.index'));
    }
}
