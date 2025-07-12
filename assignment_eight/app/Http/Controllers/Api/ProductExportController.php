<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductExportController extends Controller
{
    public function export(Request $request): StreamedResponse
    {
        $format = $request->query('format', 'json'); // default to JSON

        $products = Product::with('category')->get();

        if ($format === 'csv') {
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="products.csv"',
            ];

            $callback = function () use ($products) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['ID', 'Name', 'Description', 'Price', 'Quantity', 'Category']);

                foreach ($products as $product) {
                    fputcsv($handle, [
                        $product->id,
                        $product->name,
                        $product->description,
                        $product->price,
                        $product->quantity,
                        $product->category?->name,
                    ]);
                }

                fclose($handle);
            };

            return response()->stream($callback, 200, $headers);
        }

        // Default JSON response
        return response()->json($products);
    }
}
