# Install

``` sh
cp env-example .env
```

then Edit your .env file

``` sh
php artisan key:generate
php passport:client
php artisan migrate [--seed]

```

You can edit mock data seedxer at [database/seeds/DatabaseSeeder.php](database/seeds/DatabaseSeeder.php)

## Seed all Mock Data

```sh
php artisan db:seed
```

## Clean Data

```sh
php artisan migrate:refresh [--seed]
```

## To work with docker

see [iodock](https://git.iotech.co.th/peelz/iodock)

## Flow

Create doc -> sent_to -> User -> comment back to sender -> get it ;
                            -> forward to other;

in this flow if receiver is who can approval doc, it can be approved or cancel ;