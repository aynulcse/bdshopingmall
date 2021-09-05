<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

use Illuminate\Support\Str;
use App\Models\Cat;
use App\Models\Subcat;

use DataTables;
use Validator;
use Image;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $category=Cat::All();
         if(request()->ajax())
        {
            $data = Product::latest()->get();
            return datatables()->of($data)
                    ->addColumn('action', function($data){
                        $button = '';
                        
                         //Edit Button
                       

                            $button .= '<button type="button" id="'.$data->id.'" class="edit btn btn-primary btn-sm mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>';
                        
                    
                        //Delete Button

                            $button .= '<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                    

                        if($data->status == 1){
                          $button .= '<button type="button" name="status" id="'.$data->id.'" class="status btn btn-info btn-sm mr-1"><i class="fa fa-check"></i>&nbsp;Block</button>';
                        }
                        else{
                            $button .= '<button type="button" name="status" id="'.$data->id.'" class="status btn btn-warning btn-sm mr-1"><i class="fa fa-times"></i>&nbsp;Unblock</button>';
                        }

                        return $button;
                    })
                    ->addColumn('image', function($data){
                        $url1=asset("$data->image_small");
                        $url2=asset("$data->image2_small");
                        $url3=asset("$data->image3_small");
                        $button = '<img src='.$url1.' width="100" height="100" class="img-thumbnail" />';
                        $button .= '<img src='.$url2.' width="100" height="100" class="img-thumbnail" />';
                        $button .= '<img src='.$url3.' width="100" height="100" class="img-thumbnail" />';

                        return $button;
                    })

                     ->addColumn('details', function($info){
                        $button ='<p class="mb-0"><b>Product Title: </b>'.$info->title.' </p>';
                        $button .= '<p class="mb-0"> <b>Product Price: </b>'.$info->price.' </p>';
                        $button .= '<p class="mb-0"> <b>Product Quantity: </b>'.$info->quantity.' </p>';
                        if($info->cat_id == 1){
                          $button .= '<p class="mb-0"><b>Product category: </b> Feed</p>';
                        }
                        if($info->cat_id == 2){
                          $button .= '<p class="mb-0"><b>Product category: </b> Food</p>';
                        }
                        if($info->cat_id == 3){
                          $button .= '<p class="mb-0"><b>Product category: </b> Farm</p>';
                        }
                        $button .= '<p class="mb-0"> <b>Product Description: </b>'.$info->description.' </p>';
                        

                        return $button;
                    })
                    ->rawColumns(['action', 'image','details'])
                    ->make(true);
        }
        return view('backend.pages.product.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $rules = array(
            'title'    =>  'required',
            'description'    =>  'required',
            'price'    =>  'required',
            'quantity'    =>  'required',
            'category'    =>  'required',
            'sub'    =>  'required',
            'image'   =>   'required|image|mimes:jpeg,png,jpg|max:1500',
            'image2'  =>   'required|image|mimes:jpeg,png,jpg|max:1500',
            'image3'  =>   'required|image|mimes:jpeg,png,jpg|max:1500',
            

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = new Product();

        // image load one with original image
        $image = $request->file('image'); //take data from view
        if ($image) {
            $image_name = Str::random(5);  //random data create
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path_sm = 'images/product/small/';
            $image_url_sm = $upload_path_sm . $image_full_name;

            // image resize from here

            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(150, 150, function($constraint){
                $constraint->aspectRatio();
            })->save($upload_path_sm . $image_full_name);

            // end image resize

            // upload original image
            $upload_path = 'images/product/original/';
            $image_url = $upload_path . $image_full_name;

            Image::make($image)->save($image_url);
            //end upload original image

            // data insert from here
            $data->image_small = $image_url_sm;

            $data->image = $image_url;

        }
        //end   image load one with original image



        // image load two with original image
        $image2 = $request->file('image2'); //take data from request
        if ($image2) {
            $image2_name = Str::random(5); //start random number
            $ext = strtolower($image2->getClientOriginalExtension());
            $image2_full_name = $image2_name . '.' . $ext;
            $upload_path = 'images/product/small/';
            $image2_url = $upload_path . $image2_full_name;

            // resize image start from here
            $resize_image2 = Image::make($image2->getRealPath());
            $resize_image2->resize(100, 100, function($constraint){
                $constraint->aspectRatio();
            })->save($upload_path . $image2_full_name);
            //end resize image start from here


            // upload original image  from here
            $upload_path1 = 'images/product/original/';
            $image2_url1 = $upload_path1 . $image2_full_name;
            Image::make($image2)->save($image2_url1);
            //end upload original image  from here


            $data->image2_small = $image2_url;
            $data->image2 = $image2_url1;

        }
        // end load image 2 with original image



        //load image 3 with original image
        $image3 = $request->file('image3'); //take data from request
        if ($image3) {
            $image3_name = Str::random(5); //take random number
            $ext = strtolower($image3->getClientOriginalExtension());
            $image3_full_name = $image3_name . '.' . $ext;
            $upload_path = 'images/product/small/';
            $image3_url = $upload_path . $image3_full_name;

            //Resize image start from here

            $resize_image3 = Image::make($image3->getRealPath());
            $resize_image3->resize(100, 100, function($constraint){
                $constraint->aspectRatio();
            })->save($upload_path . $image3_full_name);

            //Resize image end  here


            //upload original  image start from here
            $upload_path1 = 'images/product/original/';
            $image3_url1 = $upload_path1 . $image3_full_name;
            Image::make($image3)->save($image3_url1);

            //upload original  image end  here

            // data insert in datatables
            $data->image3_small = $image3_url;
            $data->image3 = $image3_url1;

        }
        // end load image 3 with original image




        //save data database in rooms table

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price= $request->price;
        $data->quantity = $request->quantity;
        $data->cat_id = $request->category;
        $data->sub_id = $request->sub;



        $success = $data->save();

        if($success){
             return response()->json(['success' => 'Data Added successfully.']);
        }
        else{
             return response()->json(['error' => 'Data  Added Failed.']);
        }
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

          if(request()->ajax())
        {
            $data = Product::findOrFail($id);
            return $data;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $rules = array(
            'title'    =>  'required',
            'description'    =>  'required',
            'price'    =>  'required',
            'quantity'    =>  'required',
            'category'    =>  'required',
            'sub'    =>  'required',

        );


        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // update id start
        $id = $request->updateId;
        $data =  Product::find($id);
        //end update id


        // image load one with original image

         $image = $request->file('image');
        if ($image) {

            //delete image
            if(!empty($data->image)){

                $imgPath =$data->image;
                $delImg = unlink($imgPath);
            }

             if(!empty($data->image_small)){
                 $imgPath =$data->image_small;
                $delImg = unlink($imgPath);
            }
            // end delete image process


            $image_name = Str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'images/product/small/';
            $image_url = $upload_path . $image_full_name;

            // image resize start here
            $resize_image = Image::make($image->getRealPath());
             $resize_image->resize(100, 100, function($constraint){
                 $constraint->aspectRatio();
            })->save($upload_path . $image_full_name);
             // end resize image here


             // upload original image start here
             $upload_path1 = 'images/product/original/';
             $image_url1 = $upload_path1 . $image_full_name;

            Image::make($image)->save($image_url1);
             // upload original image end here


            // data update from here
             $data->image_small = $image_url;

             $data->image = $image_url1;

        }

        //end   image load one with original image



        // image load two with original image
        $image2 = $request->file('image2');
        if ($image2) {

            // delete image two

            if(!empty($data->image2)){

                $imgPath =$data->image2;
                $delImg = unlink($imgPath);
            }

             if(!empty($data->image2_small)){
                 $imgPath =$data->image2_small;
                $delImg = unlink($imgPath);
            }

            $image2_name = Str::random(5);
            $ext = strtolower($image2->getClientOriginalExtension());
            $image2_full_name = $image2_name . '.' . $ext;
            $upload_path = 'images/product/small/';
            $image2_url = $upload_path . $image2_full_name;

            // image resize start here
            $resize_image2 = Image::make($image2->getRealPath());
             $resize_image2->resize(150, 150, function($constraint){
                 $constraint->aspectRatio();
            })->save($upload_path . $image2_full_name);

             //image resize end here


             // upload image original here
             $upload_path1 = 'images/product/original/';
             $image2_url1 = $upload_path1 . $image2_full_name;
             Image::make($image2)->save($image2_url1);

              //end upload image original here


              // data update from here
             $data->image2_small = $image2_url;
             $data->image2 = $image2_url1;

        }
        // end load image 2 with original image



        //load image 3 with original image

        $image3 = $request->file('image3');
        if ($image3) {

            // delete image start from here
            if(!empty($data->image3)){

                $imgPath =$data->image3;
                $delImg = unlink($imgPath);
            }

             if(!empty($data->image3_small)){
                 $imgPath =$data->image3_small;
                $delImg = unlink($imgPath);
            }
            // end delete here


            $image3_name = Str::random(5);
            $ext = strtolower($image3->getClientOriginalExtension());
            $image3_full_name = $image3_name . '.' . $ext;
            $upload_path = 'images/product/small/';
            $image3_url = $upload_path . $image3_full_name;

            // image resize start from here
            $resize_image3 = Image::make($image3->getRealPath());
             $resize_image3->resize(150, 150, function($constraint){
                 $constraint->aspectRatio();
            })->save($upload_path . $image3_full_name);
             //image resize end here


             // upload original image
             $upload_path1 = 'images/product/original/';
             $image3_url1 = $upload_path1 . $image3_full_name;

            Image::make($image3)->save($image3_url1);
            // end upload original image


            // update data here
             $data->image3_small = $image3_url;
             $data->image3 = $image3_url1;

        }
        // end load image 3 with original image




      //save data database in rooms table

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price= $request->price;
        $data->quantity = $request->quantity;
        $data->cat_id = $request->category;
        $data->sub_id = $request->sub;



        $success = $data->save();

        if($success){
             return response()->json(['success' => 'Data Update successfully.']);
        }
        else{
             return response()->json(['success' => 'Data Update Failed.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(request()->ajax()){

            $data = Product::findOrFail($id); //find id here

            $imgName1 =$data->image;
            $imgName1_small =$data->image_small;
            $imgName2 =$data->image2;
            $imgName2_small =$data->image2_small;
            $imgName3 =$data->image3;
            $imgName3_small =$data->image3_small;

            //check this image have or  not in data base

            if(!empty($imgName1)){
                unlink($imgName1);
            }

            if(!empty($imgName1_small)){
                unlink($imgName1_small);
            }

            if(!empty($imgName2)){
                unlink($imgName2);
            }

            if(!empty($imgName2_small)){
                unlink($imgName2_small);
            }

            if(!empty($imgName3)){
                unlink($imgName3);
            }

            if(!empty($imgName3_small)){
                unlink($imgName3_small);
            }

            // data delete is successfully then data delete


            $success = $data->delete();
            if($success){
                return 'Deleted';
            }else{
                return 'Error';
            }
        }
    }


    public function Block($id)
    {
        $data=Product::find($id);
        $temp="";

        if($data->status == "1"){
            $temp=0;
        }

        if($data->status =="0"){
           $temp=1;
        }
        $data->status=$temp;
        $success=$data->save();
         if($success){
                return 'ok';
            }else{
                return 'error';
           }

    }


// sdelect auto
    public function SubCategory($id)
    {
        $data=Subcat::where('cat_id',$id)->get();
        return json_encode($data);
    }

}