<?php

namespace App\Repositories\Repository;

use App\Models\Article;
use App\Repositories\InterFaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $article = Article::all();
            return datatables()
                ->of($article)
                ->addColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50, '...');
                })                
                ->addColumn('action', function ($row) {
                    $editUrl = route('articles.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.article.index');
    }
    public function create()
    {
        return view('admin.article.create-update');
    }
    // perform create and update lesson
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required',            
            'description' => 'required',
        ]);

       
        // Determine if we're updating or creating
        $article = Article::updateOrCreate(
            ['id' => $request->input('id')],
            $validatedData
        );

        // Redirect based on update or create
        if ($request->input('id')) {
           $existingID=$request->input('id');
                       
            return redirect()
                ->route('articles.edit', encrypt($existingID))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()
                ->route('articles.index')
                ->with('success', 'Data created successfully.');
        }
    }

    public function edit($id)
    {
        $articleId = decrypt($id);

        $article = Article::findOrFail($articleId);

        return view('admin.article.create-update', compact('article'));
    }
    
    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('articles.index')->with('status', 'Artica deleted successfully.');
    }
}