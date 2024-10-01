<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentPolicyArticle;
use Illuminate\Support\Str;

class PaymentPolicyArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paymentPolicyArticle = PaymentPolicyArticle::all();
            return datatables()
                ->of($paymentPolicyArticle)
                ->addColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50, '...');
                })                
                ->addColumn('action', function ($row) {
                    $editUrl = route('payment-policy-articles.edit', encrypt($row->id));
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['description','action'])
                ->make(true);
        }
        return view('admin.article.paymentpolicyarticles.index');
    }
    public function create()
    {
        return view('admin.article.paymentpolicyarticles.create-update');
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
        $paymentPolicyArticle = PaymentPolicyArticle::updateOrCreate(
            ['id' => $request->input('id')],
            $validatedData
        );

        // Redirect based on update or create
        if ($request->input('id')) {
           $existingID=$request->input('id');
                       
            return redirect()
                ->route('payment-policy-articles.edit', encrypt($existingID))
                ->with('success', 'Data updated successfully.');
        } else {
            return redirect()
                ->route('payment-policy-articles.index')
                ->with('success', 'Data created successfully.');
        }
    }

    public function edit($id)
    {
        $paymentPolicyArticleId = decrypt($id);

        $paymentPolicyArticles = PaymentPolicyArticle::findOrFail($paymentPolicyArticleId);

        return view('admin.article.paymentpolicyarticles.create-update', compact('paymentPolicyArticles'));
    }
    
    public function destroy($id)
    {
        $paymentPolicyArticle = PaymentPolicyArticle::find($id);
        $paymentPolicyArticle->delete();
        return redirect()->route('payment-policy-articles.index')->with('status', 'Payment policy deleted successfully.');
    }
}