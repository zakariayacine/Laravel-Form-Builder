<?php

namespace ZakariaYacineBoucetta\LaravelFormBuilder\Services;

use Illuminate\Support\Str;

class FormBuilderService
{
    public function generateFormComponent($inputs, $buttonName, $buttonClass, $method, $route)
    {
        $form = "<form method=\"{$method}\" action=\"{{ route('{$route}') }}\"";
        if (in_array('file', array_column($inputs, 'type'))) {
            $form .= " enctype=\"multipart/form-data\"";
        }
        $form .= ">\n";

        foreach ($inputs as $input) {
            $form .= $this->generateInputField($input);
        }

        $form .= "    <button type=\"submit\" class=\"{$buttonClass}\">{{ __('{$buttonName}') }}</button>\n";
        $form .= "</form>";

        return $form;
    }

    public function generateInputField($input)
    {
        $name = $input['name'];
        $type = $input['type'];
        $cssClass = $input['cssClass'];
        $fileTypes = $input['fileTypes'];
        $placeholder = $input['placeholder'];
        $label = $input['label'];
        $options = $input['options'];
        $field = "    <div>\n";

        if ($label) {
            $field .= "        <label for=\"{$name}\">{{ __('{$label}') }}</label>\n";
        }

        if ($type === 'select') {
            $field .= "        <select name=\"{$name}\" id=\"{$name}\" class=\"{$cssClass}\">\n";
            $field .= "            <option value=\"\" disabled selected>{{ __('{$placeholder}') }}</option>\n";
            foreach ($options as $option) {
                $field .= "            <option value=\"{$option['value']}\">{{ __('{$option['text']}') }}</option>\n";
            }
            $field .= "        </select>\n";
        } else {
            $field .= "        <input type=\"{$type}\" name=\"{$name}\" id=\"{$name}\" class=\"{$cssClass}\"";
            if ($placeholder) {
                $field .= " placeholder=\"{{ __('{$placeholder}') }}\"";
            }
            if ($type === 'file' && $fileTypes) {
                $field .= " accept=\"{$fileTypes}\"";
            }
            $field .= ">\n";
        }

        $field .= "        @error('{$name}')\n";
        $field .= "            <div class=\"text-red-500 mt-2 text-sm\">{{ \$message }}</div>\n";
        $field .= "        @enderror\n";
        $field .= "    </div>\n";

        return $field;
    }

    public function generateComponentClassContent($action, $route)
    {
        $cleanRoute = $this->convertRouteToCamelCase($route);
        $componentClassName = ucfirst($action) . $cleanRoute;
        return <<<PHP
<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class {$componentClassName} extends Component
{
    public function render(): View
    {
        return view('components.{$action}.{$componentClassName}');
    }
}
PHP;
    }

    public function generateJsonFile($inputs, $action, $route)
    {
        $jsonContent = [];
        foreach ($inputs as $input) {
            $jsonContent[$input['name']] = $input['name'];
        }

        $jsonDirectory = resource_path("lang/en/{$action}");
        if (!is_dir($jsonDirectory)) {
            mkdir($jsonDirectory, 0755, true);
        }

        $jsonFilename = Str::slug($route) . '.json';
        file_put_contents("{$jsonDirectory}/{$jsonFilename}", json_encode($jsonContent, JSON_PRETTY_PRINT));
    }

    public function convertRouteToCamelCase($route)
    {
        // Remplace les tirets et underscores par des espaces
        $cleanRoute = str_replace(['.','-', '_'], ' ', $route);
        // Élimine les espaces multiples
        $cleanRoute = preg_replace('/\s+/', ' ', $cleanRoute);
        // Met en majuscule chaque mot
        $cleanRoute = ucwords($cleanRoute);
        // Enlève les espaces
        return str_replace(' ', '', $cleanRoute);
    }
}
