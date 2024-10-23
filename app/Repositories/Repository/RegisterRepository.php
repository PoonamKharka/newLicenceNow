<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\RegisterRepositoryInterFace;
use Illuminate\Http\Request;
use App\Models\User;
use Datatables;
use Illuminate\Support\Facades\Hash;
use App\Services\ImageUploadService;

class RegisterRepository implements RegisterRepositoryInterFace
{
    protected $imageUploadService;

    // Constructor to inject the ImageUploadService
    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }


    /**
     * Display users list
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('isAdmin', '=', 0)->select('*')->orderBy('created_at', 'DESC');
            return datatables()->of($users)
                ->addColumn('userStatus', function ($row) {
                    if ($row->status == 1) {
                        return '<h5><span class="badge badge-success">Active</a></h5>';
                    } else {
                        return '<h5><span class="badge badge-success">Inactive</a></h5>';
                    }
                })
                ->editColumn('userType_id', function ($row) {
                    if ($row->userType_id == 2) {
                        return 'Instructor';
                    }
                })
                ->addColumn('username', function ($row) {
                    $name = $row->first_name . ' ' . $row->last_name;
                    return $name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('users.show', encrypt($row->id)) . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '" data-url="' . route('users.destroy', encrypt($row->id)) . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action', 'username', 'userStatus'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required',
            'email' => 'required|email|unique:users'
        ], [
            'first_name.required' => 'First Name field is required.',
            'password.required' => 'Password field is required.',
            'password_confirmation' => 'Password not matched',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field must be email address.'
        ]);
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        return $user;
    }

    public function view($id)
    {
        $userId = decrypt($id);
        return User::findOrFail($userId);
    }

    public function updateData(Request $request, $id)
    {
        $userId = decrypt($id);
        
         $request->validate([            
            'profile_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('profile_image')) {
            
            $imagePaths = $this->imageUploadService->uploadImage($request->file('profile_image'),'profile');
        }
         
          $updateData = $request->all();        
          if (!empty($imagePaths)) {
              $updateData['profile_image'] = $imagePaths; 
          }
  
        $updateUser = User::findOrFail($userId)->update($updateData);
        return $updateUser ;
    }

    public function delete($id)
    {
        $userId = decrypt($id);
        $user = User::find($userId);
        $user->delete();

        return redirect()->route('users.index')->with('status', 'User deleted successfully.');
    }
    public function userProfile($id){
        $userId = decrypt($id);
        return User::findOrFail($userId);
    }
}