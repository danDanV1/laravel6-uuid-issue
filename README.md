## Reproduction of issue

Just run
`php artisan migrate:fresh --seed`

You should see this:

```
Dropped all tables successfully.
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated: 2014_10_12_000000_create_users_table (0.18 seconds)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated: 2014_10_12_100000_create_password_resets_table (0.13 seconds)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated: 2019_08_19_000000_create_failed_jobs_table (0.05 seconds)
Migrating: 2019_10_11_000000_create_flowers_table
Migrated: 2019_10_11_000000_create_flowers_table (0.06 seconds)
Migrating: 2019_10_12_000000_create_petals_table
Migrated: 2019_10_12_000000_create_petals_table (0.19 seconds)
Migrating: 2019_10_12_000000_create_posts_table
Migrated: 2019_10_12_000000_create_posts_table (0.32 seconds)
Found # of flowers: 1
Found # of petals: 3
Found # of flower->petals relations: 3
Found # of users: 1
Found # of posts: 3
Found # of user->posts relations: 0
```
Using binary uuid, we can create the related records just fine, but Laravel 6 can't related records after they've been created!

`users` and `posts` are using UUID binary for their IDs.
`flower` and `petals` are using regular int for their IDs.

Take a look at `storage/logs` for mysql logging output.

You can see the `post` record being created with a binary `id` and foreign key `user_id`
```
[2019-11-27 05:39:57] local.INFO: insert into `posts` (`title`, `user_id`, `id`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?)  
[2019-11-27 05:39:57] local.INFO: array (
  0 => 'Veniam error quod minima. Error laborum voluptatum sunt exercitationem dolor. Quis qui ipsa occaecati iste minus dolor omnis.',
  1 => '=��K�WE3��wQ
��',
  2 => '�7n��kLS�T$�L�',
  3 => '2019-11-27 05:39:57',
  4 => '2019-11-27 05:39:57',
```

But if you try to query the relationship, eg. `$user->posts` the cast value of `user_id` is used.
```
[2019-11-27 05:39:57] local.INFO: select * from `posts` where `posts`.`user_id` = ? and `posts`.`user_id` is not null  
[2019-11-27 05:39:57] local.INFO: array (
  0 => '3d93a84b-fb57-4533-96ab-1c77510ab4e0',
)  
```
