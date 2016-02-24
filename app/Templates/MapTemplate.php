<?php
  namespace TransitPro\Templates;
  use Illuminate\View\View;
  use TransitPro\District;
  use TransitPro\TRoute;
  use Carbon\Carbon;
  use JavaScript;

  class MapTemplate extends AbstractTemplate
  {

    protected $view='map';
    protected $districts;

    public function __construct(District $districts){
      $this->districts = $districts;
    }
    public function prepare(View $view, array $paramaters){
      // $district=District::findOrFail($paramaters['id']);
      // $locations = array();
      // if($district){
      //   $locations=$district->locations()->get();
      //   var_dump(count($locations));
      // }
      $troutes = TRoute::with('start')->with('end')->get();
      $district= $this->districts->find($paramaters['id'])->with('locations')->first();
      JavaScript::put([
        'district' => $district,
        'troutes' => $troutes,
      ]);
      $view->with(array('district'=> $district, 'troutes' => $troutes));
    }

  }
