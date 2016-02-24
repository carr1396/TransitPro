<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use TransitPro\Http\Requests;
use TransitPro\Post;
use TransitPro\Http\Requests\StorePostRequest;
use TransitPro\Http\Requests\UpdatePostRequest;

class BlogController extends Controller
{
    protected $posts;

    public function __construct(post $post){
      $this->posts = $post;
      parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**public function index()
    {//see query log
      \DB::enableQueryLog();

      // $posts= $this->posts->orderBy('published_at', 'desc')->paginate(10); //lazy loading each post has a select query for author when we ca;; it in the View
      $posts= $this->posts->orderBy('published_at', 'desc')->with('authored')->paginate(10);//eager loaded

      view('backend.admin.blog.index', compact('posts'))->render();

      dd(\DB::getQueryLog());
    }**/

    public function index()
    {
      $posts= $this->posts->orderBy('published_at', 'desc')->with('authored')->paginate(10);
      return view('backend.admin.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
          return view('backend.admin.blog.form', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePostRequest $request)
    {

        $this->posts->create(['author'=>auth()->user()->id]+$request->only('title', 'slug', 'published_at', 'body', 'excerpt'));
        return redirect(route('dashboard.admin.blog.index'))->with('status', 'New Post Has Been Created.');
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
      $post=$this->posts->findOrFail($id);
      return view('backend.admin.blog.form', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePostRequest $request, $id)
    {
        $post=$this->posts->findOrFail($id);
        $post->fill($request->only('title', 'slug', 'published_at', 'body', 'excerpt'))->save();
        return redirect(route('dashboard.admin.blog.edit', $post->id))->with('status', 'Post Has Been Updated');
    }

    public function confirm($id)
    {
        $post=$this->posts->findOrFail($id);
        return view('backend.admin.blog.confirm', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=$this->posts->findOrFail($id);
        $name=$post->title;
        $post->delete();
        return redirect(route('dashboard.admin.blog.index'))->with('status', 'Post '. $name.' Has Been Deleted');
    }
}
