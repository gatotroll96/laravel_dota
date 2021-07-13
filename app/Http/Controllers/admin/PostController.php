<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\post;
use App\Helper\helper;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Collection;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = DB::table('post')
                ->leftJoin('category', 'post.category_id', '=', 'category.id')
                ->leftJoin('comment', 'post.id', '=', 'comment.post_id')
                ->select('post.*','category.name as category', DB::raw('count(comment.id) as soluotxem'))
                ->where('post.id','>',0)                
                ->groupBy('post.id')
                ->paginate(3);
        
        return view('admin.post.index', ['post' => $post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $category = DB::table('category')
                    ->select('name','id')
                    ->get()->toArray();
        return view('admin.post.add', ['category' => $category]);
    }

    public function add(Request $request)
    {
        
        $this->validate($request,
            [   'name'             => 'required|unique:category|min:3|max:255',
                'category'         => 'required|not_in:default',
                'content'          => 'required'
            ],
            [   'name.required'    => 'Vui lòng điền vào chỗ trống !!!',
                'name.unique'      => 'Đã tồn tại !!!',
                'name.min'         => 'Độ dài từ 3 đến 255 ký tự !!!',
                'name.max'         => 'Độ dài từ 3 đến 255 ký tự !!!',
                'category.required'         => 'Chọn Category',
                'category.not_in'  => 'Chọn Category',
                'content.required' => 'Nhập nội dung'
            ]);

        
        
        if($request->hasFile('img')){
            $img = $request->file('img');
            $extension = $img->getClientOriginalExtension();
            $nameImg = uniqid().'_dotatoo.'.$extension;
            
            $img->move('upload/post',$nameImg); 
        }else{
            $nameImg = 'default_dotatoo.jpg';
        }
        DB::table('post')->insert(
        [   'name'          =>  $request->name,
            'tenkdau'       =>  Helper::changeName($request->name),
            'category_id'   =>  $request->category,
            'content'       =>  $request->content,
            'images'        =>  $nameImg,
            'status'        =>  0
        ]);
        return redirect('admin/post')->with('thongbao', 'Added');   
    }


    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('category')
                    ->select('name','id')
                    ->get()->toArray();

        $data = DB::table('post')
                    ->select('name','content','images','id' ,'category_id')
                    ->where('id', '=', $id)
                    ->get()->toArray();

        return view('admin.post.edit', ['category' => $category, 'data' => $data]);
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
        $this->validate($request,
            [   'name'             => 'required|unique:category|min:3|max:255',
                'category'         => 'required|not_in:default',
                'content'          => 'required'
            ],
            [   'name.required'    => 'Vui lòng điền vào chỗ trống !!!',
                'name.unique'      => 'Đã tồn tại !!!',
                'name.min'         => 'Độ dài từ 3 đến 255 ký tự !!!',
                'name.max'         => 'Độ dài từ 3 đến 255 ký tự !!!',
                'category.required'         => 'Chọn Category',
                'category.not_in'  => 'Chọn Category',
                'content.required' => 'Nhập nội dung'
            ]
        );

        if($request->hasFile('img')){
            $img = $request->file('img');
            $extension = $img->getClientOriginalExtension();
            $nameImg = uniqid().'_dotatoo.'.$extension;
            
            $img->move('upload/post',$nameImg); 
        }else{
            if($request->checkImg == 'default_dotatoo.jpg')
                $nameImg = 'default_dotatoo.jpg';
            else{
                $nameImg = $request->checkImg;
            }
        }

        DB::table('post')
                ->where('id' ,'=', $id)
                ->update(
                    [   'name'          =>  $request->name,
                        'tenkdau'       =>  Helper::changeName($request->name),
                        'category_id'   =>  $request->category,
                        'content'       =>  $request->content,
                        'images'        =>  $nameImg,
                        'status'        =>  0
                    ]);


        return redirect('admin/post')->with('thongbao', 'Added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delPost = post::findOrFail($request->input('post_id'));
        $delPost->delete();
        return back()->with('thongbao', 'Deleted');
    }
}
