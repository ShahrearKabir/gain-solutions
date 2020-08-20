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
        $logicDetails = $all_segments->find($get_json->id)->logic;

        $query = Subscriber::select();

        foreach ($logicDetails as $logic) {

            $setType = '';
            if($logic->logic_type == 'before' ){
                $setType = '<';
            }
            elseif($logic->logic_type == 'after' ){
                $setType = '>';
            }
            elseif($logic->logic_type == 'on or before' ){
                $setType = '<=';
            }
            elseif($logic->logic_type == 'on or after' ){
                $setType = '>=';
            }
            elseif($logic->logic_type == 'on' ){
                $setType = '=';
            }

        
            if ($logic->text_type) {
                // $query->where($logic->logic_field, "like", "%" . $logic->text_type . "%");
                $a = $logic->logic_field;
                $b = $logic->text_type;
                $query->where(function ($query) use ($a, $b) {
                    $query->where($a, 'like', "%$b")
                        ->orWhere($a, 'like', "$b%")
                        ->orWhere($a, 'like', "%$b%")
                        ->orWhere($a, '=', "$b%");
                });
                // dump("or if");
            } elseif ($logic->date_from && !$logic->date_to) {
                $query->where($logic->logic_field,  $setType, $logic->date_from);
                // dump("or else if 1");
            } elseif ($logic->date_from && $logic->date_to) {
                $query->whereBetween($logic->logic_field, [$logic->date_from, $logic->date_to]);
                // dump("or else if 2");
            }
        

        

            // $query->orWhere($logic->logic_field, "like", "%" . $logic->text_type . "%");
            // $query->orWhere($logic->logic_field,  $setType, $logic->date_from);
            // $query->orWhereBetween($logic->logic_field, [$logic->date_from, $logic->date_to]);
            
        }

        $all_subscribers = $query->get();

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
