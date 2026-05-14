<?php

namespace App\Http\Controllers;

use App\Models\Cam;
use Illuminate\Http\Request;

class cameraController extends Controller
{
    public function index() {
    $cameras = Cam::all();
    return view('camdemo.cam', compact('cameras'));
}

public function indexUser() {
    $cameras = Cam::all();
    return view('camdemo.camuser', compact('cameras'));
}

 public function create()
    {
        return view('camdemo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stream_url' => 'required|url',
        ]);

        Cam::create([
            'name' => $request->name,
            'stream_url' => $request->stream_url,
        ]);

        return redirect()->route('cameras.index')->with('success', 'Camera added successfully!');
    }
    public function destroy($id)
{
    $camera = Cam::find($id);
    if ($camera) {
        $camera->delete();
    }
    return redirect()->route('cameras.index');
}

}
