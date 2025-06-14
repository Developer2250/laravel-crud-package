# 🔧 Laravel Custom CRUD Generator
This package provides a powerful custom Artisan command to auto-generate full-featured CRUD (Create, Read, Update, Delete) operations in Laravel using a single JSON schema file, which you need to place in strorage/app/schemas/product.json. It dramatically accelerates development by scaffolding:

## Migration files
1. Eloquent Models with relationships
2. Form Request classes with validations and custom messages
3. Controllers with all methods
4. Blade views (index, create, edit, show)
5. DataTables integration for index views

## ✨ Key Features

1. 📄 Schema-driven Generation: Define fields, data types, validations, relationships, and more in a JSON schema.

2. 🔄 Auto Overwrite: Automatically deletes and regenerates files if the CRUD module already exists — no need to manually clean up.

3. 🔍 Smart Views: Auto-generates Blade view files (create, edit, show, index) based on field types.

4. 📊 Datatable Integration: Index page comes pre-wired with DataTables for instant sorting, searching, and pagination.

5. 🤝 Relationship Support: Automatically detects and applies model relationships (e.g., belongsTo, hasMany) as defined in the JSON schema.

6. ✅ Validation Ready: Creates Form Request classes with field-level validation rules and custom messages.


## 🚀 How to Use
Place your schema JSON file in a designated directory (e.g., storage/crud-schemas/author.json).

Run the custom command:

```bash
php artisan make:crud product
```

## The command will

1. Create migration, model, controller, views, and request files.

2. Automatically wire up relationships and validation rules.

3. Scaffold views using proper input fields based on data types.

4. Set up a DataTable in the index view.

## 📌 Notes
The command overwrites all related files (migration, model, controller, views, requests) every time it is run.

Ideal for rapid prototyping and admin panel generation.

You can customize view templates or extend logic if needed.

sample json file located in public/schemas folder

## ✅To-Do / Improvements
Add support for soft deletes and timestamps toggling

Customize base templates via stubs

Export functionality for DataTables
