<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch (auth()->user()->role) {
            case 'User':
                $reimbursement = DB::table('reimbursements')->where('user_id', auth()->user()->id)
                    // ->leftjoin('reimbursement_images', 'reimbursements.id', 'reimbursement_images.id')
                    ->get();

                foreach ($reimbursement as $key => $value) {
                    $value->images = DB::table('reimbursement_images')->where('reimbursement_id', $value->id)->get();
                }

                break;

            default:
                // $reimbursement = DB::table('reimbursements')
                //     ->orderby('status', 'asc')
                //     // ->leftjoin('reimbursement_images', 'reimbursements.id', 'reimbursement_images.id')
                //     ->get();

                // foreach ($reimbursement as $key => $value) {
                //     $value->images = DB::table('reimbursement_images')->where('reimbursement_id', $value->id)->get();
                //     $value->user = DB::table('users')->where('id', $value->user_id)->first();
                // }
                $reimbursement = '';

                break;
        }

        return view('home', compact('reimbursement'));
    }
}
