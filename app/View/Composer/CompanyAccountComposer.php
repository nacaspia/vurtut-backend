<?php

namespace App\View\Composer;

use App\Models\Category;
use App\Models\Company;
use Illuminate\View\View;

class CompanyAccountComposer
{
    public function compose(View $view)
    {
        $company = auth('company')->user();
        $companyId = ($company->parent_id == 0)? $company->id:$company->parent_id;
        $companyParentCount = Company::where(['parent_id' => $companyId, 'status'=>1 ])->count();
        $company_category = Category::where(['parent_id'=>$company['category_id'],'status' => 1])->get();

        $view->with(['company' => $company,'companyParentCount'=>$companyParentCount,'company_category'=>$company_category]);
    }
}
