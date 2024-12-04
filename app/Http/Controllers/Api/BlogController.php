<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return response()->json(BlogResource::collection($blogs));
    }
}
