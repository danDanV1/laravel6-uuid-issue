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
