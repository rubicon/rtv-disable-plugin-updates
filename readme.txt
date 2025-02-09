=== Rubicon: Ignore Plugin Updates ===
Contributors: Dax Davis
Donate link: https://rubicontv.com
Tags: plugins, updates, management, admin, settings, ignore, update
Requires at least: 6.0
Tested up to: 6.6.2
Stable tag: 1.0.7
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Rubicon: Ignore Plugin Updates is a comprehensive WordPress plugin that empowers site administrators to selectively ignore automatic updates for specific plugins. By enabling update ignore status on chosen plugins, this plugin helps prevent unwanted updates that might disrupt custom configurations or cause compatibility issues. It features a modern, responsive settings page with Tailwind CSS–styled toggle switches, persistent settings storage, JSON import/export capabilities, and robust logging integration with popular activity log plugins.

== Features ==
* Adds a new admin menu item under Plugins for managing ignored plugin updates.
* Displays all installed plugins in a table with Tailwind CSS–styled toggle switches.
* Provides a unified "Toggle All" switch to select or clear all toggles at once.
* Offers filtering options for All, Ignored, and Not Ignored (Active Updates) plugins.
* Persists user selections across sessions using the WordPress options API.
* Allows import/export of ignored plugin settings in JSON format.
* Includes a Reset to Defaults button with a confirmation prompt.
* Logs changes to ignored plugins when supported logging plugins are active.

== Installation ==
1. Upload the plugin files to the `/wp-content/plugins/rubicon-ignore-plugin-updates` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Navigate to Plugins > Ignored Plugins to manage your plugin update ignore settings.

== Frequently Asked Questions ==
= Q: How do I import/export my ignored plugin settings? =
A: Navigate to the settings page and use the import/export functionality to manage your settings in JSON format.

== Upgrade Notice ==
Upgrade to 1.0.7 for updated internal naming, improved PHPDoc documentation, and enhanced logging and settings functionality.

== Changelog ==
= 1.0.7 =
* Updated internal naming from RTV to Rubicon throughout the code.
* Updated plugin header with improved PHPDoc documentation and new version information.
* Changed all function names, text domains, and option names to use "rubicon" instead of "rtv".
* Adjusted uninstall hook and Settings link filter to reflect new naming conventions.
* Updated version number in all files to 1.0.7.

= 1.0.6 =
* Added import/export functionality for ignored plugin settings.
* Enhanced toggle switches and filters for plugin management.
* Improved settings page layout with a sticky header.
* Replaced checkboxes with toggle switches.
* Comprehensive inline documentation added.
* Fixed plugin description rendering issues.
* Updated top bar to be sticky with proper links and buttons.
* Added functional toggles replacing checkboxes.
* Enhanced table layout to match WordPress plugin page style.
* Added filters for All, Ignored, and Not Ignored plugins.

= 1.0.5 =
* Updated header UI.
* Added floating Save Changes and Reset to Defaults buttons.
* Replaced Select All and Clear All functionality with a unified toggle switch.
* Enhanced table sorting by enabled first and then alphabetically by plugin title.
* Improved accessibility and styling for toggle switches.

= 1.0.4 =
* Replaced checkboxes with modern toggle switches for better UX.
* Adjusted the settings page layout for improved alignment and readability.
* Updated CSS for toggle styles and table layout enhancements.

= 1.0.3 =
* Added feature to dynamically handle updates for a new list of plugins.
* Enhanced the UI of the settings page for better clarity and responsiveness.

= 1.0.2 =
* Improved settings page with a clean, accessible table for managing plugins.
* Added a styled header and introduction paragraph to the settings page.
* Updated version to 1.0.2.

= 1.0.1 =
* Improved compliance with WordPress coding standards.
* Added a "Settings" link to the plugins page.
* Updated all naming to use the Rubicon branding.
* Improved plugin metadata and documentation for compliance.
* Minor accessibility improvements for the settings page.

= 1.0.0 =
* Initial release.
