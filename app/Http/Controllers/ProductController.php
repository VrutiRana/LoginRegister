<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Ixudra\Curl\Facades\Curl;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Product::all();
        return view('product.list',['alldocument'=>$getData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $path = storage_path('document');
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path, 0775, true, true);
            }
            if ($request->has('termscondition')){
                $imageFilename = $request->file('termscondition')->getClientOriginalName();
                $product= new Product();
                $product->terms_condition = $imageFilename;
                $product->save();
                $request->termscondition->storeAs('product_document',$imageFilename,'public');
                $response = Curl::to('http://www.foo.com')
                    ->withFile( 'document', $request->termscondition, $request->termscondition->getMimeType(), $imageFilename )
                    ->post();
                if ($response){
                    return response()->json(['success' => true, 'msg' => 'File Added Successfully']);
                }else{
                    return response()->json(['success' => false, 'msg' => 'Something Went Wrong']);
                }
            }else{
                return response()->json(['success' => false, 'msg' => 'Something Went Wrong']);
            }
        }catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B007  Add Document page');
            $request->session()->flash('message','Something Went wrong');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }

    public function downloadDoc($id){
        $fileName = Product::where('id',$id)->pluck('terms_condition')->first();
        if (!empty($fileName)) {
            ob_end_clean();
            $headers = array('Content-Type: image/*, application/pdf');
            return Storage::download('/public/product_document/' . $fileName, $fileName, $headers);
        }
    }
}
