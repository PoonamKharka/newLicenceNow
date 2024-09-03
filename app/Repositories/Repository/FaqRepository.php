<?php

namespace App\Repositories\Repository;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Repositories\InterFaces\FaqRepositoryInterface;

class FaqRepository implements FaqRepositoryInterface
{
    public function getAllFaqs(Request $request)
    {
        $faqs = Faq::all();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function profile()
    {
        return view('admin.faqs.profile');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faqDetails = new Faq();

        // Prepare FAQ details array
        $faqDetails = [
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ];

        // Find existing FAQ or create a new one
        $faq = Faq::where('question', $request->input('question'))->first();

        if ($faq) {
            $updateDetails = $faq->update($faqDetails);
        } else {
            $updateDetails = Faq::create($faqDetails);
        }
        if ($updateDetails) {
            // Redirect with success message
            return redirect()->route('faqs.index')->with('success', 'FAQ saved successfully.');
        } else {
            return back()->with('error', 'Failed to save Faq.');
        }

    }

    public function edit($id)
    {
        $faqs = Faq::findOrFail($id);
        return view('admin.faqs.profile', compact('faqs'));
    }
}
