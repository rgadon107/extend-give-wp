# Extend GiveWP

## Purpose

This plugin extends the <a href="https://givewp.com">GiveWP donation plugin</a> by: 

(1) setting an option in the WordPress database to store and retrieve the featured image post ID displayed in the Give donation form;

(2) registering custom functions to the GiveWP plugin to render additional labels, content blocks, and a captioned featured image; and 

(3) registering `extend-give-wp` with the Custom module of the `central-hub` must-use plugin to flush the rewrite rules on plugin status change ( e.g. activation, deactivation, uninstall );

This plugin's structure is modeled on the <a href="https://github.com/KnowTheCode/Sandbox-Workspace">`Sandbox-Workspace` plugin,</a> which is also available from the <a href="https://github.com/KnowTheCode">KnowtheCode.io code repository on GitHub.com</a>.

## Application

The plugin is currently in use on the <a href="https://cornerstonechorale.org">Cornerstone Chorale & Brass website.</a>
It's also under version control in the <a href="https://github.com/rgadon107/extend-give-wp">`'extend-give-wp'`</a> repository on 
Github.com.

## Install Dependencies with Composer, the PHP Package Manager

A `composer.json` file is included in the plugin root directory. Composer adds several development dependencies to add the WordPress coding standards to this plugin.  

To activate Composer: 

1) From the Terminal command line, change directories to the `/plugins` directory in your WordPress install.

2) <a href="https://github.com/rgadon107/extend-give-wp">Open the repository on Github.com</a> and either clone the 
repository directly into the `/plugins` directory, or download the plugin as a `*.zip` archive, and upload and activate 
the plugin with the WordPress plugin installer.

3) From the Terminal command line, change directories to `extend-give-wp`.

4) On the command line, type `composer install`. Composer will install all dependencies in the plugin `/vendor` directory, and 
add a `composer.lock` file to lock down the installed packages.  

5) To update Composer packages, change directories to `extend-give-wp`, and type 'composer update' on the command line. 
Composer will check for any package installs, updates, and removals. 
  
## Contributions

All feedback, bug reports, and pull requests are welcome.
