<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Jobs\ChangePost;
use App\Jobs\UploadBigFile;
use App\Mail\PostCreated as MailPostCreated;
use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
   public function __construct()
   {
     $this->middleware('auth')->except(['index', 'show']);
   }


    public function index()
    {
        $posts = Post::latest()->paginate(6);

        // $posts = Cache::remember('posts', now()->addSeconds(30), function () {    // for caching data
        //     return Post::latest()->get();                                         
        // });

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('create-post', Role::find(2));

        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        if ($request->hasFile('photo')){
            $path = $request->file('photo')->store('post-photos');
        }

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' =>$request->category_id,
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? null

        ]);

        if(isset($request->tags))
        {
            foreach ($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }

        PostCreated::dispatch($post);
        ChangePost::dispatch($post);
        Mail::to($request->user())->queue((new MailPostCreated($post))->onQueue('sending-mails'));

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5),
            'tags' => Tag::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update-post', $post);    // for gate

        // Gate::authorize('update', $post);   for policy
        

        return view('posts.edit')->with(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        Gate::authorize('update-post', $post);    // this for GATE

        // Gate::authorize('update', $post);  // for POLICY
        

        if ($request->hasFile('photo')){
            if (isset($post->photo))
            {
                Storage::delete($post->photo);
            }
            
            $path = $request->file('photo')->store('post-photos');
        }
        
        $post->update([
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? $post->photo,
        ]);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('update-post', $post);    // this for GATE

        if (isset($post->photo))
        {
            Storage::delete($post->photo);
        }
        $post->delete();

        return redirect()->route('posts.index');
    }
}
