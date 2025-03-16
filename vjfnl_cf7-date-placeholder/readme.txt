=== CF7 Date Placeholder Add-on ===
Contributors: vascofmdc  
Tags: contact form 7, cf7, placeholder, date field  
Requires at least: 5.2  
Tested up to: 6.4  
Stable tag: 1.0.5  
Requires PHP: 7.0  
License: GPL-2.0+  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

A Contact Form 7 add-on that enables placeholder support for date fields, improving user experience.

== Description ==

**CF7 Date Placeholder Add-on** is an enhancement for Contact Form 7 that allows date fields to display placeholder text like regular text inputs.  

### Key Features:
- Enables proper placeholder support for `<input type="date">` fields in CF7.
- Uses JavaScript to simulate placeholder behavior in browsers that don’t support it.
- **Automatic deactivation** if Contact Form 7 is missing, preventing errors.
- Displays a clear admin notice when deactivated due to a missing CF7.
- **GitHub update support:** This plugin now updates automatically via GitHub.

This plugin will **automatically deactivate** itself if Contact Form 7 is **not installed or deactivated**. A clear admin notice will be shown to inform the user.  

== Installation ==

1. Ensure [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) is installed and activated.
2. Upload the plugin folder to `/wp-content/plugins/`.
3. Activate the plugin through the ‘Plugins’ menu in WordPress.
4. Add placeholder attributes to your CF7 date fields as usual.

== Plugin Structure ==

cf7-date-placeholder/
│── assets/
│   ├── js/
│   │   ├── cf7-date-placeholder.js
│── includes/
│   ├── updater.php
│── cf7-date-placeholder.php
│── readme.txt 

== Changelog ==

= 1.0.5 =
- added plugin url to metadaata

= 1.0.4 =  
- **Added GitHub update support** for automatic plugin updates.  
- Plugin now checks GitHub for new versions and provides an update notification.  

= 1.0.3 =  
- Improved plugin behavior: **automatic deactivation** when CF7 is missing.  
- Added an admin notice explaining why the plugin is deactivated.  
- Optimized script loading to prevent unnecessary execution.  

= 1.0.2 =  
- Fixed a bug where the plugin would show a fatal error if CF7 was missing.  

= 1.0.1 =  
- Minor improvements and script optimizations.  

= 1.0.0 =  
- Initial release.  

== Frequently Asked Questions ==  

= What happens if I deactivate Contact Form 7? =  
This plugin will **automatically deactivate** itself and show a notice explaining why.  

= Will this work with all themes? =  
Yes, as long as your theme properly supports CF7 and placeholders.  

= Does this affect non-date fields in CF7? =  
No, it only applies to `<input type="date">` fields.  

== GitHub Update Support ==  

This plugin now supports **automatic updates via GitHub**.  
- It checks GitHub releases for new versions.  
- If an update is found, WordPress will notify you.  
- You can update it just like any other WordPress plugin.  

**GitHub Repository:**  
[https://github.com/yourusername/cf7-date-placeholder](https://github.com/yourusername/cf7-date-placeholder)  

== Support ==  
For support, visit [https://www.vascofialho.nl](https://www.vascofialho.nl).  
