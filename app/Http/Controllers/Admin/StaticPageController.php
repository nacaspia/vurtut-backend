<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StaticPageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StaticPageRequest;
use App\Models\StaticPage;
use App\Models\Translation;
use App\Repositories\StaticPageRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class StaticPageController extends Controller
{

    protected $staticPageRepository;

    public function __construct(StaticPageRepositoryImpl $staticPageRepository)
    {
        $this->staticPageRepository = $staticPageRepository;
    }

    public function index()
    {
        $static_pages = $this->staticPageRepository->getAll();
        return view('admin.static-page.index',compact('static_pages'));
    }

    public function create()
    {
        $locales = Translation::where('status',1)->get();
        return view('admin.static-page.create',compact('locales'));
    }

    public function store(StaticPageRequest $staticPageRequest)
    {
        try {
            $image = NULL;
            $data = StaticPageHelper::data($staticPageRequest,$image);
            if ($this->staticPageRepository->create($data)) {
                return redirect()->back()->with('success', Lang::get('admin.add_success'));
            } else{
                return redirect()->back()->with('success', Lang::get('admin.add_error'));
            }
        } catch (\Exception $exception) {

            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    public function show(StaticPage $staticPage)
    {
        //
    }

    public function edit($id)
    {
        $locales = Translation::where('status',1)->get();
        $staticPage = StaticPage::where('id',$id)->first();
        return view('admin.static-page.edit',compact('locales', 'staticPage'));
    }


    public function update($id,StaticPageRequest $staticPageRequest)
    {
        $staticPage = StaticPage::where('id',$id)->first();
        $image = $staticPage['image'];
        try {
            $data = StaticPageHelper::data($staticPageRequest,$image);
            if ($this->staticPageRepository->update($staticPage['id'],$data)) {
                return redirect()->back()->with('success', Lang::get('admin.up_success'));
            } else{
                return redirect()->back()->with('success', Lang::get('admin.up_error'));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $staticPage = StaticPage::where('id',$id)->first();
            if ($this->staticPageRepository->delete($staticPage['id'])) {
                return redirect()->back()->with('success', Lang::get('admin.delete_success'));
            } else{
                return redirect()->back()->with('success', Lang::get('admin.delete_error'));
            }
        } catch (\Exception $exception) {

            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }
}
