<?php

namespace ToJsonConverter;

/**
 * Интерфейс для чтения значений из источника.
 */
interface Reader
{
    /**
     * @param string $path Путь до csv файла.
     * @return array|null Возвращает массив строк csv файла или null при возникновении ошибки.
     */
    public function read(string $path): ?array;
}