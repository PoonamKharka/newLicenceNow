<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NavMenu;
use Illuminate\Support\Str;

class NavMenuController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $navMenu = NavMenu::all();
            return datatables()
                ->of($navMenu)
                ->addColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50, '...');
                })                
                ->addColumn('action', function ($row) {
                    $editUrl = route('nav-menu.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['description','action'])
                ->make(true);
        }
        return view('admin.navmenu.index');
    }
    public function create()
    {
        return view('admin.navmenu.create-update');
    }
    // perform create and update lesson
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required',            
            'slug' => 'required',
        ]);
        $existingID=$request->input('id')??null;
        $slug = $this->createUniqueSlug($request->input('slug'), $existingID);
        $inputArr=[
            'title' => $request->input('title'),            
            'slug' =>  $slug,
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ];

        // Determine if we're updating or creating
        $navMenu = NavMenu::updateOrCreate(
            ['id' => $request->input('id')],
            $inputArr
        );

        if ($request->input('id')) {
           
                       
            return redirect()
                ->route('nav-menu.edit', encrypt($existingID))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()
                ->route('nav-menu.index')
                ->with('success', 'Data created successfully.');
        }
    }
    function createUniqueSlug($title, $existingID=NULL)
    {        
        
        $slug = Str::slug($title);
        $originalSlug = $slug;
        if($existingID)
        {
            return $slug;
        }
        $existingSlugs = NavMenu::slugIsExist($originalSlug);
        if (!$existingSlugs->contains($originalSlug)) {
            return $slug;
        }
        $max = 0;
        foreach ($existingSlugs as $existingSlug) {
            if (preg_match('/^' . preg_quote($originalSlug, '/') . '-(\d+)$/', $existingSlug, $matches)) {
                $max = max($max, (int) $matches[1]);
            }
        }        
        return $originalSlug . '-' . ($max + 1);
    }

    public function edit($id)
    {
        $navMenuId = decrypt($id);

        $navMenu = NavMenu::findOrFail($navMenuId);

        return view('admin.navmenu.create-update', compact('navMenu'));
    }
    
    public function destroy($id)
    {
        $navMenu = NavMenu::find($id);
        $navMenu->delete();
        return redirect()->route('nav-menu.index')->with('status', 'Nav Menu deleted successfully.');
    }
    
}