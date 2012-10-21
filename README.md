Ensemble Sample Application
===
Ensemble is a content management framework based on the php Zend Framework 2. The goal is to benefit from the reusable Zend Framework 2 modules combined with a powerful kernel to hook modules onto a specific page in the sitemap of the website.

Introduction
---
Ensemble is a cmf, making it easy to create cms based applications. The cmf is a selection of various modules to handle page building, route parsing, navigation building and it provides an admin interface to manage the various content modules. Ensemble is called a cmf and not cms (content management system) as it does not provide the usual content management system tools, but rather helps with a low level handling of pages inside the application.

The fundament of ensemble is a page model, where every page is filled with content from one module. Pages are hierarchical stored in a database and processed into a route stack by the kernel. Meta data from pages is processed into a navigation tree for menus, breadcrumbs and so on. Ensemble has a repository on Gihub with documentation. At this moment, the best place to start is the [wiki](https://github.com/ensemble/Documentation/wiki).

Installation
---
Ensemble works with Composer as dependency manager. To install this ensemble example application, clone this repository to a local machine and install dependencies with composer. Load the SQL statements into your database and modify the configuration files in `config/autoload` to your needs. This should be enough to get the system up and running.

This comes down to the following steps:

1. Grab the sample application and install the dependencies

```
cd path/to/projects
git clone git://github.com/ensemble/SampleApplication.git; cd SampleApplication
curl -s http://getcomposer.org/installer | php
php composer.phar install
```

2. Configure the sample application
Look into the `config/autoload` directory and modify the files in this directory to your needs.
Do not forget to copy `doctrine_orm.local.php.dist` to `doctrine_orm.local.php` and change its contents to fit your needs.

3. Import the database schemas
Grab the contents of `data/database/schema.sql` and `data/database/fixtures.sql` and execute those statements for the database you want to use

```sql
mysql -u your_username -p your_database < fixtures.sql
mysql -u your_username -p your_database < schema.sql
```

4. Making it accessible
Don't forget to create a (virtual) host for this application ;-)

Core modules
---
The cmf is built modular and to start the application, there is a minumum list of modules required to run the application:

1. EnsembleKernel: supplies the page model and parsers for routes [work in progress, usable]
2. EnsembleUtils: basic utility classes from CMF usage [work in progress, usable]
3. EnsembleAdmin: bare admin control panel [work in progress, little usable]
4. EnsembleAcl: access control list based on ZfcAcl [not started yet]

Additionally you might be interested in:

1. EnsembleI18n: provides i18n for ensemble including locale detection and translation helpers [not started yet]

In development
---
The system is in heavy development and no guarantee is given the applications are stable.
Please test it and report to me if you have any findings: jurian@soflomo.com.
You can find me often on Freenode IRC in the channel of the Zend Framework 2 development: #zftalk.2
