<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('team.index', [
            'teams' => Team::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('team.create', [
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_team' => 'required',
            'resource' => 'nullable',
            'logo' => 'nullable|image|file|max:1024',
            'user_id' => 'nullable',
        ]);

        $validatedData['slug'] = SlugService::createSlug(Team::class, 'slug', $validatedData['nama_team']);

        if ($request->file('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('images', 'public');
        }

        Team::create($validatedData);

        Alert::success('Berhasil', 'Data team telah di tambahkan');

        return redirect('/team');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return view('team.show', [
            'team' => $team
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('team.edit', [
            'team' => $team,
            'users' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $validatedData = $request->validate([
            'nama_team' => 'required',
            'resource' => 'nullable',
            'logo' => 'nullable|image|file|max:1024',
            'user_id' => 'nullable',
        ]);

        $validatedData['slug'] = SlugService::createSlug(Team::class, 'slug', $validatedData['nama_team']);

        if ($request->file('logo')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['logo'] = $request->file('logo')->store('images', 'public');
        }

        Team::where('id', $team->id)->update($validatedData);

        Alert::success('Berhasil', 'Data team telah di ubah');

        return redirect('/team');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if ($team->logo) {
            Storage::delete($team->logo);
        }

        Team::destroy($team->id);

        Alert::success('Berhasil', 'Data team telah di hapus');

        return redirect('/team');
    }
}
