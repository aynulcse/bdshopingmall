<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Cat;
use App\Models\Contact;


class PagesController extends Controller
{
    public function index()
    {
        $sliders=Slider::all();
        $category=Cat::all();
        $products=Product::orderBy('id','desc')->paginate(3);
    	return view('frontend.pages.index',compact('products','sliders','category'));
    }

    // api
    public function indexsliderapi()
    {
        return Response()->json(Slider::all());
    }
    public function indexcategoryapi()
    {
        return Response()->json(Cat::all());
    }
    public function indexproductapi()
    {
        return Response()->json(Product::all());
    }


    public function contacts()
    {
    	return view('frontend.pages.contact');
    }




    public function search(Request $request)
    {
        $search=$request->search;
        $products=Product::orWhere('title','like','%'.$search.'%')
        ->orWhere('description','like','%'.$search.'%')
        ->orWhere('price','like','%'.$search.'%')
        ->orWhere('quantity','like','%'.$search.'%')
        ->orderBy('id','desc')
        ->paginate(3);
        return view('frontend.pages.product.search',compact('search','products'));
    }




    public function products()
    {
    	$products=Product::orderBy('id','desc')->paginate(9);
    	return view('frontend.pages.product.index',compact('products'));
    }







    public function product_show($id)
    {
        $product=Product::where('id',$id)->first();
        if (!is_null($product)) {
            return view('frontend.pages.product.show',compact('product'));
        }
        else{
            session()->flash('errors','NO Item Found');
            return redirect()->route('admin.product.index');
        }
    }

    public function product_showapi($id)
    {
        $product=Product::where('id',$id)->first();
        if (!is_null($product)) {
            return Response()->json($product);
        }
        else{
            return Response()->json(["Message"=>"Product not found"]);
        }
    }




    public function Category($id)
    {
        
        $products=Product::Where('cat_id',$id)
        ->orderBy('id','desc')
        ->paginate(9);
        return view('frontend.pages.product.category-product',compact('products'));
    }



    // contact.store
    public function store(Request $request)
    {
       $this->validate($request,[
        'name' => 'required',
        'email' => 'required',
        'subject' => 'required',
        'message' => 'required'
        ]
        ); 

    $contact=new Contact();
    $contact->name=$request->name;
    $contact->subject=$request->subject;
    $contact->email=$request->email;
    $contact->message=$request->message;


    $contact->save();
    return redirect()->route('index');

    }

  
   
}
