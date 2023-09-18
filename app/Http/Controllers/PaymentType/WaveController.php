<?php

namespace App\Http\Controllers\PaymentType;

use App\Models\Wave;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Payment/Wave/Index')->with([
            'url'=>url('storage/img/wave.png'),
            'phone'=>Wave::where('user_id',auth()->user()->id)->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'phone'=>['required','digits:10',],
        ]);
        $data['user_id']=auth()->user()->id;
        Wave::create($data);
        return redirect()->route('wave.index')->with('message', 'Bravo , votre numéro wave a été confirmé !!');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->validate([
            'phone'=>['required','digits:10',],
        ]);
        Wave::where('id',$id)->update([
            'phone'=>$data['phone']
        ]);
        return redirect()->route('wave.index')->with('update', 'Votre numéro wave a été modifié ! ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Wave::destroy($id);
        return redirect()->back();
    }
}