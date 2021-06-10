<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drag_drop;

class Drag_dropController extends Controller
{
    public function showDatatable()
    {
        $tasks = Drag_drop::orderBy('order','ASC')->select('id','title','status','created_at')->get();

        return view('drag_drop',compact('tasks'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = Drag_drop::all();

        foreach ($tasks as $task) {
            $task->timestamps = false; // To disable update_at field updation
            $id = $task->id;                                                                        

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order' => $order['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
}
