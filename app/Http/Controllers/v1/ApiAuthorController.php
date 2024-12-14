<?php

namespace App\Http\Controllers\v1;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiAuthorController extends Controller
{
    // Отображение всех авторов
    public function index()
    {
        $authors = Author::all();
        //return view('authors.index', compact('authors'));
        return response()->json($authors)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Сохранение нового автора
    public function store(Request $request)
    {
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'nullable|email|max:255',
            'ORCID' => 'nullable|string|max:255',
            'Role' => 'nullable|string|max:255',
        ]);

        Author::create($request->all());

        return response()->json($request, 201)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Показ одного автора
    public function show($id)
    {
        $author = Author::findOrFail($id);
        //return view('authors.show', compact('author'));
        return response()->json($author)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }


    // Обновление автора
    public function update(Request $request, $id)
    {
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'nullable|email|max:255',
            'ORCID' => 'nullable|string|max:255',
            'Role' => 'nullable|string|max:255',
        ]);

        $author = Author::findOrFail($id);
        $author->update($request->all());

        //return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
        return response()->json($author, 200)
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }

    // Удаление автора
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        //return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
        return response()->json(null, 204);
    }
}
