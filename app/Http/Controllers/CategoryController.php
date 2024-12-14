<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Отображение всех категорий
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Форма для создания новой категории
    public function create()
    {
        return view('categories.create');
    }

    // Сохранение новой категории
    public function store(Request $request)
    {
        echo "alert({$request})";
        $request->validate([
            'Name' => 'required|string|max:50',
            'Type' => 'required|string|max:50',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Показ одной категории
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    // Форма для редактирования категории
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Обновление категории
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'Type' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Удаление категории
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
