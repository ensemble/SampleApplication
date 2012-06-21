SlmCmf
===
SlmCmf is a content management framework based on the php Zend Framework 2. It is its goal to have the easy usage of Zend Framework 2 modules combined with a powerful kernel to hook the modules onto a specific page in the sitemap of the website.

Introduction
---
SlmCmf is a Content Management System to provide easy hooks for a module to fit into a Zend Framework 2 based application. The CMF is a selection of various modules to handle page building, route parsing, navigation building and provides an admin interface to manage the modules. SlmCmf is called a CMF and not CMF (content management system) as it does not provide the usual content management system tools, but rather a low level handling of pages inside the application.

The fundament of SlmCmf is a page model, where every page is filled with content from one module. Pages are hierarchical stored in a database and processed into a route stack by the kernel. Meta data from pages is processed into a navigation tree for menus, breadcrumbs and so on. Inside the `docs` directory of this repository several files explain more about the fundaments of SlmCmf.

Installation
---
The CMF works with Composer as dependency manager. To install this SlmCmf example application, clone this repository to a local machine and install dependencies with composer. Load the SQL statements into your database and modify the configuration files in `config/autoload` to your needs. This should be enough to get the system up and running.

Core modules
---
The CMF is built modular and to start the application, there is a minumum list of modules required to run the application:

1. SlmCmfKernel: supplies the page model and parsers for routes [work in progress, usable]
2. SlmCmfUtils: basic utility classes from CMF usage [work in progress, usable]
3. SlmCmfAdmin: bare admin control panel [work in progress, not usable]
4. SlmCmfAcl: access control list based on ZfcAcl [not started yet]

Additionally you might be interested in:

1. SlmCmfI18n: provides i18n for SlmCmf including locale detection and translation helpers

In development
---
The system is in heavy development and no guarantee is given the applications are stable. Please test it and report to me if you have any findings: jurian@soflomo.com. You can find me often on Freenode IRC in the channel of the Zend Framework 2 development: #zftalk.2