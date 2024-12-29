# Как использовать 

Укажите папку в которой будет распологаться ваши шаблоны предсталения.

```php
HEXagonTool\Morpho\TemplateManager::create([
    'dir' => '/views/UI/',
]);
```

Далее создавайте свои Представления.
```html
<div>
    <h1>Test component</h1>
    <? if(isset($data['content'])) : ?>
        <p><?= $data['content'] ?></p>
    <?endif;?>
</div>
````
Вызывайте их в нужном месте
```php
$UI = HEXagonTool\Morpho\TemplateManager::getComponents();
$UI->render(['name' => 'test-component', 'data' => [
    'content' => 'Good lack!'
]])
```