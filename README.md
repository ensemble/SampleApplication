SlmCmf
===
SlmCmf is a content management framework based on the php Zend Framework 2. It is its goal to have the easy usage of Zend Framework 2 modules combined with a powerful kernel to hook the modules onto a specific page in the sitemap of the website.

Introduction
---
SlmCmf is called a cmf and not cms (content management system) as it does not provide the usual content management system tools, but rather a low level handling of pages of the application.

The fundament of SlmCmf is a page model, where every page is filled with content from one module. Pages are hierarchical stored in a database and processed into a route stack by the kernel. Meta data from pages are processed by the navigation module into a navigation tree for menus, breadcrumbs and so on.

Modules provide route definitions for their own module. For example you have a blog under `developers/blog` and the blog module provides a child route to a specific article with the route `article/:id/:slug`. The kernel parses this to a route `developers/blog/article/:id/:slug`.

Installation
---
The CMF works with Composer as dependency manager. To install this SlmCmf example application, clone this repository to a local machine and install dependencies with composer. Load the SQL statements into your database and modify the configuration files in `config/autoload` to your needs.

Core modules
---
The CMF is built modular and to start the application, there is a minumum list of modules required to run the application:

1. SlmCmfKernel: supplies the page model and parsers for routes
2. SlmCmfNavigation: add metadata to the page model and parse this to navigation structure
3. SlmCmfUtils: basic utility classes from CMF usage
4. SlmCmfAcl: access control list based on ZfcAcl
5. SlmCmfAdmin: bare admin control panel

Additionally you might be interested in:

1. SlmCmfI18n: provides i18n for SlmCmf including locale detection and translation helpers
2. SlmCmfNavigationI18n: extends the navigation module to use i18n

In development
---
The system is in heavy development and no guarantee is given the applications are stable. Please test it and report to me if you have any findings: jurian@soflomo.com.
