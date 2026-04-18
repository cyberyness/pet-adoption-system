<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::paginate(9);
        return view('index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->merge(['user_id' => auth()->user()->id]);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0|max:30',
            'gender' => 'nullable|string|in:male,female',
            'weight' => 'nullable|numeric|min:0|max:70',
            'vaccinated' => 'nullable|boolean',
            'status' => 'required|in:available,adopted',
            'file_name' => 'nullable',
            'user_id' => 'required|integer',
        ]);
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('pics'), $fileName);
            $validatedData['file_name'] = $fileName;
        } else {
            $validatedData['file_name'] = null;
        }
        $validatedData['vaccinated'] = $request->has('vaccinated');
        $pet = Pet::create($validatedData);
        return redirect('/pets')->with('success', 'The Pet is successfully saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pet = Pet::findOrFail($id);

        if (auth()->user()->isAdmin != 1 && auth()->user()->id != $pet->user_id) {
            return redirect('/pets')->with('error', 'You are not admin!');
        }

        return view('edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pet = Pet::findOrFail($id);
        if (auth()->user()->isAdmin != 1 && auth()->user()->id != $pet->user_id)

            return redirect('/pets')->with('error', 'You are not admin!');
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0|max:30',
            'gender' => 'nullable|string|in:male,female',
            'weight' => 'nullable|numeric|min:0|max:70',
            'vaccinated' => 'nullable|boolean',
            'status' => 'required|in:available,adopted',
            'file_name' => 'nullable',
        ]);
        $validatedData['vaccinated'] = $request->has('vaccinated');
        if ($request->hasFile('file_name')) {


            if ($pet->file_name && file_exists(public_path('pics/' . $pet->file_name))) {
                unlink(public_path('pics/' . $pet->file_name));
            }


            $fileName = time() . '.' . $request->file_name->getClientOriginalExtension();
            $request->file_name->move(public_path('pics'), $fileName);

            $validatedData['file_name'] = $fileName;
        }
        Pet::whereId($id)->update($validatedData);
        return redirect('/pets')->with('success', 'Pet data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = Pet::findOrFail($id);
        if (auth()->user()->isAdmin != 1 && auth()->user()->id != $pet->user_id)

            return redirect('/pets')->with('error', 'You are not admin!');
        if ($pet->file_name && file_exists(public_path('pics/' . $pet->file_name))) {
            unlink(public_path('pics/' . $pet->file_name));
        }
        $pet->delete();
        return redirect()->back()->with('success', 'Pet data is successfully deleted');

    }

    public function adopt($id)
    {
        $pet = Pet::findOrFail($id);

        if (auth()->user()->isAdmin != 1) {
            return redirect('/pets')->with('error', 'You are not admin!');
        }

        $pet->status = 'adopted';
        $pet->save();

        return redirect()->back()->with('success', 'Pet has been adopted');
    }

}
