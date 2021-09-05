<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Contact;
use Image;
use DataTables;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
    public function index()
    {
        return view('backend.pages.index');
    }

     public function Contact(Request $request)
    {
        if(request()->ajax())
        {
            $data = Contact::latest()->get();
            return datatables()->of($data)
                    ->addColumn('action', function($data){
                        $button = '';

                            $button .= '<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
    
                        return $button;
                    })
                   
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.pages.contact');
    }
    
     public function destroy($id)
    {
        if(request()->ajax()){

  

            $data = Contact::findOrFail($id); //find id here

      

            $success = $data->delete();
            if($success){
                return 'Deleted';
            }else{
                return 'Error';
            }
        } 
    }

}
