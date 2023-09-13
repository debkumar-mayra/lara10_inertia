<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\FileHelperTrait;
use App\Models\CmsDetail;
use Inertia\Inertia;

class CmsController extends Controller
{
    use FileHelperTrait;
    /**
     * function details
     * @date date
     * @param
     * @return view
     * @author Gourab
     */
    public function index()
    {
        try {
            $filters = request()->all('title');
            $pages = Cms::filter(request()->only('title'))
            ->ordering(request()->only('fieldName','shortBy'))
            ->orderBy('id','desc')
            ->paginate(request()->perPage ?? $this->per_page)
            ->withQueryString()->through(fn ($user) => [
                'id' => $user->id,
                'title' => $user->title,
                'slug' => $user->slug,
            ]);
            return Inertia::render('Admin/cms/List',compact('pages','filters'));

        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return back()->with('error','Server error');
        }
    }


    /**
     * function details
     * @date date
     * @param
     * @return view
     * @author Gourab
     */
    public function edit($slug)
    {
        try {
            $cms = Cms::where('slug',$slug)->first();
           
            return Inertia::render('Admin/cms/CreateEdit',compact('cms','slug'));

        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return back()->with('error','Server error');
        }
    }


    /**
     * function details
     * @date date
     * @param
     * @return view
     * @author Gourab
     */
    public function update(Request $request, $slug)
    {
        dd($request->all());
        
        try{
            $page = Cms::find($slug);
            $page->title = $request->title;
            $page->text_content = $request->content;
            $page->save();

            return redirect()->route('admin.cms.index')->with('success', $page->title . ' has been updated');
            
        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return back()->with('error','Server error');
        }
        
    }
}
