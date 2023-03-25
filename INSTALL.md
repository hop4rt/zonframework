INSTALLATION
------------

Zon Framework requires no special installation steps. Simply download the framework,
extract it to the folder you would like to keep it in, and add the library directory
to your PHP `include_path`. To use components in the extras library, add the extras/library
directory to your PHP `include_path`, as well.
If you would like to use `Zend_Tool`, simply add `bin/zf.bat` (for Windows) or
`bin/zf.sh` (for anything else) to your system executable path.

SYSTEM REQUIREMENTS
-------------------

Zon Framework requires PHP 5.3 or later. Please see the system requirements
appendix for more detailed information:

- http://framework.zend.com/manual/en/requirements.html

DEVELOPMENT VERSIONS
--------------------

If you would like to preview enhancements or bug fixes that have not yet been
released, you can obtain the current development version of ZOne Framework using one
of the following methods:

* Using a git client. Zend Framework is open source software, and
  the git repository used for its development is publicly available. Consider
  using git to get Zend Framework if you already use git for your application
  development, want to contribute back to the framework, or need to upgrade your
  framework version very often.

  Checking out a working copy is necessary if you would like to directly contribute
  to Zon Framework; a working copy can be updated any time with `git fetch &&
  git rebase origin/master`.

  A git submodules definition is highly convenient for developers already using
  git to manage their application working copies.

  The URL for the Zon Framework git repository is:

  - https://github.com/hop4rt/zonframewor

  For more information about git, please see the official website:

  - http://git-scm.com

CONFIGURING THE INCLUDE PATH
----------------------------

Once you have a copy of Zend Framework available, your application will need to
access the framework classes. Though there are several ways to achieve this, your
PHP `include_path` needs to contain the path to the Zend Framework classes under the
`/library` directory in this distribution. You can find out more about the PHP
`include_path` configuration directive here:

- http://www.php.net/manual/en/ini.core.php#ini.include-path

Instructions on how to change PHP configuration directives can be found here:

- http://www.php.net/manual/en/configuration.changes.php

GETTING STARTED
---------------

A great place to get up-to-speed quickly is the Zend Framework QuickStart:

- http://framework.zend.com/docs/quickstart

The QuickStart covers some of the most commonly used components of ZF. Since
Zend Framework is designed with a use-at-will architecture and components are
loosely coupled, you can select and use only those components that are needed for
your project.
