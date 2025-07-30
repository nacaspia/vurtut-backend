<?php
namespace App\View\Components\Site;
use App\Models\Category;
use App\Models\City;
use App\Models\CompanyCategory;
use App\Models\Setting;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $currentLang = 'az';
        $categories = Category::where(['status' => 1])->whereNull(['parent_id'])->orderBy('title->'.$currentLang,'ASC')->get();
        $cities = City::where(['status' => 1])->whereNull(['sub_region_id'])->with('subRegions')->orderBy('name->'.$currentLang,'ASC')->get();
        $settings = Setting::first();
        return view('components.site.header', compact('currentLang','categories','cities','settings'));
    }
}
