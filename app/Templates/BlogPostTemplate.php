<?php
  namespace TransitPro\Templates;
  use Illuminate\View\View;
  use TransitPro\Post;
  use Carbon\Carbon;

  class BlogPostTemplate extends AbstractTemplate
  {

    protected $view='blog.post';

    protected $posts;

    public function __construct(Post $posts){
      $this->posts = $posts;
    }
    public function prepare(View $view, array $paramaters){

      // $post= $this->posts->where('id', $paramaters['id'])->where('slug', $paramaters['slug'])->first();
      $post= $this->posts->with('authored')->where('id', $paramaters['id'])->where('slug', $paramaters['slug'])->first();
      $view->with('post', $post);
    }

  }
