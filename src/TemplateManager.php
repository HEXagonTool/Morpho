<?php

    namespace HEXagonTool\Morpho;

    class TemplateManager {
        // Экземпляр синглтона для ViewCollection
        private static $viewCollectionInstance = null;
    
        private $dir;    // Директория для представлений
        private $context; // Контекст (например, подпапка или дополнительный путь)
    
        /**
         * Приватный конструктор TemplateManager.
         * Этот конструктор нельзя вызвать извне, он используется только внутри метода синглтона.
         * 
         * @param string $dir Директория для представлений.
         * @param string $context Контекст (например, подпапка или дополнительный путь).
         */
        private function __construct($dir, $context) {
            $this->dir = $dir;
            $this->context = $context;
        }
    
        /**
         * Метод синглтона для получения экземпляра ViewCollection.
         * Если экземпляр еще не создан, он будет инициализирован.
         *
         * @param string $dir Директория для представлений (по умолчанию пустая строка).
         * @param string $context Контекст (по умолчанию пустая строка).
         * @return ViewCollection Экземпляр ViewCollection.
         */
        public static function create($dir = '', $context = '') {
            if (self::$viewCollectionInstance === null) {
                // Если экземпляр ViewCollection еще не создан, создаем его.
                self::$viewCollectionInstance = new ViewCollection($dir, $context);
            }
            return self::$viewCollectionInstance;
        }
    
        /**
         * Алиас для метода create(). Возвращает экземпляр ViewCollection.
         * Используется для работы с представлениями.
         *
         * @return ViewCollection Экземпляр ViewCollection.
         */
        public static function getViews() {
            return self::create();
        }
    
        /**
         * Алиас для метода create(). Возвращает экземпляр ViewCollection.
         * Используется для работы с компонентами.
         *
         * @return ViewCollection Экземпляр ViewCollection.
         */
        public static function getComponents() {
            return self::create();
        }
    }
    