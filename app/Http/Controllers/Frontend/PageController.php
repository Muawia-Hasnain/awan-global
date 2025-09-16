<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WholesaleInquiry;

class PageController extends Controller
{
    public function about()
    {
        return view('frontend.home.about');
    }
    
    public function contact()
    {
        return view('frontend.home.contact');
    }
    
    public function privacyPolicy()
    {
        return view('frontend.home.privacy-policy');
    }

    public function wholesale()
    {
        return view('frontend.home.wholesale');
    }
    
    public function wholesaleStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'company' => 'nullable|string',
            'message' => 'required|string'
        ]);
        
        WholesaleInquiry::create($request->all());
        
        return redirect()->back()->with('success', 'Inquiry submitted successfully!');
    }

    // Support/Deals/etc. stubs referenced by routes
    public function help() { return view('frontend.home.index'); }
    public function faq() { return view('frontend.home.index'); }
    public function liveChat() { return view('frontend.home.index'); }
    public function deals() { return view('frontend.home.index'); }
    public function flashSale() { return view('frontend.home.index'); }
    public function coupons() { return view('frontend.home.index'); }
    public function specialOffers() { return view('frontend.home.index'); }
    public function vendors() { return view('frontend.home.index'); }
    public function vendorShow($slug) { return view('frontend.home.index'); }
    public function giftCards() { return view('frontend.home.index'); }
    public function loyaltyProgram() { return view('frontend.home.index'); }
    public function newsletterSubscribe(Request $request) { return back()->with('success', 'Subscribed'); }
    public function newsletterUnsubscribe($token) { return view('frontend.home.index'); }
}