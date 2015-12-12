Symfony 2.x

MySql

Doctrine

Twig

 
   Выполнено

1. Backend



Проект должен состоять из 3-х страниц:

- Главная: site.com.

- Страница категории: site.com/category/name/

- Страница товара: site.com/item/name/

 
   Выполнено


1.1 На главной странице отображатся все товары из БД.

В правой колонке на главной странице отображается блок ссылок на категории товаров. Переходя по которой отображаются товары из данной категории.

1.2 Категории хранятся в таблице с 2 полями: id(primary key), name.

1.3 Товары хранятся в таблице с полями: id(primary key), name

1.4 Между таблицами товаров и категорий действуют отношение Many-to-Many

1.5 Структура таблиц должна описываться в анатационном формате

1.6 Запросы должны выполняться с помощью ORM Doctrine

1.7 Код должен соответствовать стандарту PSR-2

 

   Выполнено

2. Визуальное представление данных

2.1 Все оформление делается на Twitter Bootstrap простым оформлением, чтоб можно было удобно прокликать интерфейс.

 
   Выполнено

3. JavaScript

3.1 На главной странице появляется попап через 1 минуту после загрузки страницы, с произвольным текстом.

Попап можно закрыть по крестику, как это делается в обычных попапах.

 

Еще не реализовано
БОНУС:

Админка SonataAdminBundle и управление товарами.

- авторизация в админке, с вводом каптчи.


   Выполнено
- CRUD товаров.

   Выполнено

- пагинация товаров на главной странице.

 