<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Enums\UserRole;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\Post;
use App\Models\SendNotification;
use App\Models\SendNotifications;
use App\Models\User;
use App\Policies\CategoriesPolicies;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicies;
use App\Policies\SendNotificationPolices;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Categories::class => CategoriesPolicies::class,
        User::class => UserPolicy::class,
        Post::class => PostPolicies::class,
        SendNotifications::class => SendNotificationPolices::class,
        Comment::class => CommentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('only-admin-writer', function (User $user) {
            return !($user->role === UserRole::User)
                        ? Response::allow()
                        : Response::deny();
        });
        Gate::define('only-admin',function(User $user){
            return $user->role === UserRole::Admin
                        ? Response::allow()
                        : Response::deny();
        });
    }
}
