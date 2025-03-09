<?php 
namespace app;
class HtmlTag implements \Stringable
{
    public function __construct(
        public string $name = 'div', 
        public string|null $id = null, 
        public string|null $className = null, 
        public array $styles = [], 
        public string $innerHtml = '', 
        public array $customAtributes = []
        ) 
        {
        }

    public function render(): string
    {
        $content = "<{$this->name}";

        if ($this->id !== null) {
            $content .= " ";
            $content .= "id=\"{$this->id}\"";
        }

        if ($this->className !== null) {
            $content .= " ";
            $content .= "class=\"{$this->className}\"";
        }

        if (empty($this->styles) !== null) {

            $styles = [];

            foreach ($this->styles as $key => $value) {
                $styles[] = "$key: $value";
            }

            $content .= " ";
            $content .= 'style="' . implode('; ', $styles) . '"';
        }

        foreach ($this->innerTags as $innerTag) {
            if ($innerTag instanceof Renderable) {
                $this->innerHtml .= $innerTag->render();
            }
        }

        $content .= implode(' ', $this->customAttributes) . ">{$this->innerHtml}</{$this->name}>";

        return $content;
    }
    public function __toString()
    {
        return $this->render();
    }
}