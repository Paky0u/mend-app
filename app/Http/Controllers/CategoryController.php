<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::where('user_id', Auth::id())->orWhereNull('user_id')->orderBy('type')->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request) {
        Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type
        ]);
        return back()->with('success', 'Berhasil!');
    }

    public function destroy($id) {
        Category::where('user_id', Auth::id())->findOrFail($id)->delete();
        return back()->with('success', 'Dihapus!');
    }
    // Halaman Edit Kategori
    public function edit($id)
    {
        // Pastikan cuma bisa edit punya sendiri
        $category = Category::where('user_id', Auth::id())->findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Proses Update Kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense'
        ]);

        $category = Category::where('user_id', Auth::id())->findOrFail($id);
        
        $category->update([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diupdate!');
    }
}