<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Category;
use App\Models\AcceptedTicket;
use App\Models\Cart;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $showAll = $request->query('show_all', false); // Check if the 'show_all' query parameter is present

        // Query the stocks based on the 'showAll' value
        $stocksQuery = $showAll ? Stock::query() : Stock::where('quantity', '>', 0);

        // Check if a category filter is applied
        if ($request->has('category')) {
            $categoryFilter = $request->input('category');

            // If the category filter is not "all", apply the category filter
            if ($categoryFilter !== 'all') {
                $stocksQuery->where('category', $categoryFilter);
            }
        }

        // Retrieve the stocks with their category information
        $stocks = $stocksQuery->get();

        // Get all categories for the category filter dropdown
        $categories = Category::all();

        return view('stocks.index', compact('stocks', 'showAll', 'categories', 'categoryFilter'));
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
            'date_purchased' => 'nullable|date',
            'status' => 'nullable|in:brandnew,used',
        ]);

        // Retrieve the status and date_purchased data
        $status = $request->input('status');
        $datePurchased = $request->input('date_purchased');

        // Retrieve the selected category ID from the request
        $categoryId = $validatedData['category'];

        // Retrieve the category name associated with the selected category ID
        $category = Category::findOrFail($categoryId);
        $categoryName = $category->name;

        // Create the stock with the selected category name, status, and date_purchased
        $stock = new Stock();
        $stock->category = $categoryName;
        $stock->quantity = $validatedData['quantity'];
        $stock->details = $validatedData['details'];
        $stock->date_purchased = $datePurchased; // Set the date_purchased value
        $stock->status = $status; // Set the status value
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
            'date_purchased' => 'nullable|date',
            'status' => 'nullable|in:brandnew,used',
        ]);

        $stock = Stock::findOrFail($id);

        // Retrieve the current quantity of the stock
        $currentQuantity = $stock->quantity;

        // If the quantity field is empty in the request, set it to the current quantity
        $validatedData['quantity'] = $validatedData['quantity'] ?? $currentQuantity;

        // Add the quantity from the request to the existing quantity
        $existingQuantity = $stock->quantity;
        $newQuantity = $existingQuantity + $request->input('quantity', 0);
        $validatedData['quantity'] = $newQuantity;

        // Retrieve the status and date_purchased data
        $status = $request->input('status');
        $datePurchased = $request->input('date_purchased');

        // Set the status and date_purchased values
        $stock->date_purchased = $datePurchased;
        $stock->status = $status;

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
            return Redirect::back()->with('error', 'Insufficient stock quantity.');
        }

        // Check if the cart already contains an item with the same stock ID
        $existingCartItem = Cart::where('stock_id', $stock->id)->first();

        if ($existingCartItem) {
            // Increment the quantity of the existing cart item
            $existingCartItem->increment('quantity', $quantity);
        } else {
            // Create a new cart item and associate it with the stock
            $cartItem = new Cart();
            $cartItem->stock_id = $stock->id;
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        // Decrease the stock quantity
        $stock->decrement('quantity', $quantity);

        return Redirect::back()->with('success', 'Item added to cart successfully.');
    }
    public function removeCartItem($id)
    {
        $cartItem = Cart::findOrFail($id);
        $stock = Stock::findOrFail($cartItem->stock_id);

        // Increase the stock quantity
        $stock->increment('quantity', $cartItem->quantity);

        // Delete the cart item
        $cartItem->delete();

        return Redirect::back()->with('success', 'Item removed from cart successfully.');
    }

    public function clearCart()
    {
        $cartItems = Cart::all();

        foreach ($cartItems as $cartItem) {
            $stock = Stock::findOrFail($cartItem->stock_id);

            // Increase the stock quantity
            $stock->increment('quantity', $cartItem->quantity);
        }

        Cart::truncate();

        return Redirect::back()->with('success', 'Cart cleared successfully. Quantity returned to stock.');
    }
}
