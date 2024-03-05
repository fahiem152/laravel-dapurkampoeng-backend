<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = OrderItem::query();

        $query->select('order_items.*', DB::raw('(SELECT name FROM products WHERE products.id = order_items.product_id) AS product_name'));

        if ($start_date && $end_date) {
            $query->whereBetween('order_items.created_at', [$start_date, $end_date]);
        }

        $orderItems = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $orderItems
        ], 200);
    }
}
