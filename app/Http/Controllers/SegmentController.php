<?php

namespace App\Http\Controllers;

use App\Model\Segment;
use App\Model\Subscriber;
use Illuminate\Http\Request;

class SegmentController extends Controller
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

        $all_segments = Segment::get();
        // print_r($columns);

        $date_type_conditions = [ 'before', 'on', 'after', 'on or before', 'on or after', 'between'];



        return view('add_segment', compact('subscriber_columns', 'all_segments', 'date_type_conditions'));
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
        // $segment = new Segment();
        // $segment->name = $request->name;
        // $segment->logic_field = $request->logic_field;
        // $segment->text_type = $request->text_type;
        // $segment->date_type = $request->date_type;
        // $segment->date_from = $request->date_from;
        // $segment->save();

        foreach($request->logic_field as $key => $logic_field){

            $newDateFormat3 = \Carbon\Carbon::parse($request->date_from[$key])->format('Y-m-d');

            // dd($newDateFormat3);

            $data = array(
                'name' => $request->name,
                'logic_field'=> $request->logic_field[$key],
                'text_type'=>$request->text_type[$key],
                'date_type'=>$request->date_type[$key],
                'date_from'=>$newDateFormat3,
                );
            Segment::insert($data);
        }

        return redirect()->back();
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
