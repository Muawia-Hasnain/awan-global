<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WholesaleInquiry;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inquiries = WholesaleInquiry::all();
        return view('admin.inquiries.index', compact('inquiries'));
    }

    /**
     * Display the specified resource.
     */
    public function show(WholesaleInquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WholesaleInquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')
                         ->with('success', 'Inquiry deleted successfully!');
    }
}
