<?php

namespace App\Http\Controllers\dota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
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
                ->paginate(9);
        
        return view('home.index.index', ['post' => $post]);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function ajaxCategory(Request $request)
    {
        $category_id = $request->id;
        $data =     DB::table('post')
                        ->select('id', 'name', 'tenkdau', 'images', 'category_id')
                        ->where('category_id', '=' , $category_id)
                        ->take(4)
                        ->get()->toArray();
        if(!empty($data)){
            foreach ($data as $key => $value) {
                echo '
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="upload/post/'.$value->images.'" alt="" class="img-fluid">
                                        <div class="hovereffect">
                                        </div><!-- end hover -->
                                        <span class="menucat">dota2</span>
                                    </a>
                                </div><!-- end media -->
                                <div class="blog-meta">
                                    <h4><a href="tech-single.html" title="">'.$value->name.'</a></h4>
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->
                        </div>';
            }
            echo "see more posts";

                
        }else{
            echo "<h4> The content is being updated  </h4>";
        }
    }
}
