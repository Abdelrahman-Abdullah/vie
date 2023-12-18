<?php

namespace App\Http\Controllers;

use App\Http\Resources\API\CategoryResource;
use App\Models\Category;
use App\Traits\Responses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Responses;
    public function index(): JsonResponse
    {
        return self::success('Categories retrieved successfully', [
            'categories' => CategoryResource::collection(Category::all('name')),
        ]);
    }
}
