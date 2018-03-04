<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use Carbon\Carbon;


class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $announcements = Announcement::all();

        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(request(), [
            "announce" =>  'max:499',
        ]);
        $current_time = \Carbon\Carbon::now();
        $dateNow = $current_time->setTimezone('Asia/Manila')->format('Y-m-d H:i:s');

        Announcement::create([
            'title' => $request->title,
            'description' => $request->announce,
            'viewer' => request('viewer'),
            'created_at' => $dateNow,
            'updated_at' => $dateNow,
        ]);

        return redirect('/home/announcements/')->with('success', 'Information created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
        return view('announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Announcement $announcement)
    {
        //
        $current_time = \Carbon\Carbon::now();
        $dateNow = $current_time->setTimezone('Asia/Manila')->format('Y-m-d H:i:s');

        $announcement->update([
            'title' => request('title'),
            'description' => request('announce'),
            'viewer' => request('viewer'),
            'updated_at' => $dateNow,

        ]);
        return redirect('/home/announcements/')->with('success', 'Information was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
    	return back();

        //
    }
}
