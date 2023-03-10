<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductThumb;
use App\Models\Size;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class FrontendController extends Controller
{
    // function home(){
    //     return view('welcome');
    // }
    function home()
    {
        $categories = Category::all();
        $products = Product::latest()->take(8)->get();
        // $products = Product::all();
        $feat_products = Product::take(4)->get();
        return view('frontend.index', [
            'categories' => $categories,
            'products' => $products,
            'feat_products' => $feat_products,
        ]);
    }

    function about()
    {
        return view('about');
    }

    // function master(){
    //     return view('frontend.master');
    // }
    // function index(){
    //     return view('frontend.index');
    // }

    function details($slug)
    {
        $product_info = Product::where('slug', $slug)->get();
        $thumbnails = ProductThumb::where('product_id', $product_info->first()->id)->get();
        $related_products = Product::where('category_id', $product_info->first()->category_id)->where('id', '!=', $product_info->first()->id)->get();
        $available_colors = Inventory::where('product_id', $product_info->first()->id)->groupBy('color_id')->selectRaw('count(*) as total, color_id')->get();
        $sizes = Size::all();
        $available_sizes = Inventory::where('product_id', $product_info->first()->id)->first()->size_id;

        


        return view('frontend.details', [
            'product_info' => $product_info,
            'thumbnails' => $thumbnails,
            'related_products' => $related_products,
            'available_colors' => $available_colors,
            'sizes' => $sizes,
            'available_sizes' => $available_sizes,
        ]);
    }

    function getSize(Request $request){
        $sizes = Inventory::where('product_id', $request->product_id)->where('color_id',$request->color_id)->get();
        $str='';
        foreach ($sizes as $size) {
            
            $str.= '<div class="form-check size-option form-option form-check-inline mb-2">
            <input class="form-check-input" value="'.$size->rel_to_size->id.'" type="radio"
                name="size_id" id="size'.$size->rel_to_size->id.'">
            <label class="form-option-label"
                for="size'.$size->rel_to_size->id.'">'.$size->rel_to_size->size_name.'</label>
        </div>';
        }
        echo $str;
    }

    //customer register login start

    function customer_register_login(){
        return view('frontend.login');
    }
}
