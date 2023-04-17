<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Throwable;
use Inertia\Inertia;

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
        return array_merge(parent::share($request), [
            'auth'=>[
                'user'=> [
                    'full_name'=>auth()->user()->full_name ?? null,
                    'profile_photo_url'=>auth()->user()->profile_photo_url ?? null,
                  ]
                ],
            'baseUrl'=>url(),
            'isLogin'=>auth()->user() ? true : false,
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
                'info' => fn () => $request->session()->get('info'),
                'warning' => fn () => $request->session()->get('warning'),
            ],
        ]);
    }
}
