<?php

namespace App\Http\Controllers\v1;

use App\Models\Sphere;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiSphereController extends Controller
{
    // Отображение всех сфер
    public function index()
    {
        $spheres = Sphere::all();
        //return view('spheres.index', compact('spheres'));
        return response()->json($spheres)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Сохранение новой сферы
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Sphere::create($request->all());

        //return redirect()->route('spheres.index')->with('success', 'Sphere created successfully.');
        return response()->json($request, 201)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Показ одной сферы
    public function show($id)
    {
        $sphere = Sphere::findOrFail($id);
        //return view('spheres.show', compact('sphere'));
        return response()->json($sphere)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Обновление сферы
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sphere = Sphere::findOrFail($id);
        $sphere->update($request->all());

        //return redirect()->route('spheres.index')->with('success', 'Sphere updated successfully.');
        return response()->json($category, 200)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Удаление сферы
    public function destroy($id)
    {
        $sphere = Sphere::findOrFail($id);
        $sphere->delete();

        //return redirect()->route('spheres.index')->with('success', 'Sphere deleted successfully.');
        return response()->json(null, 204);
    }
}
