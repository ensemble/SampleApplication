Working principles
===
This document describes how this Content Management Framework (CMF) works with a combination of different modules. A kernel with a low level layer and other modules working on top of that provide a generic method to combine several application specific tasks into a complete application.

Requirements
---
* Parse pages tree into route graph
* Parse pages tree into navigation graph
* Have i18n routes (?)
* Have i18n navigation
* i18n must be optional in all components

Design
---
* Basic kernel for non-i18n loading
* i18n module to determine locale and provides helpers
* Kernel-i18n adapter to hook into route graph creation
* Navigation-i18n adapter to hook into navigation graph creation

Open design questions
---
* How to handle pages with no i18n variant with i18n enabled?
  - Page does not exist in locale X but does in Y
  - Page should show locale X even when Y is active
  - Is old method applicable for the new design?
* Search module with search adapters (Lucene, Solr)?
* How do modules inject content into search index?
* Can we handle different content environments?
* How preview content from within a module?
* Should we work with semantic content input instead of visual input?
* How handle ACL for domains? Use ZfcAcl with domain guards?
* How combine ACL with navigation?

Integration questions
---
* Mobile detection with WURFL and view script resolvers
* Image view system with image processor and view helper
* TinyMCE form view helper and javascript library
* Assetic integration

Pattern for Navigation and i18n navigation
---
Add navigation with interfaces for parsers and all reusable code. Supply service
manager factories for every instance. Create i18n navigation module implementing
the same interfaces and overriding the default factories to the i18n variant.

Design by contract! Same holds for page meta data!! Big question: should every
content module use two separate modules, one for normal usage and one for i18n?

How about url structure: mapping of language => locales? And supply locale or 
otherwise language from mapping? In this module page nav and meta data should
be in the same module.

Kernel add-ons:
---
Route-part must be set to absolute, then landings pages can be created. Or add
aliases for pages, having alternative routes for them and a canonical version 
as well.