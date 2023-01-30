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

 В роутере routes/web.php удалить:
 добавить
 ```
    \Teamperm\Library\TeampermRoute::routes();
 ```

Выполнить миграцию
 ```
    php artisan migrate 
 ``` 
