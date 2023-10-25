<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Str;

class ShortLinkController extends Controller
{
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();
        return view('shortenLink', compact('shortLinks'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);

        ShortLink::create($input);

        return redirect('generate-shorten-link')->withSuccess('Shorten link generated successfully');
    }

    public function shortenLink($code)
    {
        $find = ShortLink::where('code',$code)->first();

        return redirect($find->link);

    }

    public function destroy(ShortLink $shortLink)
    {
        $shortLink->delete();

        return redirect()->back()->with('flash', [
            'banner' => 'URL Deleted!',
            'bannerStyle' => 'success'
        ]);
    }

}
