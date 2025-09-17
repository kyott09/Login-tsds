<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with('modelos')->get();
        return view('brand.index', compact('brands'));
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:100|unique:brands,descripcion',
        ]);

        Brand::create($request->all());

        return redirect()->route('brands.index')
            ->with('success', 'Marca creada exitosamente');
    }

    public function edit(Brand $brand)
    {
        return view('brand.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'descripcion' => 'required|string|max:100|unique:brands,descripcion,' . $brand->id,
        ]);

        $brand->update($request->all());

        return redirect()->route('brands.index')
            ->with('success', 'Marca actualizada exitosamente');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')
            ->with('success', 'Marca eliminada exitosamente');
    }
}
