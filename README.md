<p align="center">
<img src="info/logo.jpg">
</p>

## Teamperm

Кароч изи пакет

## Установка из composer

```  
composer require slavawins/teamperm
```

Опубликовать js файлы, вью и миграции необходимые для работы пакета.
Вызывать команду:

```
php artisan vendor:publish --provider="Teamperm\Providers\TeampermServiceProvider"
``` 

В роутере routes/web.php добавить

 ```
    \Teamperm\Library\TeampermRoute::routes();
 ```

В Model User

 ```
    use  UserTeampermTrait;
 ```

В Model Project

 ```
 use  ProjectTeampermTrait;
 ```

Выполнить миграцию

 ```
    php artisan migrate 
 ``` 
