<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Category;
use App\Models\AcceptedTicket;
use App\Models\Cart;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('category')->get();

        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('stocks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'quantity' => 'required|numeric',
            'details' => 'nullable',
        ]);

        // Retrieve the selected category ID from the request
        $categoryId = $validatedData['category'];

        // Retrieve the category name associated with the selected category ID
        $category = Category::findOrFail($categoryId);
        $categoryName = $category->name;

        // Create the stock with the selected category name
        $stock = new Stock();
        $stock->category = $categoryName;
        $stock->quantity = $validatedData['quantity'];
        $stock->details = $validatedData['details'];
        $stock->save();

        return redirect()->route('stocks.index')->with('success', 'Stock created successfully.');
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);

        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'quantity' => 'required|numeric',
            'details' => 'nullable',
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update($validatedData);

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
    }
    public function cart()
    {
        $cartItems = Cart::with('stock')->get();

        return view('stocks.cart', compact('cartItems'));
    }

    public function addtocart(Request $request, $id)
    {
        // Find the stock item to be added to the cart
        $stock = Stock::findOrFail($id);

        // Retrieve the quantity from the request
        $quantity = $request->input('quantity');

        // Ensure the requested quantity is available in the stock
        if ($stock->quantity < $quantity) {
            return redirect()->route('stocks.index')->with('error', 'Insufficient stock quantity.');
        }

        // Create a new cart item and associate it with the stock
        $cartItem = new Cart();
        $cartItem->stock_id = $stock->id;
        $cartItem->quantity = $quantity;
        $cartItem->save();

        // Decrease the stock quantity
        $stock->decrement('quantity', $quantity);

        return redirect()->route('stocks.index')->with('success', 'Item added to cart successfully.');
    }



}