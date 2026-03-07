<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('c_code', 'like', "%{$search}%")
                  ->orWhere('particulars', 'like', "%{$search}%")
                  ->orWhere('hsn', 'like', "%{$search}%");
        }

        $products = $query->latest()->paginate(50);
        
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'c_code' => 'nullable|string',
            'particulars' => 'required|string',
            'hsn' => 'nullable|string',
            'gst' => 'nullable|numeric',
            'igst' => 'nullable|numeric',
            'cgst' => 'nullable|numeric',
            'sgst' => 'nullable|numeric',
        ]);
        
        $data = $request->all();
        $data['except_particulars'] = $request->has('except_particulars') ? 1 : 0;
        $data['is_service'] = $request->has('is_service') ? 1 : 0;
        $data['active'] = $request->has('active') ? 1 : 0;

        Product::create($data);
       
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'c_code' => 'nullable|string',
            'particulars' => 'required|string',
            'hsn' => 'nullable|string',
            'gst' => 'nullable|numeric',
            'igst' => 'nullable|numeric',
            'cgst' => 'nullable|numeric',
            'sgst' => 'nullable|numeric',
        ]);
      
        $data = $request->all();
        $data['except_particulars'] = $request->has('except_particulars') ? 1 : 0;
        $data['is_service'] = $request->has('is_service') ? 1 : 0;
        $data['active'] = $request->has('active') ? 1 : 0;

        $product->update($data);
      
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }

        $product->delete();
       
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    /**
     * Export the products list in CSV format.
     */
    public function export(Request $request)
    {
        $fileName = 'products.csv';
        
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('c_code', 'like', "%{$search}%")
                  ->orWhere('particulars', 'like', "%{$search}%")
                  ->orWhere('hsn', 'like', "%{$search}%");
        }

        $products = $query->get();

        $columns = ['Id', 'CCode', 'Particulars', 'HSN', 'GST', 'IGST', 'CGST', 'SGST', 'ExcepParticulars', 'IsService', 'Active'];

        return response()->streamDownload(function () use ($products, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->c_code,
                    $product->particulars,
                    $product->hsn,
                    $product->gst,
                    $product->igst,
                    $product->cgst,
                    $product->sgst,
                    $product->except_particulars ? 1 : 0,
                    $product->is_service ? 1 : 0,
                    $product->active ? 1 : 0,
                ]);
            }
            fclose($file);
        }, $fileName);
    }
}
