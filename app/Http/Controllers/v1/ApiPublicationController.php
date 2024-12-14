<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\ScientificPublication;
use App\Models\MethodicalPublication;
use App\Models\Category;
use App\Models\Author;
use App\Http\Controllers\Controller;

class ApiPublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $publications = Publication::with(['category', 'authors'])->get();

        // Передаем список публикаций в представление index.blade.php
        return view('publications.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Получаем список категорий и авторов
        $categories = Category::all();
        $authors = Author::all();

        // Передаем данные в представление
        return view('publications.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        // Валидация данных запроса
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'EditionYear' => 'required|integer',
            'DOI' => 'nullable|string|max:255',
            'PagesCount' => 'nullable|integer',
            'Status' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'EditionPlace' => 'nullable|string|max:255', // только для научных публикаций
            'AnnotationEng' => 'nullable|string',       // только для научных публикаций
            'KeywordList' => 'nullable|string',         // только для научных публикаций
            'PrintStatus' => 'nullable|string|max:255', // только для методических публикаций
            'EditionLanguages' => 'nullable|string',    // только для методических публикаций
        ]);

        // Создаем публикацию
        $publication = Publication::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'EditionYear' => $validatedData['EditionYear'],
            'DOI' => $validatedData['DOI'],
            'PagesCount' => $validatedData['PagesCount'],
            'Status' => $validatedData['Status'],
            'category_id' => $validatedData['category_id'],
            'sphere_id' => $request->input('sphere_id'),
        ]);

        // Определяем тип публикации по категории
        $category = Category::find($validatedData['category_id']);
        if ($category->Type === 'scientific') {
            // Научная публикация
            ScientificPublication::create([
                'publication_id' => $publication->id,
                'EditionPlace' => $validatedData['EditionPlace'],
                'AnnotationEng' => $validatedData['AnnotationEng'],
                'KeywordList' => $validatedData['KeywordList'],
            ]);
        } elseif ($category->Type === 'methodical') {
            // Методическая публикация
            MethodicalPublication::create([
                'publication_id' => $publication->id,
                'PrintStatus' => $validatedData['PrintStatus'],
                'EditionLanguages' => $validatedData['EditionLanguages'],
            ]);
        }

        // Связываем публикацию с авторами
        $publication->authors()->sync($validatedData['authors']);

        return redirect()->route('publications.index')->with('success', 'Publication created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $publication = Publication::with(['authors', 'category'])->findOrFail($id);

        return view('publications.show', compact('publication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Находим публикацию по ID
        $publication = Publication::with('category', 'authors', 'scientificPublication', 'methodicalPublication')->findOrFail($id);

        // Получаем список категорий и авторов
        $categories = Category::all();
        $authors = Author::all();

        // Передаем данные в представление
        return view('publications.edit', compact('publication', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'EditionYear' => 'required|integer',
            'PagesCount' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ]);

        $publication = Publication::findOrFail($id);
        $publication->update([
            'title' => $request->title,
            'description' => $request->description,
            'EditionYear' => $request->EditionYear,
            'PagesCount' => $request->PagesCount,
            'category_id' => $request->category_id,
        ]);

        // Синхронизируем авторов с публикацией
        $publication->authors()->sync($request->authors);

        return redirect()->route('publications.index')->with('success', 'Publication updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $publication = Publication::findOrFail($id);
        $publication->delete();

        return redirect()->route('publications.index')->with('success', 'Publication deleted successfully.');
    }
}
