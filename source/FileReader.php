<?php

namespace ToJsonConverter;

/**
 * Чтение значений из csv файла.
 */
class FileReader implements Reader
{
    public function read(string $path): ?array
    {
        if (($handle = fopen($path, 'r')) !== false) {
            $result = [];
            while (!feof($handle))
                $result[] = fgetcsv($handle);

            return $result;
        }

        return null;
    }
}



