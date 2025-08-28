<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Filament\Client\Pages\Verification;
class CheckVerificationStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        // Ensure the user is authenticated and is not an admin
        if ($user && !$user->is_admin) {
            $isApproved = $user->verification_status === 'approved';
            $isVerificationRoute = $request->routeIs('filament.client.pages.verification');
            $isLogoutRoute = $request->routeIs('filament.client.auth.logout');

            // If status is NOT 'approved' and we are NOT on the verification page
            // and NOT on the logout page, redirect to verification
            if (!$isApproved && !$isVerificationRoute && !$isLogoutRoute) {
                return redirect()->route('filament.client.pages.verification');
            }
            // If status is 'approved' and we try to access the verification page,
            // redirect to the dashboard
            if ($isApproved && $isVerificationRoute) {
                return redirect()->route('filament.client.pages.dashboard');
            }
        }
        return $next($request);
    }
}
