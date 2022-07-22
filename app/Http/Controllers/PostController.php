<?php

namespace App\Http\Controllers;

use App\Jobs\ConvertCelsius;
use App\Jobs\FindMaxPrime;
use App\Jobs\MakeDiv;
use App\Jobs\MakeSum;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $posts = Post::all();

        return view('posts.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $path = $request->photo->store('public/images');

        Post::create(
            [
                'image' => Storage::url($path),
                'description' => $request->description,
                'user_id' => $user->id
            ]
        );

        return redirect('/dashboard');
    }

    /**
     * Like the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function like(Post $post)
    {
        $user = auth()->user();

        // Buscar likes dados pelo usuário neste post
        $numOfLikes = Like::where('user_id', '=', $user->id)
            ->where('post_id', '=', $post->id)
            ->count();

        // Se tiver like do usuário neste post
        if ($numOfLikes > 0) {
            Like::where('user_id', '=', $user->id)
                ->where('post_id', '=', $post->id)
                ->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Like removido com sucesso',
                    'like' => false
                ]
            );
        }

        Like::create([
            'post_id' => $post->id,
            'user_id' => $user->id
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Like criado com sucesso',
                'like' => true
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function photo()
    {
        return view('posts.photo');
    }

    public function photostore(Request $request)
    {
        $user = auth()->user();

        $path = $request->photo->store('public/file.jpg');

        Post::create(
            [
                'image' => Storage::url($path),
                'description' => $request->description,
                'user_id' => $user->id
            ]
        );

        return redirect('/dashboard');
    }

    public function image()
    {
        return view('posts.images');
    }

    public function imagestore(Request $request)
    {
        $user = auth()->user();

        $path = $request->image1->store('public/images/file1.jpg');
        $path = $request->image2->store('public/images/file2.jpg');

        Post::create(
            [
                'image' => Storage::url($path),
                'description' => $request->description,
                'user_id' => $user->id
            ]
        );

        return redirect('/dashboard');
    }

    public function document()
    {
        return view('posts.document');
    }

    public function documentstore(Request $request)
    {
        $user = auth()->user();

        $path = $request->file->storeAs(
            'public/documents',
            $request->file->name
        );

        Post::create(
            [
                'image' => Storage::url($path),
                'description' => $request->description,
                'user_id' => $user->id
            ]
        );

        return redirect('/dashboard');
    }

    public function prime($limit)
    {
        FindMaxPrime::dispatch($limit, auth()->id());

        return 'Primo sendo encontrado perâ ai';
    }

    public function job($num1, $num2)
    {
        MakeSum::dispatch($num1, $num2, auth()->id());

        return 'Conta sendo realizada';
    }
    public function convert($farenheit)
    {
        ConvertCelsius::dispatch($farenheit);

        return 'conversão sendo realizada';
    }

    public function div($num1, $num2)
    {
        MakeDiv::dispatch($num1, $num2, auth()->id());

        return 'valores sendo dividados';
    }
}
