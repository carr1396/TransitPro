<?php

namespace TransitPro\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;

use TransitPro\Page;
use Baum\MoveNotPossibleException;


class PagesController extends Controller
{
    protected $pages;

    public function __construct(Page $page){
      $this->pages = $page;
      parent::__construct();
    }
    public function index()
    {
        $pages= $this->pages->all();
        return view('backend.admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page)
    {
        $templates = $this->getPageTemplates();
        $orderPages = $this->pages->where('hidden', false)->orderBy('lft', 'asc')->get();
        return view('backend.admin.pages.form', compact('page', 'templates', 'orderPages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Requests\StorePageRequest $request)
     {
        
         $page=$this->pages->create($request->only('name', 'title', 'uri', 'content', 'template', 'hidden'));
         $this->updatePageOrder($page, $request);
         return redirect(route('dashboard.admin.pages.index'))->with('status', 'New page Has Been Created.');
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
           $templates = $this->getPageTemplates();
           $page=$this->pages->findOrFail($id);
          //  $orderPages = $this->pages->all();
          $orderPages = $this->pages->where('hidden', false)->orderBy('lft', 'asc')->get();
           return view('backend.admin.pages.form', compact('page', 'templates', 'orderPages'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Requests\UpdatePageRequest $request, $id)
     {
         $page=$this->pages->findOrFail($id);
         if($response = $this->updatePageOrder($page, $request)){
           return $response;
         }
         $page->fill($request->only('name', 'title', 'uri', 'content', 'template', 'hidden'))->save();

         return redirect(route('dashboard.admin.pages.edit', $page->id))->with('status', $page->title.' Page Has Been Updated');
     }
     public function confirm($id)
     {
         $page=$this->pages->findOrFail($id);
         return view('backend.admin.pages.confirm', compact('page'));
     }
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $page=$this->pages->findOrFail($id);
         $name=$page->title;
         //by default baum will delete all children pages of a page once its Deleted
         //the following code will prevent This
         foreach ($page->children as $child) {
           $child ->makeRoot();
         }
         $page->delete();
         return redirect(route('dashboard.admin.pages.index'))->with('status', 'Page '. $name.' Has Been Deleted');
     }
     protected function getPageTemplates(){
       $templates = config('pro.templates');
       return [''=>''] +array_combine(array_keys($templates), array_keys($templates));
     }

     public function updatePageOrder(Page $page, Request $request){
       if($request->has('order', 'orderPage')){
         try {
           $page->updateOrder($request->input('order'),  $request->input('orderPage'));
         } catch (MoveNotPossibleException  $e) {
           return redirect(route('dashboard.admin.pages.edit', $page->id))->withInput()->withErrors([
             'error' => 'Cannot Mae A Page A Child Of itself'
           ]);
         }

       }
     }
}
