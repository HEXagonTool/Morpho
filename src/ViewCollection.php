<?php

namespace HEXagonTool\Morpho;

class ViewCollection {
    private $dir;    // Директория для компонентов.
    private $context; // Контекст (например, подпапка или уточнение)

    /**
     * Конструктор коллекции представлений.
     * Инициализирует директорию и контекст, используемые при создании представлений.
     *
     */
    public function __construct($props) {

        $dir = $props['dir']; $context = $props['context'] ?? '';

        $this->dir = $dir;
        $this->context = $context;
    }

    /**
     * Рендерит представление с указанными параметрами.
     * Создает объект View и передает данные для рендеринга.
     *
     * @param string $viewName Имя представления.
     * @param mixed $data Данные, передаваемые в представление (по умолчанию null).
     * @param array $options Опции рендеринга, включая 'wrap' (оборачивать ли в контейнер, по умолчанию true).
     */
    public function render($props) {

        //параметры метода были изменениы на массив.
        //далее задаются обязательные и не обязательные параметры и их дефолтное значение
        $viewName = $props['name']; 
        $data = $props['data'] ?? null; 
        $options = $props['options'] ?? ['wrap' => true];

        // Создаем объект View для рендеринга.
        $view = new View($this->dir, $this->context, $viewName);
        
        // Получаем содержимое представления.
        $content = $view->getContent($data, $options);

        // Выводим содержимое представления.
        echo $content;
    }
}
