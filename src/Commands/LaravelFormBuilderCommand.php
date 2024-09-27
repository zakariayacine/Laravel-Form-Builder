<?php

namespace ZakariaYacineBoucetta\LaravelFormBuilder\Commands;

use Illuminate\Console\Command;
use ZakariaYacineBoucetta\LaravelFormBuilder\Facades\LaravelFormBuilder;

class LaravelFormBuilderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $inputs = [];
        $cssFramework = $this->choice('Select CSS framework', ['Bootstrap', 'Tailwind CSS']);
        $config = config('form-builder'); // Charge la configuration

        $cssClasses = $cssFramework === 'Bootstrap' ? $config['bootstrapClasses'] : $config['tailwindClasses'];
        $buttonColors = $cssFramework === 'Bootstrap' ? $config['bootstrapButtonColors'] : $config['tailwindButtonColors'];

        while (true) {
            $name = $this->ask('Enter the name of the input (or type "exit" to finish)');
            if (strtolower($name) === 'exit') {
                break;
            }
            // Validation pour le nom
            if (trim($name) === '') {
                $this->error('Input name cannot be empty or only contain spaces. Please enter a valid name.');
                continue; // Recommence la boucle pour entrer un nouveau nom
            }

            $type = $this->choice('Select the type of the input', $config['inputTypes']);

            $fileTypes = [];
            if ($type == 'file') {
                $selectedTypes = $this->choice(
                    'Select allowed file types (comma separated)',
                    array_keys($config['fileTypes']),
                    null,
                    null,
                    true
                );
                foreach ($selectedTypes as $selectedType) {
                    $fileTypes[] = $config['fileTypes'][$selectedType];
                }
            }

            $placeholder = null;
            if ($type !== 'select' && $this->confirm('Do you want to add a placeholder for this input?')) {
                while (true) {
                    $placeholder = $this->ask('Enter the placeholder text');
                    if (trim($placeholder) === '') {
                        $this->error('Placeholder cannot be empty or only contain spaces. Please enter a valid placeholder.');
                    } else {
                        break; // Sort de la boucle si le placeholder est valide
                    }
                }
            }

            $label = null;
            if ($this->confirm('Do you want to add a label for this input?')) {
                while (true) {
                    $label = $this->ask('Enter the label text');
                    if (trim($label) === '') {
                        $this->error('Label cannot be empty or only contain spaces. Please enter a valid label.');
                    } else {
                        break; // Sort de la boucle si le label est valide
                    }
                }
            }

            $options = [];
            if ($type === 'select') {
                while (true) {
                    $option = $this->ask('Enter an option (or type "done" to finish)');
                    if (strtolower($option) === 'done') {
                        break;
                    }
                    // Validation pour les options
                    if (trim($option) === '') {
                        $this->error('Option cannot be empty or only contain spaces.');
                        continue; // Recommence la boucle pour entrer une nouvelle option
                    }

                    $value = null;
                    while (true) {
                        $value = $this->ask('Enter the value for this option');
                        if (trim($value) === '') {
                            $this->error('Value cannot be empty or only contain spaces.');
                        } else {
                            break; // Sort de la boucle si la valeur est valide
                        }
                    }

                    $options[] = ['text' => $option, 'value' => $value];
                }
            }

            $inputs[] = [
                'name' => LaravelFormBuilder::convertRouteToCamelCase($name),
                'type' => $type,
                'cssClass' => $cssClasses[$type],
                'fileTypes' => implode(',', $fileTypes),
                'placeholder' => $placeholder,
                'label' => $label,
                'options' => $options
            ];
        }

        $buttonName = null;
        while (true) {
            $buttonName = $this->ask('Enter the name of the submit button');
            if (trim($buttonName) === '') {
                $this->error('Button name cannot be empty or only contain spaces. Please enter a valid name.');
            } else {
                break; // Sort de la boucle si le nom du bouton est valide
            }
        }

        $buttonColor = $this->choice('Select the button color', array_keys($buttonColors));
        $buttonClass = $buttonColors[$buttonColor];

        $method = $this->choice('Select the form method', ['POST', 'GET']);
        $route = $this->ask('Enter the route where the form should be submitted');

        // Conversion en camelCase
        // $formattedRoute = Str::studly(str_replace('.', ' ', $route)); // Convertit les points en espaces, puis applique StudlyCase
        $formattedRoute = LaravelFormBuilder::convertRouteToCamelCase($route);
        $action = $this->choice('Select the form action', ['create', 'update', 'delete']);

        // Générer le composant de formulaire
        $formComponent = LaravelFormBuilder::generateFormComponent($inputs, $buttonName, $buttonClass, $method, $route);

        // Générer le fichier de vue Blade
        $viewDirectory = resource_path("views/components/{$action}");
        if (!is_dir($viewDirectory)) {
            mkdir($viewDirectory, 0755, true);
        }

        $viewFilename = ucfirst($action) . $formattedRoute . '.blade.php';
        file_put_contents("{$viewDirectory}/{$viewFilename}", $formComponent);

        // Générer la classe du composant
        $componentClassContent = LaravelFormBuilder::generateComponentClassContent($action, $route);
        $componentClassName = ucfirst($action) . $formattedRoute;
        $componentDirectory = app_path('View/Components');
        if (!is_dir($componentDirectory)) {
            mkdir($componentDirectory, 0755, true);
        }
        $componentFilename = "{$componentDirectory}/{$componentClassName}.php";
        file_put_contents($componentFilename, $componentClassContent);

        // Générer le fichier JSON
        LaravelFormBuilder::generateJsonFile($inputs, $action, $route);

        $this->info('Form component generated successfully!');
    }
}
