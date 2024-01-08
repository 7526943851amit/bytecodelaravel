<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fooditem;
use Illuminate\Support\Facades\Auth;
class FooditemController extends Controller
{
    public function index()
    {
        if (!Auth::check()){
            return view('auth.login');
        }
        else{
            $fooditems = Fooditem::paginate(10);
            return view('dashboard', compact('fooditems'));
        }
     
    }

    public function create()
    {

        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'name' => 'required|min:5|max:10',
            'description' => 'required|min:2|max:255',
            'price' => 'required|numeric',
            'status' => 'required',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Fooditem::create([
            'image' => $imageName,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('fooditems.index')->with('success', 'Food item created successfully.');
    }

    public function show($id)
    {
        $fooditem = Fooditem::find($id);
        return view('fooditems.show', compact('fooditem'));
    }

    public function edit($id)
    {
        $fooditem = Fooditem::find($id);
        return view('edit', compact('fooditem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
        ]);

        $fooditem = Fooditem::find($id);

        if ($request->has('image')) {
            Storage::delete('images/'.$fooditem->image);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $fooditem->update(['image' => $imageName]);
        }

        $fooditem->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('fooditems.index')->with('success', 'Food item updated successfully.');
    }

    public function destroy($id)
    {
        $fooditem = Fooditem::find($id);
        $fooditem->delete();

        return redirect()->route('fooditems.index')->with('success', 'Food item deleted successfully.');
    }



    public function search(Request $request)
{
    $search = $request->input('search');
    $fooditems = fooditem::where('name', 'LIKE', "%$search%")
                       ->orWhere('price', 'LIKE', "%$search%")
                       ->paginate(10);  
// return $results;
return view('dashboard', compact('fooditems', 'search'));
//dgd
}
}