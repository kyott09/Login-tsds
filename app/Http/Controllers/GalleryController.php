<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('gallery.index', compact('photos'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('photos', 'public');

        Photo::create([
            'title' => $request->title,
            'image_path' => $path,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Foto subida correctamente.');
    }

    public function edit(Photo $gallery)
    {
        return view('gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Photo $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image_path);
            $path = $request->file('image')->store('photos', 'public');
            $gallery->image_path = $path;
        }

        $gallery->title = $request->title;
        $gallery->save();

        return redirect()->route('gallery.index')->with('success', 'Foto actualizada correctamente.');
    }

    public function destroy(Photo $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Foto eliminada correctamente.');
    }
}
