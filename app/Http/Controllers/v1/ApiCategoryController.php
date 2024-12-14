<?php

namespace App\Http\Controllers\v1;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ApiCategoryController extends Controller
{
    // Отображение всех категорий
    public function index()
    {
        $categories = Category::all();
        //return response()->json($categories);
        return response()->json($categories)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Сохранение новой категории
    public function store(Request $request)
    {
        //return response()->json('{Hello}');
        $request->validate([
            'Name' => 'required|string|max:50',
            'Type' => 'required|string|max:50',
        ]);

        Category::create($request->all());

        return response()->json($request, 201)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Показ одной категории
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
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

        return response()->json($category, 200)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Удаление категории
    public function destroy($id)
    {
        Category::destroy($id);

        return response()->json(null, 204);
    }
}
