<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use Carbon\Carbon;
use App\Models\GiftCards;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class GiftCardsController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = GiftCards::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                           
                            ->addColumn('status', function(GiftCards $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-gift-card-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><<option data-val="0" value="'. route('admin-gift-card-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            }) 
                            ->addColumn('action', function(GiftCards $data) {
                                return '<div class="action-list"><a href="' . route('admin-gift-card-edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-gift-card-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.gift-card.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.gift-card.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
            $rules = [
                'photo'      => 'required|mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new GiftCards();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/images/giftcards',$name);           
            $input['photo'] = $name;
        } 
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin-gift-card-index").'">View Gift Card Lists</a>';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }

    //*** GET Request
    public function edit($id)
    {
        $data = GiftCards::findOrFail($id);
        return view('admin.gift-card.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
            'photo'      => 'mimes:jpeg,jpg,png,svg',
             ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = GiftCards::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) 
            {              
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/images/giftcards',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/giftcards/'.$data->photo)) {
                        unlink(public_path().'/assets/images/giftcards/'.$data->photo);
                    }
                }            
            $input['photo'] = $name;
            } 
         $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin-gift-card-index").'">View gift-card Lists</a>';
        return response()->json($msg);    
        //--- Redirect Section Ends           
    }
      //*** GET Request Status
      public function status($id1,$id2)
        {
            $data = GiftCards::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = GiftCards::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
}
