<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CountryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\Country;
use App\Models\Translation;
use App\Repositories\CountryRepositoryImpl;
use Illuminate\Support\Facades\Lang;

class CountryController extends Controller
{
    protected $countryRepository;

    public function __construct(CountryRepositoryImpl $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function index()
    {
        $countries = $this->countryRepository->getAll();
        $locales = Translation::where('status',1)->get();
        return view('admin.countries.index', compact('countries','locales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $countryRequest)
    {
        try {
            $data = CountryHelper::data($countryRequest);
            if ($this->countryRepository->create($data)) {
                return redirect()->back()->with('success', Lang::get('admin.add_success'));
            }
        } catch (\Exception $exception) {

            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $countryRequest, $id)
    {
        $country = Country::where('id',$id)->first();
        try {
            $data = CountryHelper::data($countryRequest);
            if ($this->countryRepository->update($country['id'],$data)) {
                return redirect()->back()->with('success', Lang::get('admin.up_success'));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Country::where('id',$id)->first();
            if ($this->countryRepository->delete($category['id'])) {
                return redirect()->back()->with('success', Lang::get('admin.delete_success'));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }
}
