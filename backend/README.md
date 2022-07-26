<h1 align="center">
    Space Slight News // Back-End
    <img src="../backend/public/mirage-virtual-reality.png" alt="Espaço" title="Espaço" height="100">
</h1>

## Project Setup
```sh
 ./vendor/bin/sail up
```

## Run queue

```sh
 ./vendor/bin/sail php artisan queue:listen
```

## Run Task Scheduling/Cron 

```sh
 ./vendor/bin/sail php artisan schedule:work
```