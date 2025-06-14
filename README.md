# 🔧 Laravel Custom CRUD Generator
This package provides a powerful custom Artisan command to auto-generate full-featured CRUD (Create, Read, Update, Delete) operations in Laravel using a single JSON schema file, which you need to place in strorage/app/schemas/product.json. It dramatically accelerates development by scaffolding:

## Migration files
1. Eloquent Models with relationships
2. Form Request classes with validations and custom messages
3. Controllers with all methods
4. Blade views (index, create, edit, show)
5. DataTables integration for index views
6. Seeder file for inserted dummy data

## ✨ Key Features

1. 📄 Schema-driven Generation: Define fields, data types, validations, relationships, and more in a JSON schema.

2. 🔄 Auto Overwrite: Automatically deletes and regenerates files if the CRUD module already exists — no need to manually clean up.

3. 🔍 Smart Views: Auto-generates Blade view files (create, edit, show, index) based on field types.

4. 📊 Datatable Integration: Index page comes pre-wired with DataTables for instant sorting, searching, and pagination.

5. 🤝 Relationship Support: Automatically detects and applies model relationships (e.g., belongsTo, hasMany) as defined in the JSON schema.

6. ✅ Validation Ready: Creates Form Request classes with field-level validation rules and custom messages.

7. 📊 Dummy Data: Create a seeder file inserted fake data


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


## Snap-shots
1. [![3j-BHRr2x-Q66-WRxov-J02-Ig-Q.png](https://i.postimg.cc/XqbwXpRt/3j-BHRr2x-Q66-WRxov-J02-Ig-Q.png)](https://postimg.cc/34tycJJZ)

2. [![Ehk8-GXk2-QRCx-E-Fcwo-FIUQ.png](https://i.postimg.cc/mks5RZ8g/Ehk8-GXk2-QRCx-E-Fcwo-FIUQ.png)](https://postimg.cc/ygLPyHMM)

3. [![WW9m3e-FSj-CVSz2-P2-Kd-Aqg.png](https://i.postimg.cc/xdGmh0JR/WW9m3e-FSj-CVSz2-P2-Kd-Aqg.png)](https://postimg.cc/v1BD6wvg)

4. [![g2tg4u-Gf-Qbq61-Ad-Sq-Ejt-Xg.png](https://i.postimg.cc/VkJQK6hx/g2tg4u-Gf-Qbq61-Ad-Sq-Ejt-Xg.png)](https://postimg.cc/ZWzMRT4H)

5. [![6j-W9vsys-SHSQa4q9-Ngksq-Q.png](https://i.postimg.cc/yN9qzGsn/6j-W9vsys-SHSQa4q9-Ngksq-Q.png)](https://postimg.cc/bGzVx3G2)

6. [![OAVq6-F7-GT6-t-Vky-Ckl1ie-A.png](https://i.postimg.cc/wTbnRzB0/OAVq6-F7-GT6-t-Vky-Ckl1ie-A.png)](https://postimg.cc/Whg5xQgk)

7. [![AYdh-K81-R-Onv-W5-A9h-FCAw.png](https://i.postimg.cc/sxg01Hdk/AYdh-K81-R-Onv-W5-A9h-FCAw.png)](https://postimg.cc/BLRCVgvp)

8. [![qv-ACAh-Z3-S6-CS2ib5-MDzk1w.png](https://i.postimg.cc/ZK0MSQL3/qv-ACAh-Z3-S6-CS2ib5-MDzk1w.png)](https://postimg.cc/TpM9jCFY)

9. [![r-O9-Z3j-l-S0298-Yl6h-SBVbw.png](https://i.postimg.cc/7hhmqCSD/r-O9-Z3j-l-S0298-Yl6h-SBVbw.png)](https://postimg.cc/p5NDZL01)

10. [![6-S6-Oh-Xx-BTu-Ka-Xqtg-LZBT8w.png](https://i.postimg.cc/vZfX8wx1/6-S6-Oh-Xx-BTu-Ka-Xqtg-LZBT8w.png)](https://postimg.cc/686CzS0w)

11. [![tl45cee9-Q0qjdy-X-BRPIs-A.png](https://i.postimg.cc/k4XyyV18/tl45cee9-Q0qjdy-X-BRPIs-A.png)](https://postimg.cc/67gRWQN5)
