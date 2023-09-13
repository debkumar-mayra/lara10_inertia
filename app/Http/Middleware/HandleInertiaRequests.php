<?php

namespace App\Http\Middleware;

use Throwable;
use Inertia\Inertia;
use Inertia\Middleware;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);

        // Inertia::version(fn () => $version); /
    }


// public function render($request, Throwable $e)
// {
//     $response = parent::render($request, $e);

//     if (! app()->environment(['local', 'testing']) && in_array($response->status(), [500, 503, 404, 403])) {

//         // return back()->with([
//         //     'error' => 'The page expired, please try again.',
//         // ]);

//         // return Inertia::render('Error', ['status' => $response->status()])
//         //     ->toResponse($request)
//         //     ->setStatusCode($response->status());
//     } elseif ($response->status() === 419) {
//         return back()->with([
//             'error' => 'The page expired, please try again.',
//         ]);
//     }

//     return $response;
// }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {

        $settings = SiteSetting::get(['key','value']);
        $setting = [];
        foreach($settings as $value ){
            if($value->key == 'logo'){
                $value->value = $value->value ? URL::route('image', ['path' => $value->value, 'w' => 100, 'h' => 45, 'fit' => 'stretch']) : null;
            }
            $setting[$value->key] = $value->value;
        }
        // dd($setting);


        return array_merge(parent::share($request), [
            'appName'=>config('app.name'),
            'logo'=>$setting['logo'],
            'perPage'=>$setting['per_page'],
            'dateFormat'=>$setting['date_format'],
            'auth'=>[
                'user'=> [
                    'full_name'=>auth()->user()->full_name ?? null,
                    'profile_photo'=>  isset(auth()->user()->profile_photo_path) ? URL::route('image', ['path' => auth()->user()->profile_photo_path, 'w' => 80, 'h' => 80, 'fit' => 'stretch']) : null,
                  ]
                ],
            'baseUrl'=>url(),
            'theme'=>[
                'mainColor'=>$setting['main_color'],
                'buttonColor'=>$setting['button_color'],
                'hoverColor'=>$setting['hover_color'],
            ],
            'isLogin'=>auth()->user() ? true : false,
            'isUser'=>(auth()->user() && auth()->user()->role_name == 'USER') ? true : false,
            'isAdmin'=>(auth()->user() &&  auth()->user()->role_name == 'SUPER-ADMIN') ? true : false,
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
                'info' => fn () => $request->session()->get('info'),
                'warning' => fn () => $request->session()->get('warning'),
            ],
        ]);
    }
}
