<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function cart()
{
    return $this->hasMany(Cart::class);
}
    use HasFactory;
    protected $table ='products';
    public $timestamps = false;
    protected $fillable=[
        'slide_url','title','price',
    ];
//     public function index(Request $request)
// {
//     $categories = Category::all(); // Retrieve all categories
//     $query = $request->input('query'); // Get the search query from the request

//     // Query products based on the search query
//     $products = Product::where('title', 'like', "%$query%")
//                         ->orWhere('description', 'like', "%$query%")
//                         ->get();

//     return view('your_view_name', compact('categories', 'products'));
// }
}
