<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const CATEGORIES_PAGINATE = 5;

    protected function createCategory(array $data)
    {
        return Category::create($data);
    }

    protected function updateCategory(array $data, $id)
    {
        try {
            $category = Category::findOrFail($id);

            return $category->update($data);
        } catch (Exception $e) {
            return redirect()->route('admin');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        // paginate(self::CATEGORIES_PAGINATE);

        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Category::validateCategory($request->all());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput($request->all());
        }
        $category = $this->createCategory($request->all());

        return redirect()->route('admin.categories.show', ['id' => $category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);

            return view('backend.categories.view', compact('category'));
        } catch (Exception $e) {
            return redirect()->route('homepage');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);

            return view('backend.categories.update', compact('category'));
        } catch (Exception $e) {
            return redirect()->route('homepage');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Category::validateCategory($request->all());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput($request->all());
        }
        $this->updateCategory($request->all(), $id);

        return redirect()->route('admin.categories.show', $id);
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
            $category = Category::findOrFail($id);
            $category->delete();
            Post::whereCategoryId($id)->update(['category_id' => 0, 'status' => 0]);

            return redirect()->route('admin.categories.index');
        } catch (Exception $e) {
            return redirect()->route('admin');
        }
    }

    /**
     * Api display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexApi()
    {
        $categories = Category::all();

        $response = $categories;

        return response()->json($response);
    }

    /**
     * Api store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeApi(Request $request)
    {
        $validate = Category::validateCategory($request->all());
        $create = Category::create($request->all());

        return response()->json($create);
    }

    /**
     * Api display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showApi($id)
    {
            $category = Category::where('id', $id)->first();
            
            return response()->json($category);
    }

    /**
     * Api update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateApi(Request $request, $id)
    {
        $validate = Category::validateCategory($request->all());
        $edit = Category::find($id)->update($request->all());

        return response()->json($edit);
    }

    /**
     * Api destroy the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyApi($id)
    {
        Category::find($id)->delete();
        return response()->json(['done']);
    }

    public function vueHome(){
        return view('backend.categories.indexVue');
    }

}
