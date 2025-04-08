<?php

namespace App\Http\Controllers\Website;

use App\Models\Article;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\ArticleResource;

class ArticleController extends Controller
{
    use ApiResponse;

    public function index() {
        $articles = ArticleResource::collection(Article::with('user')->latest()->paginate(5));
        return $this->successResponse($articles, 'Articles fetched successfully');
    }
}
