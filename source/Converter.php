<?php

namespace ToJsonConverter;

class Converter
{
    protected Reader $reader;
    protected ?array $csvStrings;
    protected string $path;
    protected ?string $encodedCsv;

    /**
     * @param Reader $reader В качестве параметра передается экземпляр интерфейса Reader.
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param string $path Путь до csv файла.
     * @return $this Возвращает обновленный экземпляр Converter.
     */
    public function createEncoded(string $path): self
    {
        $this->setPath($path);
        $this->parseStrings();
        $this->encodeStrings();

        return $this;
    }

    /**
     * @return string|null Возвращает строку в формате JSON или null, если произошла ошибка.
     */
    public function getEncoded(): ?string
    {
        return $this->encodedCsv;
    }

    /**
     * @return void Не возвращает значений. Производит запись в JSON файл с тем же названием, что и csv файл.
     */
    public function saveToFile()
    {
        file_put_contents(pathinfo($this->path)['dirname'].'/'
                                 .pathinfo($this->path)['filename']
                                 .'.json', $this->encodedCsv);
    }

    protected function parseStrings()
    {
        $this->csvStrings = $this->reader->read($this->path);
    }

    protected function setPath($path)
    {
        $this->path = $path;
    }

    protected function encodeStrings()
    {
        $this->encodedCsv = json_encode($this->csvStrings);
    }
}