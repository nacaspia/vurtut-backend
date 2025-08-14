<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CategoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Translation;
use App\Repositories\CategoryRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(CategoryRepositoryImpl $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $parentCategories = Category::whereNotNull('parent_id')->whereNull('sub_category_id')->get();
        return view('admin.category.index', compact('categories','parentCategories','locales'));
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
    public function store(CategoryRequest $categoryRequest)
    {
        try {
            $image = NULL;
            $data = CategoryHelper::data($categoryRequest,$image);
            if ($this->categoryRepository->create($data)) {
                return redirect()->back()->with('success', Lang::get('admin.add_success'));
            }
        } catch (\Exception $exception) {

            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $categoryRequest, $id)
    {
        $category = Category::where('id',$id)->first();
        $image = $category['image'];
        try {
            $data = CategoryHelper::data($categoryRequest,$image);
            if ($this->categoryRepository->update($category['id'],$data)) {
                return redirect()->back()->with('success', Lang::get('admin.up_success'));
            }
        } catch (\Exception $exception) {

            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::where('id',$id)->first();
            if ($this->categoryRepository->delete($category['id'])) {
                return redirect()->back()->with('success', Lang::get('admin.delete_success'));
            }
        } catch (\Exception $exception) {

            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }
}
