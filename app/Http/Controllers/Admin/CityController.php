<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Translation;
use App\Repositories\CityRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class CityController extends Controller
{
    protected $cityRepository;

    public function __construct(CityRepositoryImpl $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $cities = $this->cityRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $countries = Country::where('status',1)->get();
        $mainCity = City::whereNull('sub_region_id')->where('status',1)->get();
        return view('admin.city.index', compact('cities','locales','countries','mainCity'));
    }

    public function create()
    {

    }

    public function store(CityRequest $cityRequest)
    {
        try {
            $data = CityHelper::data($cityRequest);
            if ($this->cityRepository->create($data)) {
                return redirect()->back()->with('success', Lang::get('admin.add_success'));
            }
        } catch (\Exception $exception) {

            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(CityRequest $cityRequest, $id)
    {
        $city = City::where('id',$id)->first();
        try {
            $data = CityHelper::data($cityRequest,$city);
            if ($this->cityRepository->update($city['id'],$data)) {
                return redirect()->back()->with('success', Lang::get('admin.up_success'));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $city = City::where('id',$id)->first();
            if ($this->cityRepository->delete($city['id'])) {
                return redirect()->back()->with('success', Lang::get('admin.delete_success'));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }
}
