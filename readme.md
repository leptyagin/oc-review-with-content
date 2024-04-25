## "Reviews with content" - module for opencart 3.х

## "Отзывы с контентом" - модуль для опенкарт 3.х (описание на русском ниже)




## About
The essence of the module is to output reviews with content that are added through the admin panel, the review displays an iframe from YouTube, a logo, a company name, a description and several images. It is possible to add, edit and delete reviews.
The module itself was written in a few hours and there are probably errors somewhere, please inform if possible

## ATTENTION
Everything you do with your site you do at your own risk, I do not bear any responsibility for you and your actions

## Installation
1. The SQL code from the `dump.sql` file must be executed into the database
2. Upload all files from the `upload` folder to the root folder 
3. In the admin panel, go to extensions and modifiers => modifiers and update the modifier cache

At this stage, the module can be considered installed and now it is displayed in the admin panel in extensions => extensions / modules => "Content reviews".
In use, the module adheres to the classic opencard UI, so there should be no problems

Now you need to output the module on the client side

## Output on client side
1. You need to decide on which page to display the module, let's say you need to display it on the main page (home)
2. Go to the home page `controller` in the directory `catalog/controller/common/home.php` and before the line `$data['column_left'] = $this->load->controller('common/column_left');` insert the line

```sh
$data['reviews_content'] = $this->load->controller('extension/module/content');
```

3. Next, go to the hone page `view` by directory `catalog/view/theme/YOUR_THEME/template/common/home.twig` and paste in the right place

```sh
{{ reviews_content }}
```

4. Now I suggest updating the modifier cache again (item 3 installation)


## Plans for the module
In the future, there are ideas and a desire to develop the module. I will be glad to receive any feedback. You can contact me in [telegram](https://t.me/leptyagin)





## О модуле
Суть модуля в выводе отзывов с контентом, которые добавляются через админку, в отзыве выводится iframe из ютуба, логотип, название компании, описание и несколько изображений. Есть возможность добавлять, редактировать и удалять отзывы.
Сам модуль был написан за несколько часов и где-то наверняка присутсвуют ошибки, прошу информировать по возможности

## ВНИМАНИЕ
Всё что Вы делаете со своим сайтом Вы делате на свой страх и риск, я не несу никакую ответственность за Вас и Ваши действия

## Установка модуля
1. SQL код из фала `dump.sql` необходимо выполнить в базу данных
2. Все файлы из папки `upload` загрузить в корневую папку 
3. В админке перейти в расширения и модификаторы => модифкаторы и обновить кэш модификаторов

На данном этапе модуль можно считать установленным и теперь он отображается в админке в расширения => расширения / модули => "Контент-отзывы".
В использовании модуль соблюдает классический UI опенкарт`а поэтому не должно возникнуть никаких проблем

Теперь нужно вывести модуль в клиентской части

## Вывод модуля на клиенте
1. Нужно решить на какой странице нужно вывести модуль, допустим нужно вывести на главной странице (home)
2. Переходим к контроллеру главной страницы по директории `catalog/controller/common/home.php` и перед строкой `$data['column_left'] = $this->load->controller('common/column_left');` вставляем строчку

```sh
$data['reviews_content'] = $this->load->controller('extension/module/content');
```

3. Далее переходим к вью главной страницы по директории `catalog/view/theme/ТВОЯ_ТЕМА/template/common/home.twig` и в нужном месте вставляем

```sh
{{ reviews_content }}
```

4. Теперь предлагаю еще раз обновить кэш модификаторов (п.3 установка)


## Планы на модуль
В дальнейшем, есть идеи и желание развивать модуль. Буду рад любой обратной связи. Связаться можно через [телеграм](https://t.me/leptyagin)