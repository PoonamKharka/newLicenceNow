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
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        // Check if FAQ already exists by ID
        $faqId = $request->input('id');

        if ($faqId) {
            // Update existing FAQ
            $faq = Faq::find($faqId);

            if ($faq) {
                $faq->question = $request->input('question');
                $faq->answer = $request->input('answer');
                $faq->save();

                return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
            } else {
                return back()->with('error', 'FAQ not found.');
            }
        } else {
            // Create new FAQ
            $faq = Faq::create([
                'question' => $request->input('question'),
                'answer' => $request->input('answer'),
            ]);

            return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
        }
    }


    public function edit($id)
    {
        $faqs = Faq::findOrFail($id);
        return view('admin.faqs.profile', compact('faqs'));
    }
}
