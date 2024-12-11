<?php

namespace HEXagonTool\Morpho;

class View {
    private $path;     // Полный путь к файлу представления.
    private $viewName; // Имя представления (имя файла без расширения).

    /**
     * Конструктор представления.
     * Формирует путь к файлу представления на основе директории и контекста.
     *
     * @param string $dirViewCollection Базовая директория коллекции представлений.
     * @param string $context Контекст (например, подпапка или уточнение).
     * @param string $viewName Имя представления (без расширения).
     */
    public function __construct($dirViewCollection, $context, $viewName) {
        $this->viewName = $viewName;
        $this->path = $dirViewCollection . $context . $this->viewName . '.php';
    }

    /**
     * Возвращает путь к файлу представления.
     * Если файл не существует, выбрасывает исключение.
     *
     * @return string Полный путь к файлу представления.
     * @throws Exception Если файл представления не найден.
     */
    public function getPath() {
        if (!file_exists($this->path)) {
            throw new Exception("Файл представления не найден: " . $this->path);
        }
        return $this->path;
    }

    /**
     * Получает содержимое представления.
     * Буферизует вывод и подключает файл представления.
     *
     * @param array $data Данные, которые передаются в представление.
     * @param array $options Опции рендера, включая:
     *                       - 'wrap': нужно ли оборачивать содержимое в контейнер (по умолчанию true).
     * @return string Содержимое представления (с или без обертки).
     */
    public function getContent($data = [], $options = null) {
        // Буферизация вывода: подключаем файл представления.
        ob_start();
        include($this->getPath());
        $html_content = ob_get_clean();

        // Если включена опция обертки, добавляем контейнер.
        if ($options['wrap']) {
            $html_content = $this->wrapView($html_content);
        }

        return $html_content;
    }

    /**
     * Оборачивает содержимое представления в HTML-контейнер.
     * Формирует контейнер с CSS-классом на основе имени представления.
     *
     * @param string $content Содержимое представления.
     * @return string Содержимое представления, обернутое в div с классом.
     */
    public function wrapView($content) {
        // Создаем CSS-класс на основе имени представления.
        $className = self::createViewClassName($this->viewName);

        // Формируем HTML-контейнер.
        return "<div class=\"component-wrapper $className\">$content</div>";
    }

    /**
     * Создает имя CSS-класса на основе имени представления.
     * Заменяет слэши в имени представления на дефисы.
     *
     * @param string $view Имя представления (например, путь к файлу).
     * @return string Имя CSS-класса.
     */
    public static function createViewClassName($view) {
        // Удаляем начальный слэш, если он есть.
        if (substr($view, 0, 1) === '/') {
            $view = substr($view, 1);
        }

        // Заменяем все оставшиеся слэши на дефисы.
        return str_replace('/', '-', $view);
    }
}
