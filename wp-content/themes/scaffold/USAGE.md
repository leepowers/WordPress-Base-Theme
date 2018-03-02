# Scaffold Usage

Scaffold base theme to quickly deploy a new WordPress theme.

Please search and replace the following strings after copying to your WordPress development folder:

**Note:** Search and replace should be CASE-sensitive!

* `style.css`
  * Edit the header/preamble
* `constants.php`
  * Set the theme version if needed. Should be the same as in the `style.css` header/preamble.
* Search and replace:
  * The `SCAFFOLD_` prefix with a unique identifier for your theme
  * The `scaffold_` prefix with a unique identifier for your theme
  * The `scaffold-` prefix with a unique identifier for your theme
  * the `"scaffold"` quoted string with a unqiue identifier for your theme
* Replace `screenshot.png` with an actual screenshot


# LaunchCTL (OSX Only)

## Example file: theme.scss.plist

	<plist version="1.0">
	<dict>
	    <key>Label</key>
	    <string>scaffold.scss</string>
	    <key>ProgramArguments</key>
	    <array>
	        <string>/usr/bin/sass</string>
	        <string>/Users/leepowers/Clients/client/wp/wp-content/themes/scaffold/ui/scss/_theme.scss:/Users/leepowers/Clients/client/wp/wp-content/themes/scaffold/ui/css/theme.css</string>
	    </array>
	    <key>WatchPaths</key>
	    <array>
	        <string>/Users/leepowers/Clients/client/wp/wp-content/themes/scaffold/ui/scss/</string>
	    </array>
	</dict>
	</plist>

## Verify

	/usr/bin/sass /Users/leepowers/Clients/client/wp/wp-content/themes/scaffold/ui/scss/_theme.scss:/Users/leepowers/Clients/client/wp/wp-content/themes/scaffold/ui/css/theme.css
	
Double-check the output of `css/theme.css`

## Auto-compile on file save

	launchctl load -w ~/Library/LaunchAgents/scaffold.scss.plist
	

# Cleanup

* Delete this file