<?php

namespace TransitPro\Http\Controllers\Backend;

use Illuminate\Http\Request;

use TransitPro\Http\Requests;
use TransitPro\UserImage;
use Auth;
use Input;
use Image;

class ImagesController extends Controller
{

  protected $images;


  public function __construct(UserImage $images){
    $this->images = $images;
    parent::__construct();
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {


    $images = UserImage::with('user')->paginate(20);
    if (!Auth::user()->isAdmin()) {
      $images=UserImage::with('user')->where('is_private', 0)->orWhere('user_id', Auth::user()->id)
      ->orderBy('updated_at', 'desc')
      ->groupBy('is_private')
      ->paginate(20);
    }
    return view('backend.images.index', compact('images', 'pagination'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(UserImage $image)
  {
    return view('backend.images.form', compact('image'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Requests\CreateImageRequest $request)
  {
    //define the image paths
    $user_image = new UserImage([
      'name'        => $request->get('name'),
      'user_id' => Auth::user()->id,
      'extension'   => $request->file('image')->getClientOriginalExtension(),
      'mobile_image_name' => $request->get('mobile_image_name'),
      'mobile_extension'  => $request->file('mobile_image')->getClientOriginalExtension(),
      'is_active'         => $request->get('is_active'),
      'is_featured'       => $request->get('is_featured'),
      'is_private'       => $request->get('is_private'),

    ]);
    $destinationFolder = '/images/user/';
    $destinationThumbnail = '/images/user/thumbnails/';
    $destinationMobile = '/images/user/mobile/';

    //assign the image paths to new model, so we can save them to DB

    $user_image->path = $destinationFolder;
    $user_image->mobile_image_path = $destinationMobile;
    // format checkbox values and save model

    $this->formatCheckboxValue($user_image);
    $user_image->save();

    //parts of the image we will need

    $file = \Input::file('image');

    $imageName = $user_image->name;
    $extension = $request->file('image')->getClientOriginalExtension();

    //create instance of image from temp upload

    $image = Image::make($file->getRealPath());

    //save image with thumbnail

    $image->save(public_path() . $destinationFolder . $imageName . '.' . $extension)
    ->resize(60, 60)
    // ->greyscale()
    ->save(public_path() . $destinationThumbnail . 'thumb-' . $imageName . '.' . $extension);

    // now for mobile

    $mobileFile = Input::file('mobile_image');

    $mobileImageName = $user_image->mobile_image_name;
    $mobileExtension = $request->file('mobile_image')->getClientOriginalExtension();

    //create instance of image from temp upload
    $mobileImage = Image::make($mobileFile->getRealPath());
    $mobileImage->save(public_path() . $destinationMobile . $mobileImageName . '.' . $mobileExtension);

    return redirect(route('backend.images.index'))->with('status', 'New Image Has Been Uploaded.');
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
    $image = UserImage::where('id', $id)->with('user')->first();

    if(Auth::user()->id != $image->user->id){
      return redirect()->back()->withErrors([
        'error' =>'You DO Not Have Permission To Edit This Image'
      ]);
    }

    return view('backend.images.form', compact('image'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Requests\EditImageRequest $request, $id)
  {
    //https://laraveltips.wordpress.com/category/image-management-in-laravel-5-1/


    $user_image = UserImage::findOrFail($id);

    $user_image->is_active = $request->get('is_active');
    $user_image->is_featured = $request->get('is_featured');
    $user_image->is_private = $request->get('is_private');

    $this->formatCheckboxValue($user_image);
    $user_image->save();

    if ( ! empty(Input::file('image'))){

      $destinationFolder = '/images/user/';
      $destinationThumbnail = '/images/user/thumbnails/';

      $file = Input::file('image');

      $imageName = $user_image->name;
      $extension = $request->file('image')->getClientOriginalExtension();

      //create instance of image from temp upload
      $image = Image::make($file->getRealPath());

      //save image with thumbnail
      $image->save(public_path() . $destinationFolder . $imageName . '.' . $extension)
      ->resize(60, 60)
      // ->greyscale()
      ->save(public_path() . $destinationThumbnail . 'thumb-' . $imageName . '.' . $extension);

    }

    if ( ! empty(Input::file('mobile_image'))) {

      $destinationMobile = '/images/user/mobile/';
      $mobileFile = Input::file('mobile_image');

      $mobileImageName = $user_image->mobile_image_name;
      $mobileExtension = $request->file('mobile_image')->getClientOriginalExtension();

      //create instance of image from temp upload
      $mobileImage = Image::make($mobileFile->getRealPath());
      $mobileImage->save(public_path() . $destinationMobile . $mobileImageName . '.' . $mobileExtension);
      return redirect(route('backend.images.index'))->with('status', 'Image Has Been Updated');
    }
    return redirect(route('backend.images.index'))->with('status', 'Image Has Been Updated');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $user_image = UserImage::where('id', $id)->with('user')->first();

    if(Auth::user()->id != $user_image->user->id){
      return redirect()->back()->withErrors([
        'error' =>'You DO Not Have Permission To Delete This Image'
      ]);
    }else{

          $thumbPath = $user_image->path.'thumbnails/';

          \File::delete(public_path($user_image->path).
          $user_image->name . '.' .
          $user_image->extension);

          \File::delete(public_path($user_image->mobile_image_path).
          $user_image->mobile_image_name . '.' .
          $user_image->mobile_extension);
          \File::delete(public_path($thumbPath). 'thumb-' .
          $user_image->name . '.' .
          $user_image->extension);

          UserImage::destroy($id);
          return redirect(route('backend.images.index'))->with('status', 'Image Has Been Deleted');
    }
  }

  public function formatCheckboxValue($user_image)
  {

    $user_image->is_active = ($user_image->is_active == null) ? 0 : 1;
    $user_image->is_featured = ($user_image->is_featured == null) ? 0 : 1;
    $user_image->is_private = ($user_image->is_private == null) ? 0 : 1;
  }
}
