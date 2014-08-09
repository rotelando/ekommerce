<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class ProductController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        // Gets the products by their latest ID
        $limit = (int) Input::get('limit') ? Input::get('limit') : 10;
        //$page = (int) Input::get('page') ? Input::get('page') : 1;
        $products = Product::paginate($limit);

        // Set the response json
        return json_encode(array(
                    'total_count' => $products->getTotal(),
                    'page_count' => $products->count(),
                    'page' => $products->getCurrentPage(),
                    'product' => $products->toArray()
                        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getSearch() {
        //
        $name = Input::get("name");
        $products = Product::where('name','LIKE', "%{$name}%")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $product = new Product();
        $product->name = Input::get('name');
        $product->short_description = Input::get('short_description');
        $product->description = Input::get('description');
        $product->price = Input::get('price');
        $product->stock = Input::get('stock');
        $product->image_path = Input::get('image_path');

        // Validate here... should be done in the model
        $successful = $product->save();
        if (!$successful) {
            // Save error
            return json_encode(array('error_code' => 500, 'error_message' => 'Error while attempting to save'));
        }
        return json_encode(array(
                    'successful' => (bool) $successful,
                    'id' => $product->id,
                        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
        $product = Product::find($id);
        // Error handling below... might be exception next time
        if (!$product) {
            return json_encode(array('error_code' => 404, 'error_message' => 'Product Not found'));
        }
        return json_encode($product->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $product = Product::find($id);
        // Error handling below... might be exception next time
        if (!$product) {
            return json_encode(array('error_code' => 404, 'error_message' => 'Product Not found'));
        }
        
        // Now update the values
        $input = Input::all();
        foreach ($input as $key => $value) {
            if (!empty($value)) {
                $product->$key = $value;
            }
        }
//        $product->name = Input::get('name');
//        $product->short_description = Input::get('short_description');
//        $product->description = Input::get('description');
//        $product->price = Input::get('price');
//        $product->stock = Input::get('stock');
//        $product->image_path = Input::get('image_path');

        // Save
        $successful = $product->save();
        if (!$successful) {
            // Save error
            return json_encode(array('error_code' => 500, 'error_message' => 'Error while attempting to save'));
        }
        return json_encode(array(
                    'successful' => TRUE,
                    'id' => $product->id,
                        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        // Should trigger a soft delete
        if (!Product::find($id)) {
            return json_encode(array('error_code' => 404, 'error_message' => 'Product Not found'));
        }
        Product::destroy($id);

        return json_encodeResponse::json(array('successful' => TRUE));
    }

}
