<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductFIles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function product()
    {
        DB::beginTransaction();
        try {
            $request = request()->all();
            $request['user_id'] = \Auth::id();
    
            // Uncomment validation if needed
            $validatedData = request()->validate([
                'name' => 'required|string',
                'category' => 'nullable|string',
                'description' => 'nullable|string',
                'expiration_date' => 'nullable|date',
                'images.*' => 'file|image|max:2048',
            ]);
    
            $product = null;
 
            if (request()->get('id')) {
                $product = Product::findOrFail($request['id']);
                $product->fill($validatedData);
                $product->save();
            } else {
                $product = Product::create($validatedData);
            }
    
            $imagePaths = [];
    
            if (request()->hasFile('images')) {
                foreach (request()->file('images') as $image) {
                    $path = $image->store('uploads/products', 'public');
                    $imagePaths[] = $path;

                    ProductFiles::create([
                        'image_path' => $path,
                        'image_type' => $image->getMimeType(),
                        'image_size' => $image->getSize(),
                        'product_id' => $product->id
                    ]);
                }
            }
    
            DB::commit();
            return response()->json($product, 200);
    
        } catch (\Exception $e) {
            \Log::info($e);
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $requestData = $request->all();
            $requestData['user_id'] = \Auth::id();
    
            // Validate the data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'category' => 'nullable|string',
                'description' => 'nullable|string',
                'expiration_date' => 'nullable|date',
                'images.*' => 'file|image|max:2048',
                'old_images' => 'nullable|array', // Add validation for old_images
                'old_images.*' => 'nullable|string', // Path of old images
            ]);
    
            // Find the product
            $product = Product::findOrFail($id);
            $product->fill($validatedData);
            $product->save();
    
            // Delete the old images that are no longer in use
            if ($request->has('old_images')) {
                $oldImages = $request->input('old_images');
                ProductFiles::where('product_id', $product->id)
                    ->whereNotIn('image_path', $oldImages) // Delete images not in old_images
                    ->delete();
            }
    
            // Handle new image uploads
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('uploads/products', 'public');
                    $imagePaths[] = $path;
    
                    ProductFiles::create([
                        'image_path' => $path,
                        'image_type' => $image->getMimeType(),
                        'image_size' => $image->getSize(),
                        'product_id' => $product->id
                    ]);
                }
            }
    
            DB::commit();
            return response()->json($product, 200);
        } catch (\Exception $e) {
            \Log::info($e);
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function delete($id){
       Product::find($id)->delete();
    }

    public function index(){
        return Product::with('images')->get();
    }
}
