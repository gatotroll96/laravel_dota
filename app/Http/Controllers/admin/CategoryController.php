<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Helper\helper;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = category::all();
        
        return view('admin.category.index', ['category' => $category]);
    }

    public function getadd()
    {
        
        return view('admin.category.add');
    }

    public function postadd(Request $request)
    {
        $this->validate($request,
            [   'name'             => 'required|unique:category|min:3|max:255'],
            [   'name.required'    => 'Vui lòng điền vào chỗ trống !!!',
                'name.unique'      => 'Đã tồn tại !!!',
                'name.min'         => 'Độ dài từ 3 đến 255 ký tự !!!',
                'name.max'         => 'Độ dài từ 3 đến 255 ký tự !!!'
            ]);
        
        $addCategory = new category();
        $addCategory->name = $request->name;
        $addCategory->tenkdau = Helper::changeName($request->name);
        $addCategory->save();
        return redirect('admin/category')->with('thongbao', 'Added');
    }

  
    public function getedit($id)
    {
        $nameCate = category::find($id)->name;
        return view('admin.category.edit', ['nameCate' => $nameCate, 'id'=>$id]);

    }

    public function postedit(Request $request, $id)
    {
        
        $this->validate($request,
            [   'name'             => 'required|unique:category|min:3|max:255'],
            [   'name.required'    => 'Vui lòng điền vào chỗ trống !!!',
                'name.unique'      => 'Đã tồn tại !!!',
                'name.min'         => 'Độ dài từ 3 đến 255 ký tự !!!',
                'name.max'         => 'Độ dài từ 3 đến 255 ký tự !!!'
            ]
        );


        $editCategory = category::find($id);
        $editCategory->name = $request->name;
        $editCategory->tenkdau = Helper::changeName($request->name);
        $editCategory->save();
        return redirect('admin/category')->with('thongbao', 'Edited');
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        $delCategory = category::findOrFail($request->input('category_id'));
        $delCategory->delete();
        return back()->with('thongbao', 'Deleted');
    }
}
