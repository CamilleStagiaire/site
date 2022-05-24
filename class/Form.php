<?php
class Form
{
    public static $class = "form-control";

    public static function checkbox(string $name, string $value = null, array $data = []): string
    {
        $attributes = '';

        if (isset($data[$name]) && in_array($value, $data[$name])) {
            $attributes .= 'checked';
        }
        $attributes = ' class="' . self::$class . '"';

        return <<<HTML
    <input class= "form-check-input" type= "checkbox" value="$value" name ="{$name}[]" $attributes>
HTML;
    }

    public static function radio(string $name, string $value, array $data): string
    {
        $attributes = '';

        if (isset($data[$name]) && $value === $data[$name]) {
            $attributes .= 'checked';
        }
        return <<<HTML
    <input class= "form-check-input" type= "radio" value="$value" name ="$name" $attributes>
HTML;
    }
}
