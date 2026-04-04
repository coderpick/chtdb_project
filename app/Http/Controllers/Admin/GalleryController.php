<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $gallery = Gallery::orderBy('sort_order')->get();

        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $this->fileUpload($request->file('image'), 'uploads/gallery');
            $validated['image_path'] = $path;
        }

        $validated['order'] = $request->integer('order', 0);

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image uploaded successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $this->fileUpload($request->file('image'), 'uploads/gallery', $gallery->image_path);
            $validated['image_path'] = $path;
        }

        $validated['order'] = $request->integer('order', $gallery->order);

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery entry updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path && \Storage::disk('public')->exists($gallery->image_path)) {
            \Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery entry deleted successfully.');
    }
}
