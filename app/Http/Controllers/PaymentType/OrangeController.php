<?php

namespace App\Http\Controllers\PaymentType;

use Inertia\Inertia;
use App\Models\Orange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Payment/Orange/Index')->with([
            'url'=>url('storage/img/orange.png'),
            'phone'=>Orange::where('user_id',auth()->user()->id)->first()
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
        Orange::create($data);
        return redirect()->route('orange.index')->with('message', 'Bravo , votre numéro orange money a été confirmé !!');
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
        Orange::where('id',$id)->update([
            'phone'=>$data['phone']
        ]);
        return redirect()->route('orange.index')->with('update', 'Votre numéro orange money a été modifié ! ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Orange::destroy($id);
        return redirect()->back();
    }
}