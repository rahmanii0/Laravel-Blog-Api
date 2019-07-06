<?php

namespace App\Http\Controllers\Api;


use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;use phpDocumentor\Reflection\DocBlock\Tags\Formatter\AlignFormatter;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with([
            'postComment:id,body,post_id,user_id',
            'user:id,name'
        ])->get();

        return $posts;


//        return Post::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       /* $validator = $request->validate([
            'user_id'=>'required',
            'category_id'=>'required',
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()){
            Redirect::back()->with('message', 'error with data ');

        }else{
            $posts = new Post([
                'user_id'=>$request->user_id,
                'category_id'=>$request->category_id,
                'title' => $request->title,
                'body' => $request->body,

            ]);
            $posts->save();
            return ($posts);

        }*/

        $validator = $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);


            Post::create($request->all());


            return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return $post;
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
        $posts = Post::findOrFail($id){[

            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'body' => $request->body
        ]};
        $posts->save();
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        $posts->delete();

    }
}
