<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use JWTAuth;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->authorizeResource(Post::class, 'post');
    }

    public function createItem(Request $request)
    {
        $this->authorize('update', Post::class);

        $item = Post::create(array_merge(
            $request->all(), [
                'writer' => Auth::user()->getAuthIdentifier()
            ]
        ));

        $item->addMediaFromRequest('image')
            ->toMediaCollection('downloads');

        return response()->json([
            'data' => $item
        ]);
    }

    public function getItems(Request $request)
    {
        $items = Post::all();

        return response()->json([
            'data' => $items
        ]);
    }
}
