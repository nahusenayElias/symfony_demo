### Symfony demoapp project 

- The project is a `'CRUD app project'`, aimed at refreshing symfony skills during 2025 winter break. Some of the crucial steps are briefly mentioned in this documentation for future reference or any one bothered to have a look. 


**Project Set Up**


```bash
symfony new demoapp --webapp
cd demoapp
```
**Start/stop server**

```bash
symfony server:start
```

```bash
symfony server:stop
```

**Configure database**

update the db credentials at `'.env'` file.

**Clear Cache**

```bash
php bin/console cache:clear
```

**Create entity**

Then we create entity:

```bash
symfony console make:entity [e.g Product]
```

**Run Migration**

- Create migration

```bash
symfony console make:migration
```
- Execute migration

```bash
symfony console doctrine:migrations:migrate
```

**CRUD controllers**

```bash
symfony console make:crud Product
```

**Load fixtures**

- Installed the fixtures bundle:

```bash
composer require --dev orm-fixtures
```

- Created fixtures for `'Product'` and `'Category'`:

```bash
symfony console make:fixture ProductFixture
symfony console make:fixture CategoryFixture
```

- Loaded the fixtures:

```bash
symfony console doctrine:fixtures:load
```

## It is good idea at this point to clear cache and restart the server.

## CRUD interfaces are accessed:

* Product CRUD:

- List products: http://127.0.0.1:8000/product/

- Create a new product: http://127.0.0.1:8000/product/new

- Edit a product: http://127.0.0.1:8000/product/{id}/edit

- Delete a product: Click the "Delete" button on the product list or edit page.

* Category CRUD:

- List categories: http://127.0.0.1:8000/category/

- Create a new category: http://127.0.0.1:8000/category/new

- Edit a category: http://127.0.0.1:8000/category/{id}/edit

- Delete a category: Click the "Delete" button on the category list or edit page.


## To sum up, in this documentation most of the commands used were listed already but here are the brief list of them below:

### Commands Used 

 | **Step**                     | **Command**                                                                 |
|-------------------------------|-----------------------------------------------------------------------------|
| Create Symfony project        | `symfony new demoapp`                                                      |
| Configure SQLite              | Update `.env` with `DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"` |
| Create `Product` entity       | `symfony console make:entity Product`                                      |
| Create `Category` entity      | `symfony console make:entity Category`                                     |
| Generate migration            | `symfony console make:migration`                                           |
| Run migration                | `symfony console doctrine:migrations:migrate`                              |
| Generate CRUD for `Product`   | `symfony console make:crud Product`                                        |
| Generate CRUD for `Category`  | `symfony console make:crud Category`                                       |
| Install fixtures bundle       | `composer require --dev orm-fixtures`                                      |
| Create `ProductFixture`       | `symfony console make:fixture ProductFixture`                              |
| Create `CategoryFixture`      | `symfony console make:fixture CategoryFixture`                             |
| Load fixtures                | `symfony console doctrine:fixtures:load`                                   |
| Start Symfony server          | `symfony server:start`                                                     |


--------------------------------------------------------------------------------------
### Notes on fixing accidental git commit of dependencies & security vulnerablities

**Step 1**
- remove committed files one by one:
```bash
git rm --cached .env.test  
```
`'Or'` remove the committed files by using:

```bash
git rm -r --cached . 
```

**step 2**

- Adding files to git ignore

```bash
echo "config/">> .gitignore
```

```bash
echo ".env">> .gitignore
```
```bash
echo ".env.dev">> .gitignore
```

**step 3**

- Then git commit & push