<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Отображение всех авторов
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    // Форма для создания нового автора
    public function create()
    {
        return view('authors.create');
    }

    // Сохранение нового автора
    public function store(Request $request)
    {
        $validated = $request->validate([
            'FullName' => 'required|string|max:100',
            'Email' => 'required|email|max:100',
            'ORCID' => 'required|string|max:20',
            'Role' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);
        $author = Author::create([
            'FullName'=> $validated['FullName'],
            'Email'=> $validated['Email'],
            'ORCID'=> $validated['ORCID'],
            'Role'=> $validated['Role'],
            'image' => $validated['image'],
        ]);
        $author->addMedia($request->file('image'))->toMediaCollection('authors');
        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    // Показ одного автора
    public function show($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.show', compact('author'));
    }

    // Форма для редактирования автора
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    // Обновление автора
    /*
    public function update(Request $request, $id)
    {
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'nullable|email|max:255',
            'ORCID' => 'nullable|string|max:255',
            'Role' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);
        //dd($request);
        $author = Author::findOrFail($id);
        //dd($author);
        $author->update($request->all());

        $oldImageId = $author->getFirstMediaId('image');
        if ($oldImageId && $request['image']) {
            $author->deleteMedia($oldImageId);
        }
        $author->addMedia($request->file('image'))->toMediaCollection('authors');
        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }
    */
    public function update(Request $request, Author $author)
    {
        // Валидация входящих данных
        $validated = $request->validate([
            'FullName' => 'required|string|max:100',
            'Email' => 'nullable|email|max:100',
            'ORCID' => 'nullable|string|max:20',
            'Role' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

        // Обновление данных автора
        $author->update([
            'FullName' => $validated['FullName'],
            'Email' => $validated['Email'],
            'ORCID' => $validated['ORCID'],
            'Role' => $validated['Role'],
        ]);

        // Проверка, была ли загружена новая картинка
        if ($request->hasFile('image')) {
            // Удаление старого изображения из медиаколлекции (если оно есть)
            $author->clearMediaCollection('authors');

            // Добавление нового изображения в медиаколлекцию
            $author->addMedia($request->file('image'))->toMediaCollection('authors');
        }

        // Редирект с сообщением об успешном обновлении
        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }


    // Удаление автора
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
