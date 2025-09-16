<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\WholesaleInquiry;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }
    
    public function contact()
    {
        return view('pages.contact');
    }
    
    public function wholesale()
    {
        return view('pages.wholesale');
    }
    
    // Wholesale inquiry submit method
    public function wholesaleStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'product_type' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer|min:1',
            'message' => 'required|string|max:1000',
        ]);

        try {
            WholesaleInquiry::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'company' => $validated['company'] ?? null,
                'product_type' => $validated['product_type'] ?? null,
                'quantity' => $validated['quantity'] ?? null,
                'message' => $validated['message'],
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->back()->with('success', 'Thank you! Your wholesale inquiry has been submitted successfully. We will contact you within 24 hours.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}