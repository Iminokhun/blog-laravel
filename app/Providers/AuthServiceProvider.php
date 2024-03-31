<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate::define('update-post', function (User $user, Post $post){
        //     return $user->id === $post->user_id;
        // });

        // Gate::define('delete-post', function (User $user, Post $post){
        //     return $user->id === $post->user_id;
        // });
        
        Gate::define('create-post', function (User $user, Role $role) 
        {
            return $user->hasRole($role->name);
        });

        Gate::define('update-post', function (User $user, Post $post) 
        {
            if ($user->id === $post->user_id || $user->hasRole('admin')) {
                // User is the author of the post or an admin, allow update
                return true;
            } else {
                // User is not authorized to update the post
                return false;
            }
        });

        Gate::define('delete-post', function (User $user, Post $post) 
        {
            if ($user->id === $post->user_id || $user->hasRole('admin')) {
                // User is the author of the post or an admin, allow update
                return true;
            } else {
                // User is not authorized to update the post
                return false;
            }
        });
    }
}
