<?php

namespace App\Http\Controllers;

use App\Model\Segment;
use App\Model\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriber = new Subscriber();
        $subscriber_columns = $subscriber->getTableColumns();

        $all_subscribers = Subscriber::get();
        // print_r($columns);



        return view('add_subscriber', compact('subscriber_columns', 'all_subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $subscriber = new Subscriber();
        $subscriber->first_name = $request->first_name;
        $subscriber->last_name = $request->last_name;
        $subscriber->email = $request->email;
        $subscriber->birth_day = $request->birth_day;
        $subscriber->save();

        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function view()
    {
        $all_segments = Segment::get();
        
        $all_subscribers = Subscriber::get();
        // print_r($columns);

        return view('subscriber_list', compact('all_segments', 'all_subscribers'));
    }

    public function show(Request $request)
    {
        $all_segments = Segment::get();

        $get_json = json_decode($request->logic_field);

        if($get_json->text_type){
            
            
            // dd( $get_json );
            $all_subscribers = Subscriber::select('first_name', 'last_name', 'email', 'birth_day',)
                ->orWhere($get_json->logic_field, "like", "%" . $get_json->text_type . "%")
                ->get();
        }
        elseif($get_json->date_from){

            $setType = '';
            if($get_json->date_type == 'before' ){
                $setType = '<';
            }
            elseif($get_json->date_type == 'after' ){
                $setType = '>';
            }
            elseif($get_json->date_type == 'on or before' ){
                $setType = '<=';
            }
            elseif($get_json->date_type == 'on or after' ){
                $setType = '=>';
            }
            elseif($get_json->date_type == 'on' ){
                $setType = '=';
            }

            $all_subscribers = Subscriber::select('first_name', 'last_name', 'email', 'birth_day',)
                ->orWhere($get_json->logic_field,  $setType ,$get_json->date_from)
                ->get();
        }
        else{
            $all_subscribers = Subscriber::select('first_name', 'last_name', 'email', 'birth_day',)->get();
        }
        

        return view('subscriber_list', compact('all_segments', 'all_subscribers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
