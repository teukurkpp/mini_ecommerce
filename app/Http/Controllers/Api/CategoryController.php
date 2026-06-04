<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @group Categories
     *
     * List Categories
     *
     * Menampilkan seluruh kategori.
     *
     * @authenticated
     */
    public function index()
    {
        return Category::all();
    }
}
