<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    protected function authenticate($request, array $guards)
    {
        parent::authenticate($request, $guards);

        //https://laracasts.com/discuss/channels/code-review/adding-a-simple-is-active-check-to-user-authentication
        // Got here? good! it means the user is session authenticated. now we should check if it authorize
        if (!auth()->user()->is_active) {
            auth()->logout();
            $this->unauthenticated($request, $guards);
        }
    }
}
