<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicyArticle;
use Illuminate\Support\Str;

class PrivacyPolicyArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $privacyPolicyArticles = PrivacyPolicyArticle::orderBy('created_at', 'DESC')->get();
            return datatables()
                ->of($privacyPolicyArticles)
                ->addColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50, '...');
                })                
                ->addColumn('action', function ($row) {
                    $editUrl = route('privacy-policy-articles.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['description','action'])
                ->make(true);
        }
        return view('admin.article.privacypolicyarticles.index');
    }
    public function create()
    {
        return view('admin.article.privacypolicyarticles.create-update');
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
        $privacyPolicyArticles = PrivacyPolicyArticle::updateOrCreate(
            ['id' => $request->input('id')],
            $validatedData
        );

        // Redirect based on update or create
        if ($request->input('id')) {
           $existingID=$request->input('id');
                       
            return redirect()
                ->route('privacy-policy-articles.edit', encrypt($existingID))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()
                ->route('privacy-policy-articles.index')
                ->with('success', 'Data created successfully.');
        }
    }

    public function edit($id)
    {
        $privacyPolicyArticlesId = decrypt($id);

        $privacyPolicyArticles = PrivacyPolicyArticle::findOrFail($privacyPolicyArticlesId);

        return view('admin.article.privacypolicyarticles.create-update', compact('privacyPolicyArticles'));
    }
    
    public function destroy($id)
    {
        $privacyPolicyArticles = PrivacyPolicyArticle::find($id);
        $privacyPolicyArticles->delete();
        return redirect()->route('privacy-policy-articles.index')->with('status', 'Privacy policy deleted successfully.');
    }
}