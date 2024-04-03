<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\CompanyData;
use App\UserCompanyRelationData;
use App\Http\Services\UserProfileService;
use App\Http\Services\CompanyReportService;

class UserProfileController extends Controller
{
    protected $userProfileService;
    private $companyReportService;

    public function __construct(UserProfileService $userProfileService, CompanyReportService $companyReportService)
    {
        /**
         * call the middleware method from the controller's constructor
         * instead of attaching it in the route definition directly
         */
        $this->userProfileService = $userProfileService;
        $this->companyReportService = $companyReportService;
    }

    public function index()
    {
        $isStudent = false;
        $changeProfileUrl = '';
        $profile = $this->userProfileService->getStudentProfile();

        if ($profile->user_attribute == SOCIETY) {
            $changeProfileUrl = route('user.change-profile');
            $isStudent = false;
        }

        if ($profile->user_attribute == STUDENT) {
            $changeProfileUrl = route('user.change-profile.student');
            $isStudent = true;
        }

        if (empty($changeProfileUrl)) {
            $changeProfileUrl = route('user.change-profile');
        }

        $user = Auth::guard(USER)->user();
        $userCompanyRelation = UserCompanyRelationData::where(['user_id' => $user->user_id])
            ->whereNull('deleted_at')
            ->orderBy('year_join_work', 'ASC')
            ->orderBy('user_company_relation_retirement_year', 'ASC')
            ->take(50)->get();

        $listCompanyIds = [];
        foreach ($userCompanyRelation as $companyUser) {
            if (!in_array($companyUser->company_id, $listCompanyIds)) {
                array_push($listCompanyIds, $companyUser->company_id);
            }
        }

        $listCompany = CompanyData::whereIn('company_id', $listCompanyIds)
            ->get(['company_id', 'company_name', 'company_name_alias']);

        return view('user::pages.account.setting', compact(
            'profile',
            'changeProfileUrl',
            'isStudent',
            'listCompany',
            'userCompanyRelation'
        ));
    }

    public function editPhoneNumber()
    {
        $profile = $this->userProfileService->getStudentProfile();
        return view('user::user.edit-phone.edit-phone', compact('profile'));
    }
}
