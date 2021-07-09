<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'frontend';

    public function __construct()
    {
        if ( in_array( request()->route()->getName(), [ 'login', 'password.request', 'password.reset', 'password.confirm' ] )
            && \request()->route()->parameter( 'guard' ) == 'admin'
        )
        {
            $this->rootView = 'admin_auth';
        } elseif ( request()->is( 'admin/*' ) || request()->is( 'admin' ) )
        {
            $this->rootView = 'admin';
        } else
        {
            $this->rootView = 'frontend';
        }
    }

    /**
     * Determine the current asset version.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version( Request $request )
    {
        return parent::version( $request );
    }

    /**
     * Define the props that are shared by default.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function share( Request $request )
    {
        $user = NULL;

        if ( Auth::check() )
        {
            $user = $request->user( 'user' ) ? : $request->user( 'admin' ) ? : NULL;
        }

        return array_merge( parent::share( $request ), [
            'auth'           => [
                'user' => $user,
            ],
            'appName'        => get_setting( 'site_title', 'اسم النظام' ),
            'adminPanelLogo' => get_setting( 'admin_panel_logo', asset( 'assets/admin/custom/img/logo_placeholder.png' ) ),
        ] );
    }
}
