=== AFL Exporter for Flamingo ===
Contributors: appfromlab
Tags: flamingo
License: GPLv3 or later
Requires at least: 6.0
Tested up to: 6.8
Stable tag: 1.2.0

Provide hooks to extend the Flamingo CSV Exporter class.

== Description ==

AFL Exporter for Flamingo enhances the CSV export functionality of the [Flamingo](https://wordpress.org/plugins/flamingo/) plugin by providing two powerful developer hooks.

No configuration is needed - simply install the plugin and use the filters in your theme or plugin code.

= Key Features =

* `afl_exporter_for_flamingo_inbound_csv_header` filter to customize CSV headers
* `afl_exporter_for_flamingo_inbound_csv_item` filter to modify individual row data
* Seamless integration with the Flamingo plugin
* Developer-friendly hooks with comprehensive parameters

This plugin is particularly useful for developers who need to:

* Add custom columns to Flamingo exports
* Modify existing data formatting in exports
* Remove unnecessary columns from exports
* Add computed or concatenated data to exports

= Integrations =

The following plugins integrates with this plugin:

* [AFL UTM Tracker](https://www.appfromlab.com/product/afl-utm-tracker-plugin/?utm_source=wordpress.org&utm_medium=referral&utm_campaign=plugin_afl_exporter_for_flamingo)

== Installation ==

Upload the plugin to your WordPress site and activate it.

== Changelog ==

= 1.1.7 - 2025-11-24 =

* Added composer.json to zip file.
* Added ABSPATH check in config/app.php
* Added Require Plugins: Flamingo into plugin header.

= 1.1.6 - 2025-11-12 =

* Initial release.

