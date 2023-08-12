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
    public function index(Request $request)
    {
        try {
            $pages = Cms::query();

        if($request->title){            
            $pages = $pages->where('title','like', '%'.$request->title.'%');
        }

        if($request->fieldName && $request->shortBy){
            $pages->orderBy($request->fieldName,$request->shortBy);
        }

        $perPage = 5;
       if($request->perPage){
        $perPage = $request->perPage;
       }

        $pages = $pages->orderBy('id','desc')->paginate($perPage)->withQueryString();
        return Inertia::render('Admin/cms/List',['pages'=>$pages]);

        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            abort(500);
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
            //return redirect()->back()->with('error', "Something went wrong, please try again!");
            abort(500);
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
        // dd($slug);
            $page = Cms::find($slug);
            $page->title = $request->title;
            $page->text_content = $request->content;
            $page->save();

            return redirect()->route('admin.cms.index')->with('success', $page->title . ' has been updated');
        
    }
}
