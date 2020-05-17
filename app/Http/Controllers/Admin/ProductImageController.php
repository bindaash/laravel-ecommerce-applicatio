<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadAble;
use App\Models\ProductImage;
use App\Contracts\ProductContract;

class ProductImageController extends Controller
{
    use UploadAble;

    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {   //dd($productRepository);
        $this->productRepository = $productRepository;
    }

    public function upload(Request $request)
    {   //dd($request);
        $product = $this->productRepository->findProductById($request->product_id);

        if ($request->has('image')) {

            $image = $this->uploadOne($request->image, 'products');

            $productImage = new ProductImage([
                'full'      =>  $image,
            ]);

            $product->images()->save($productImage);
        }

        return response()->json(['status' => 'Success']);
    }

    public function delete($id)
    {
        $image = ProductImage::findOrFail($id);
       //$prd_id = $image->product_id;
        if ($image->full != '') { 
            $this->deleteOne($image->full);
            //session()->flash('error', $this->errorMessages);
        }
        $image->delete();
        
        return redirect()->back();
        //return redirect()->back()->with('success','Item deleted successfully!');
        
        //return header("Refresh:0");
    }




}
