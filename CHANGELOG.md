## 1.0.3

- Added `/tests/` folder in plugin root to add unit and WordPress integration tests with PHPUnit.
- Added `phpunit.xml.dist` files for unit and integration tests to their respective directories in the `/tests/phpunit/` folder.
- Validated that the Composer scripts for `composer test-unit`, `composer test-integration`, and `composer run-tests` each work as intended.
- Updates the project `.gitignore` file to ignore the `composer.lock` file. This prevents dev-dependency conflicts in TravisCI between PHP v5.6 and v7.4.
- Removed `.prettyci.composer.json` file for continuous integration with PHP Coding Standing. PrettyCI is no longer active and will discontinue in December 2020.
- Added and updated `.travis.yml` configuration file to run TravisCI on all pushed branches and pushed pull requests. 
- Added bash script in `/bin/install-wp-tests.sh` to load various dependencies when running TravisCI ( e.g. WordPress, WP test suite, and MySQL database ) .
- Uptick plugin version number to 1.0.3 in plugin header docblock. 

## 1.0.2

- Remove `/assets/` directory from plugin. 
- Add `composer.json` and `composer.lock` files to install and run the <a href="https://packagist.org/packages/wp-coding-standards/wpcs">`wp-coding-standards/wpcs` 
package</a> as a development dependency.
- Add `/vendor` directory to store development dependencies installed by Composer. 
- Add ruleset for PHP and WordPress coding standards ( see: `/phpcs.xml.dist` ). 
- Fix all WP and PHP coding standard violations. 
- Add configuration for <a href="https://prettyci.com/">PrettyCI</a>, a continuous integration platform as a service (Paas) to run PHP and WordPress code sniffs on each pull request.
- Add `.gitattributes` file to exclude development directories and files when this plugin is released to production, and called as a dependency in other repositories.
- Add `.editorconfig` file to provide a coding style configuration for different editors and IDEs. 
- Update plugin header in `/bootstrap.php` to include required minimum WP and PHP versions, and update plugin to v1.0.2.   
- Update plugin README.md file. 

## 1.0.1

- Register the plugin with the Custom module in the `central-hub` plugin to flush the rewrite rules on plugin status change (activation, deactivation, uninstall).
- Update plugin README.md file. 

## 1.0.0

Initial release.
