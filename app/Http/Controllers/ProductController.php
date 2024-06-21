<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $products = Product::leftJoin('categories', 'categories.id', '=', 'products.category_id')->get(['products.id', 'category_name', 'product_name', 'product_desc', 'price', 'stock', 'product_image', 'is_active']);

        // $questions = Question::leftJoin('answers', 'answers.id', '=', 'questions.answer_key')->orderBy('questions.created_at', 'ASC')->get(['questions.id', 'questions.question', 'questions.answer_key', 'answer', 'pos']);

        return view('product', [
            'title' => "Product Management | E-Mart",
            'pageIndex' => 2,
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validate($request, [
                'product_image' => 'mimes:png,jpg|image',
                'product_name' => 'required|max:255',
                'product_desc' => 'required',
                'price' => 'required',
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['error' => 'Terjadi Kesalahan', 'errors' => $errors], 422);
        }

        // Check product image
        if ($request->hasFile('product_image')) {
            $product_image = $request->file('product_image');
            $imageName = Str::random(20) . '.' . $product_image->getClientOriginalExtension();
        } else {
            $product_image = "";
            $imageName = "defaultProd.png";
        }

        $productData = new Product;
        $productData->product_name = $validatedData['product_name'];
        $productData->product_image = $imageName;
        $productData->product_desc = $validatedData['product_desc'];
        $productData->price = $validatedData['price'];
        $productData->stock = $request->stock;
        $productData->is_active = $request->is_active;

        if ($productData->save()) {

            if ($product_image != null) {
                $product_image->storeAs('public/product_img/', $imageName);
            }

            return response()->json(
                ['messages' => 'New Product Created'],
                Response::HTTP_OK
            );
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);

        if ($data != null) {
            return response()->json([
                'status' => 200,
                'data' => $data,
                'messages' => "Find edit berhasil"
            ], Response::HTTP_OK);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);

        if ($request->hasFile('product_image_new')) {
            $validatedData = $this->validate($request, [
                'product_image_new' => 'mimes:jpg,png,jpeg|image'
            ]);

            // if request has file delete old image
            $oldName = $product->product_image;

            if ($oldName != "defaultProd.png") {
                $oldPath = 'storage/product_img/' . $oldName;
                // check file exist
                if (File::exists(($oldPath))) {
                    File::delete($oldPath);
                }
            }

            $newImage = $validatedData['product_image_new'];
            $newName = Str::random(20) . '.' . $newImage->getClientOriginalExtension();

            $newImage->storeAs('public/product_img/', $newName);
            $newPath = 'storage/product_img/' . $newName;

            if (File::exists($newPath)) {
                $product->product_image = $newName;

                if ($product->save()) {
                    return response()->json(['status' => 200, 'messages' => 'Successfully save new image.']);
                } else {
                    return response()->json(['status' => 500, 'messages' => 'Failed to save new image.']);
                }
            } else {
                abort(response()->json('New image failed to upload', 500));
            }
        }

        $categoryId = $request->category_id;
        $is_active = $request->is_active;

        if ($categoryId == null || "") {
            $categoryId = $product['category_id'];
        }

        if ($is_active == null || "") {
            $is_active = $product['is_active'];
        }

        $updateData = [
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $categoryId,
            'is_active' => $is_active
        ];

        if ($product->update($updateData)) {
            return response()->json(['status' => 200, 'messages' => 'Successfully updated product data']);
        } else {
            return response()->json(['status' => 500, 'messages' => 'Failed to update product data.']);
        }
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        return redirect()->route('product.index');
    }
}
