<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use Intervention\Image\Facades\Image;
use App\Models\ProductThumb;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Size;


class ProductController extends Controller
{
    function add_product()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.product.add_product', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    function getsubcategory(Request $request)
    {
        $str = '<option value="">-- Select Category --</option>';
        $subcategories =  Subcategory::where('category_id', $request->category_id)->get();

        foreach ($subcategories as $subcategory) {
            // $str = 'option value="">$subcategory->subcategory_name</option>';
            $str .= '<option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        }

        //this echo is from ajax-------
        echo $str;
    }

    function product_store(Request $request)
    {
        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'after_discount' => $request->price - ($request->price * $request->discount) / 100,
            'brand' => $request->brand,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'slug' => Str::lower(str_replace(' ', '-', $request->product_name) . '-' . rand(100000, 999999)),
            'created_at' => Carbon::now(),


        ]);

        $uploaded_file = $request->preview;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', $request->product_name) . '-' . rand(100000, 999999) . '.' . $extension);
        Image::make($uploaded_file)->resize(623, 800)->save(public_path('uploads/product/preview/' . $file_name));

        Product::find($product_id)->update([
            'preview' => $file_name,
        ]);
        // return back();

        $uploaded_thumbnails = $request->thumbnails;

        foreach ($uploaded_thumbnails as $thumbnail) {

            $thumb_extension = $thumbnail->getClientOriginalExtension();
            $thumb_name = Str::lower(str_replace(' ', '-', $request->product_name) . '-' . rand(100000, 999999) . '.' . $thumb_extension);
            Image::make($thumbnail)->resize(623, 800)->save(public_path('uploads/product/thumbnail/' . $thumb_name));

            ProductThumb::insert([
                'product_id' => $product_id,
                'thumbnail' => $thumb_name,
                'created_at' => Carbon::now(),
            ]);
        }

        return back();
    }

    function product_list()
    {
        $products = Product::all();
        return view('admin.product.product_list', [
            'products' => $products,
        ]);
    }

    function product_inventory($product_id)
    {
        $product_info = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::Where('product_id', $product_id)->get();
        return view('admin.product.inventory', [
            'product_info' => $product_info,
            'colors' => $colors,
            'sizes' => $sizes,
            'inventories' => $inventories,
        ]);
    }

    function product_variation()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.variation', [
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    function add_color(Request $request)
    {
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);

        return back();
    }

    function color_delete($color_id)
    {
        Color::find($color_id)->delete();

        return back();
    }

    function add_size(Request $request)
    {
        Size::insert([
            'size_name' => $request->size_name,
        ]);

        return back();
    }

    function size_delete($size_id)
    {
        Size::find($size_id)->delete();

        return back();
    }

    function inventory_store(Request $request)
    {

        if (Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()) {
            Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
            return back();
        } else {
            Inventory::Insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
            ]);

            return back();
        }
    }

    function inventory_delete($inventory_id)
    {
        Inventory::find($inventory_id)->delete();
        return back();
    }

    function product_delete($product_id)
    {
        $preview_image = Product::where('id', $product_id)->get();
        $delete_from = public_path('uploads/product/preview/' . $preview_image->first()->preview);
        unlink($delete_from);
        Product::find($product_id)->delete();

        $thumbs = ProductThumb::where('product_id', $product_id)->get();
        foreach ($thumbs as $thumb) {
            // echo $thumb->thumbnail.'<br>';
            $delete_thumb_from = public_path('uploads/product/thumbnail/' . $thumb->thumbnail);
            unlink($delete_thumb_from);
            ProductThumb::find($thumb->id)->delete();
        }


        $inventories = Inventory::where('product_id', $product_id)->get();

        foreach ($inventories as $inventory) {
            Inventory::find($inventory->id)->delete();
        }

        return back();
    }
}
