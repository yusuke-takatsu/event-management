<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Post;
use App\Enums\PostStatus;
use App\Http\Requests\TestRequest;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function store(TestRequest $request, Post $post)
    {
        $postInstance = Post::from([
          'title' => 'Hello laravel-data',
          'content' => 'This is an introduction post for the new package',
          'status' => PostStatus::PUBLISHED,
          'published_at' => CarbonImmutable::now(),
        ]);

        return;
    }
}
