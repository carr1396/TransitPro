<?php
  namespace TransitPro\Templates;
  use Illuminate\View\View;
  use TransitPro\Post;
  use Carbon\Carbon;

  class HomeTemplate extends AbstractTemplate
  {

    protected $view='home';

    protected $posts;

    public function __construct(Post $posts){
      $this->posts = $posts;
    }
    public function prepare(View $view, array $paramaters){

      $posts= $this->posts->with('authored')
                ->where('published_at', '<=', Carbon::now())
                ->orderBy('published_at', 'desc')
                        ->take(3)
                        ->get();
      $view->with('posts', $posts);
    }

  }
