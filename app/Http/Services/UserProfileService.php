<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
class UserProfileService
{
    public function getStudentProfile()
    {
        return Auth::guard('user')->user();
    }

    public function getBookmarkCompanies()
    {
        $user = Auth::guard('user')->user();
        $user->load(['bookmarkCompanies.company.companyCategory' => function ($query) {
            $query->orderBy('order_no', 'asc');
        }]);
        return $user;
    }
}
