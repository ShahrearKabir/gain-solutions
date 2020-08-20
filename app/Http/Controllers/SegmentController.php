<?php

namespace App\Http\Controllers;

use App\Model\Logic;
use App\Model\Segment;
use App\Model\Subscriber;
use Carbon\Carbon;
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

        $index = 0;
        foreach ($all_segments as $items) {
            $logicDetails = Segment::find($items->id)->logic;
            
            $all_segments[$index]->logicDetails = $logicDetails;
            $index++;
        }

        // $all_logic = Segment::find(1)->logic;
        // dd($all_segments);

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
        $segment = new Segment();
        $segment->name = $request->name;
        // $segment->logic_field = $request->logic_field;
        // $segment->text_type = $request->text_type;
        // $segment->date_type = $request->date_type;
        // $segment->date_from = $request->date_from;
        $segment->save();

        // $logic = new Logic();
        foreach($request->logic_field as $key => $logic_field){

            
            if($request->date_from[$key]){
                $newDateFormatFrom = \Carbon\Carbon::parse($request->date_from[$key])->format('Y-m-d');
            }
            else{
                $newDateFormatFrom = null;
            }
            if($request->date_to[$key]){
                $newDateFormatTo = \Carbon\Carbon::parse($request->date_to[$key])->format('Y-m-d');
            }
            else{
                $newDateFormatTo = null;
            }
            
            // dd($newDateFormat3);

            $data = array(
                'segment_id' => $segment->id,
                'logic_field' => $request->logic_field[$key],
                'logic_type' => $request->logic_type[$key],
                'text_type' => $request->text_type[$key],
                'date_from' => $newDateFormatFrom,
                'date_to' => $newDateFormatTo,
                'select_by' => $request->select_by[$key],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                );
            Logic::insert($data);
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
