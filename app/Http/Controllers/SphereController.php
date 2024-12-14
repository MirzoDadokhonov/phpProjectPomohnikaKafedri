<?php

namespace App\Http\Controllers;

use App\Models\Sphere;
use Illuminate\Http\Request;

class SphereController extends Controller
{
    // Отображение всех сфер
    public function index()
    {
        $spheres = Sphere::all();
        return view('spheres.index', compact('spheres'));
    }

    // Форма для создания новой сферы
    public function create()
    {
        return view('spheres.create');
    }

    // Сохранение новой сферы
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Sphere::create($request->all());

        return redirect()->route('spheres.index')->with('success', 'Sphere created successfully.');
    }

    // Показ одной сферы
    public function show($id)
    {
        $sphere = Sphere::findOrFail($id);
        return view('spheres.show', compact('sphere'));
    }

    // Форма для редактирования сферы
    public function edit($id)
    {
        $sphere = Sphere::findOrFail($id);
        return view('spheres.edit', compact('sphere'));
    }

    // Обновление сферы
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sphere = Sphere::findOrFail($id);
        $sphere->update($request->all());

        return redirect()->route('spheres.index')->with('success', 'Sphere updated successfully.');
    }

    // Удаление сферы
    public function destroy($id)
    {
        $sphere = Sphere::findOrFail($id);
        $sphere->delete();

        return redirect()->route('spheres.index')->with('success', 'Sphere deleted successfully.');
    }
}
