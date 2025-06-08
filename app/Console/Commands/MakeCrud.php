<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MakeCrud extends Command
{
    protected $signature = 'make:crud {schema}';
    protected $description = 'Generate migration, model, controller, and views based on a JSON schema';

    public function handle()
    {
        try {
            // $schemaPath = storage_path('app/schemas/' . $this->argument('schema') . '.json');
            $schemaPath = storage_path('app' . DIRECTORY_SEPARATOR . 'schemas' . DIRECTORY_SEPARATOR . $this->argument('schema') . '.json');
            if (!File::exists($schemaPath)) {
                $this->error('Schema file not found at ' . $schemaPath);
                Log::error('Schema file not found: ' . $schemaPath);
                return 1;
            }

            $schema = json_decode(File::get($schemaPath), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error('Invalid JSON schema: ' . json_last_error_msg());
                Log::error('Invalid JSON schema: ' . json_last_error_msg());
                return 1;
            }

            $model = $schema['model'] ?? null;
            $table = $schema['table'] ?? null;
            $fields = $schema['fields'] ?? [];
            $timestamps = $schema['timestamps'] ?? true;

            if (!$model || !$table || empty($fields)) {
                $this->error('Invalid schema: model, table, or fields missing');
                Log::error('Invalid schema: model, table, or fields missing');
                return 1;
            }

            // DELETE all previous CRUD files before generating again
            $this->deleteCrudFiles($model, $table);

            // Generate Migration
            if (!$this->generateMigration($model, $table, $fields, $timestamps)) {
                return 1;
            }

            // Generate Model
            if (!$this->generateModel($model, $fields)) {
                return 1;
            }

            // Generate Controller
            if (!$this->generateController($model)) {
                return 1;
            }

            // Generate Views
            if (!$this->generateViews($model, $table, $fields)) {
                return 1;
            }

            // Append Routes (after controller is generated)
            if (!$this->appendRoutes($model, $table)) {
                return 1;
            }

            $this->info("CRUD for {$model} generated successfully!");
            return 0;
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            Log::error('MakeCrud failed: ' . $e->getMessage(), ['exception' => $e]);
            return 1;
        }
    }

    protected function deleteCrudFiles($model, $table)
    {
        $this->info("Deleting existing files for {$model}...");

        $modelFile = app_path("Models/{$model}.php");
        if (File::exists($modelFile)) {
            File::delete($modelFile);
            $this->info("Deleted model: {$modelFile}");
        }

        $controllerFile = app_path("Http/Controllers/{$model}Controller.php");
        if (File::exists($controllerFile)) {
            File::delete($controllerFile);
            $this->info("Deleted controller: {$controllerFile}");
        }

        // Delete views directory
        $viewsDir = resource_path('views/' . \Illuminate\Support\Str::snake($model));
        if (File::exists($viewsDir)) {
            File::deleteDirectory($viewsDir);
            $this->info("Deleted views directory: {$viewsDir}");
        }

        // Delete migration files for this table (all matching *create_<table>_table.php)
        $migrationFiles = glob(database_path("migrations/*_create_{$table}_table.php"));
        foreach ($migrationFiles as $migration) {
            File::delete($migration);
            $this->info("Deleted migration: {$migration}");
        }

        // Remove route entry from routes/web.php
        $routesFile = base_path('routes/web.php');
        if (File::exists($routesFile)) {
            $routesContent = File::get($routesFile);
            $routeLine = "Route::resource('{$table}', {$model}Controller::class);";

            // Remove the route line and the possible "use" statement line above it
            $pattern = '/(\n?use\s+App\\\\Http\\\\Controllers\\\\' . preg_quote($model, '/') . 'Controller;\n)?\s*' . preg_quote($routeLine, '/') . '\n?/';

            $newContent = preg_replace($pattern, '', $routesContent);
            if ($newContent !== $routesContent) {
                File::put($routesFile, $newContent);
                $this->info("Removed route entry from routes/web.php");
            }
        }
    }

    protected function appendRoutes($model, $table)
    {
        try {
            // Check if route already exists to avoid duplicates
            $webRoutes = File::get(base_path('routes/web.php'));
            $routeString = "Route::resource('{$table}', {$model}Controller::class);";
            if (strpos($webRoutes, $routeString) !== false) {
                $this->info("Route for {$table} already exists, skipping append");
                return true;
            }

            $routeContent = "\nuse App\\Http\\Controllers\\{$model}Controller;\n{$routeString}\n";
            File::append(base_path('routes/web.php'), $routeContent);
            $this->info("Routes appended for {$model}");
            return true;
        } catch (\Exception $e) {
            $this->error('Failed to append routes: ' . $e->getMessage());
            Log::error('Failed to append routes: ' . $e->getMessage(), ['exception' => $e]);
            return false;
        }
    }

    protected function generateMigration($model, $table, $fields, $timestamps)
    {
        try {
            $migrationName = 'create_' . $table . '_table';
            $this->call('make:migration', ['name' => $migrationName]);

            // Find the latest migration file (since timestamp may vary slightly)
            $migrationFiles = glob(database_path('migrations/*_' . $migrationName . '.php'));
            if (empty($migrationFiles)) {
                $this->error('Migration file not created');
                Log::error('Migration file not created for ' . $migrationName);
                return false;
            }
            $migrationPath = end($migrationFiles); // Get the latest file

            if (!File::exists(base_path('stubs/migration.create.stub'))) {
                $this->error('Migration stub not found');
                Log::error('Migration stub not found at stubs/migration.create.stub');
                return false;
            }

            $stub = File::get(base_path('stubs/migration.create.stub'));

            $fieldsContent = '';
            foreach ($fields as $field) {
                $type = $field['type'] ?? 'string';
                $name = $field['name'] ?? null;
                $nullable = $field['nullable'] ? '->nullable()' : '';
                $length = isset($field['length']) ? ", {$field['length']}" : '';
                $precision = isset($field['precision']) ? ", {$field['precision']}, {$field['scale']}" : '';

                if (!$name) {
                    $this->error('Field name missing in schema');
                    Log::error('Field name missing in schema');
                    return false;
                }

                if ($type == 'decimal') {
                    $fieldsContent .= "\$table->$type('$name'$precision)$nullable;\n            ";
                } else {
                    $fieldsContent .= "\$table->$type('$name'$length)$nullable;\n            ";
                }
            }

            if ($timestamps) {
                $fieldsContent .= "\$table->timestamps();\n            ";
            }

            $stub = str_replace(['{{ table }}', '{{ fields }}'], [$table, $fieldsContent], $stub);
            File::put($migrationPath, $stub);
            $this->info("Migration generated for {$table}");
            return true;
        } catch (\Exception $e) {
            $this->error('Failed to generate migration: ' . $e->getMessage());
            Log::error('Failed to generate migration: ' . $e->getMessage(), ['exception' => $e]);
            return false;
        }
    }

    protected function generateModel($model, $fields)
    {
        try {
            $this->call('make:model', ['name' => $model]);

            $modelPath = app_path("Models/{$model}.php");
            if (!File::exists($modelPath)) {
                $this->error("Model file not created at {$modelPath}");
                Log::error("Model file not created at {$modelPath}");
                return false;
            }

            $stub = File::get($modelPath);

            $fillable = collect($fields)
                ->pluck('name')
                ->map(fn($name) => "'$name'")
                ->implode(', ');

            $fillableLine = "    protected \$fillable = [{$fillable}];\n";

            // Inject into the class, after the opening {
            $stub = preg_replace('/(class\s+' . $model . '\s+extends\s+Model\s*\{\n)/', "$1$fillableLine", $stub);

            File::put($modelPath, $stub);
            $this->info("Model generated for {$model}");
            return true;
        } catch (\Exception $e) {
            $this->error('Failed to generate model: ' . $e->getMessage());
            Log::error('Failed to generate model: ' . $e->getMessage(), ['exception' => $e]);
            return false;
        }
    }

    protected function generateController($model)
    {
        try {
            $controllerName = "{$model}Controller";
            $controllerPath = app_path("Http/Controllers/{$controllerName}.php");

            $stubPath = base_path('stubs/controller.stub');
            if (!File::exists($stubPath)) {
                $this->error('Controller stub not found.');
                return false;
            }

            $stub = File::get($stubPath);

            $namespace = 'App\\Http\\Controllers';
            $tablePlural = Str::plural(Str::snake($model));
            $stub = str_replace(
                ['{{ namespace }}', '{{ model }}', '{{ table }}'],
                [$namespace, $model, $tablePlural],
                $stub
            );

            File::put($controllerPath, $stub);

            $this->info("Custom controller generated: {$controllerName}");
            return true;
        } catch (\Exception $e) {
            $this->error('Failed to generate controller: ' . $e->getMessage());
            Log::error('Failed to generate controller: ' . $e->getMessage(), ['exception' => $e]);
            return false;
        }
    }

    protected function generateViews($model, $table, $fields)
    {
        try {
            $viewDir = resource_path("views/" . Str::snake($model));
            File::makeDirectory($viewDir, 0755, true, true);

            // Index View
            $indexStub = $this->getIndexViewStub($model, $table, $fields);
            File::put("{$viewDir}/index.blade.php", $indexStub);

            // Create View
            $createStub = $this->getCreateViewStub($model, $fields);
            File::put("{$viewDir}/create.blade.php", $createStub);

            // Edit View
            $editStub = $this->getEditViewStub($model, $fields);
            File::put("{$viewDir}/edit.blade.php", $editStub);

            // Show View
            $showStub = $this->getShowViewStub($model, $fields);
            File::put("{$viewDir}/show.blade.php", $showStub);

            $this->info("Views generated for {$model}");
            return true;
        } catch (\Exception $e) {
            $this->error('Failed to generate views: ' . $e->getMessage());
            Log::error('Failed to generate views: ' . $e->getMessage(), ['exception' => $e]);
            return false;
        }
    }

    protected function getIndexViewStub($model, $table, $fields)
    {
        $thead = '';
        $tbody = '';
        foreach ($fields as $field) {
            $thead .= "<th>" . ucfirst($field['name']) . "</th>\n            ";
            $tbody .= "<td>{{ \$item->" . $field['name'] . " }}</td>\n                ";
        }

        // Make sure $table is plural (e.g. products)
        $tablePlural = Str::plural($table);

        return <<<EOD
            <!DOCTYPE html>
            <html>
            <head>
                <title>{$model} List</title>
                <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            </head>
            <body>
                <h1>{$model} List</h1>
                <a href="{{ route('{$tablePlural}.create') }}" class="btn btn-primary">Create {$model}</a>
                <table class="table">
                    <thead>
                        <tr>
                            {$thead}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\${$tablePlural} as \$item)
                            <tr>
                                {$tbody}
                                <td>
                                    <a href="{{ route('{$tablePlural}.show', \$item->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('{$tablePlural}.edit', \$item->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('{$tablePlural}.destroy', \$item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </body>
            </html>
            EOD;
    }

    protected function getCreateViewStub($model, $fields)
    {
        $formFields = '';
        foreach ($fields as $field) {
            $name = $field['name'];
            $label = ucfirst($name); // Precompute label text
            $type = $field['type'] == 'decimal' ? 'number' : ($field['type'] == 'text' ? 'textarea' : 'text');

            if ($type == 'textarea') {
                $input = "<textarea name=\"$name\" class=\"form-control\" required></textarea>";
            } else {
                // For number type, adding step only if decimal
                $step = $field['type'] == 'decimal' ? ' step="0.01"' : '';
                $input = "<input type=\"$type\" name=\"$name\" class=\"form-control\"{$step} required>";
            }

            $formFields .= <<<EOD
        <div class="form-group">
            <label for="$name">$label</label>
            $input
        </div>

        EOD;
        }

        // Plural snake case table name for route name
        $table = Str::plural(Str::snake($model));

        return <<<EOD
        <!DOCTYPE html>
        <html>
        <head>
            <title>Create {$model}</title>
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        </head>
        <body>
            <h1>Create {$model}</h1>
            <form action="{{ route('{$table}.store') }}" method="POST">
                @csrf
                $formFields
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </body>
        </html>
        EOD;
    }

    protected function getEditViewStub($model, $fields)
    {
        $table = Str::plural(Str::snake($model));
        $formFields = '';
        foreach ($fields as $field) {
            $name = $field['name'];
            $label = ucfirst($name); // Precompute label text
            $type = $field['type'] == 'decimal' ? 'number' : ($field['type'] == 'text' ? 'textarea' : 'text');
            $input = ($type == 'textarea'
                ? "<textarea name=\"$name\" class=\"form-control\" required>{{ \$item->$name }}</textarea>"
                : "<input type=\"$type\" name=\"$name\" class=\"form-control\" value=\"{{ \$item->$name }}\" step=\"0.01\" required>");
            $formFields .= <<<EOD
        <div class="form-group">
            <label for="$name">$label</label>
            $input
        </div>

        EOD;
        }

        return <<<EOD
        <!DOCTYPE html>
        <html>
        <head>
            <tiWWtle>Edit {$model}</tiWWtle>
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        </head>
        <body>
            <h1>Edit {$model}</h1>
            <form action="{{ route('{$table}.update', \$item->id) }}" method="POST">
                @csrf
                @method('PUT')
                $formFields
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </body>
        </html>
        EOD;
    }

    protected function getShowViewStub($model, $fields)
    {
        $fieldsContent = '';
        foreach ($fields as $field) {
            $name = $field['name'];
            $fieldsContent .= "<p><strong>" . ucfirst($name) . ":</strong> {{ \$item->$name }}</p>\n        ";
        }
        $table = Str::plural(Str::snake($model));

        return <<<EOD
        <!DOCTYPE html>
        <html>
        <head>
            <title>View {$model}</title>
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        </head>
        <body>
            <h1>View {$model}</h1>
            $fieldsContent
            <a href="{{ route('{$table}.index') }}" class="btn btn-primary">Back to List</a>
        </body>
        </html>
        EOD;
    }
}
