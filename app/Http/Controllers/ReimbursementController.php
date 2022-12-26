<?php

namespace App\Http\Controllers;

use App\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class ReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $submission = Reimbursement::create(
            [
                'date' => request()->date,
                'description' => request()->description,
                'user_id' => auth()->user()->id
            ]
        );
        $path = public_path('images/ReimbursemenImage');

        foreach ($request->images as $key => $value) {

            $file = $value;
            $filename = date('YmdHi') . $value->getClientOriginalName();
            $file->move(public_path('images/ReimbursementImage'), $filename);
            DB::table('reimbursement_images')->insert([
                'path' => $filename,
                'absolute_path' => $path . '/' . $filename,
                'reimbursement_id' => $submission->id
            ]);
        }
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function show(Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function edit(Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reimbursement $reimbursement)
    {
        //
    }

    public function datatable()
    {
        $data = Reimbursement::orderby('status', 'asc')->get();
        foreach ($data as $key => $value) {
            $value->images = DB::table('reimbursement_images')->where('reimbursement_id', $value->id)->get();
            $value->user = DB::table('users')->where('id', $value->user_id)->first();
        }
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a onclick="approval(' . $row->id . ')" href="javascript:void(0)" class="btn btn-primary btn-sm">Approve</a><hr><a onclick="rejection(' . $row->id . ')" href="javascript:void(0)" class="btn btn-danger btn-sm">Reject</a>';
                return $btn;
            })
            ->addColumn('user', function ($row) {
                return $row->user->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function approval()
    {

        Reimbursement::where('id', request()->id)->update([
            'status' => '1'
        ]);
        return response('ok', 200);
    }
    public function rejection()
    {

        Reimbursement::where('id', request()->id)->update([
            'status' => '2'
        ]);
        return response('ok', 200);
    }
}
