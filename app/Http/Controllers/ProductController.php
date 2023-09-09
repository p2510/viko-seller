<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $products=Product::where('user_id',auth()->user()->id)->with(['product_photos','categories'])->get()->map(function ($product) {
            $product->first_photo = $product->product_photos->first();
            $product->category_name = $product->categories->name;
            return $product;
        });
     
        return Inertia::render('Management/Product/Index')->with([
            'categories'=>Category::where('user_id',auth()->user()->id)->latest()->get()->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'created_at' => $category->CreatedAt, // Assuming 'CreatedAt' is your custom accessor
                    'updated_at' => $category->UpatedAt, 
                ];
            }),
            'products'=>$products,
            'urlPhoto'=>url('storage/product-photos')
            
        ]);
    }

    
    /**
     * upload url
     */
    public function upload(Request $request)
    {
        $path = storage_path('app/public/tmp/uploads');
        
        $file = $request->file('image');
    
        $name = uniqid() . '.' .   $file->getClientOriginalExtension();
    
        $file->move($path, $name);  
    
        return ['name' => $name];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>['required','min:2','unique:categories'],
            'brand'=>['required','string','min:2'],
            'on_sale'=>['required','boolean'],
            'price'=>['required','regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'sale_price'=>['required','regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'quantity'=>['required','integer','min:0'],
            'category_id'=>['required','integer','min:1'],
            'description'=>['required','min:12'],
            'media' => 'required'
        ]);
        
        $getId= DB::table('products')->insertGetId([
                           'name'=>$data['name'],
                           'brand'=>$data['brand'],
                           'on_sale'=>$data['on_sale'],
                           'price'=>$data['price'],
                           'sale_price'=>$data['sale_price'],
                           'quantity'=>$data['quantity'],
                           'category_id'=>$data['category_id'],
                           'description'=>$data['description'],
                           'user_id'=>auth()->user()->id
                      ] 
        );
                
        if(isset($request->media)){            
            foreach($request->media as $image){
                Storage::move('public/tmp/uploads/'. $image['name'], 'public/product-photos/'.$image['name'] );      
                ProductPhoto::create(['name'=>$image['name'],'product_id'=>$getId]);          
            }

        }
    
       
        return redirect()->back()->with('message', 'Nouveau produit crée !!');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}