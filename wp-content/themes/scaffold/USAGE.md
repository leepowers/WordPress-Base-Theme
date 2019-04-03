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
  * The `"scaffold"` quoted string with a unqiue identifier for your theme
  * The `Scaffold` title with site name / title
* Replace `screenshot.png` with an actual screenshot


# LaunchCTL (OSX Only)

## Example file: theme.scss.plist

	<plist version="1.0">
	<dict>
	    <key>Label</key>
	    <string>scaffold.scss</string>
	    <key>ProgramArguments</key>
	    <array>
	        <string>/Applications/dart-sass/sass</string>
	        <string>/Users/leepowers/work/client/wp/wp-content/themes/scaffold/ui/scss/_theme.scss:/Users/leepowers/work/client/wp/wp-content/themes/scaffold/ui/css/theme.css</string>
	    </array>
	    <key>WatchPaths</key>
	    <array>
	        <string>/Users/leepowers/work/client/wp/wp-content/themes/scaffold/ui/scss/</string>
	    </array>
	</dict>
	</plist>

## Verify scaffold

	sass /Users/leepowers/work/snippets/wp/base/theme/wp-content/themes/scaffold/ui/scss/_theme.scss:/Users/leepowers/work/snippets/wp/base/theme/wp-content/themes/scaffold/ui/css/theme.css

## Verify in theme

	sass /Users/leepowers/work/client/wp/wp-content/themes/scaffold/ui/scss/_theme.scss:/Users/leepowers/work/client/wp/wp-content/themes/scaffold/ui/css/theme.css

Double-check the output of `ui/css/theme.css`

## Auto-compile on file save

	launchctl load -w ~/Library/LaunchAgents/scaffold.scss.plist

## Grid

Same workflow for customizing the grid located at `ui/scss/grid/bootstrap-grid.scss`

Variables for grid located at `ui/scss/grid/_variables.scss` - search for `@grid-custom` comments to find column number and gutter widths.

	sass /Users/leepowers/work/snippets/wp/base/theme/wp-content/themes/scaffold/ui/scss/grid/bootstrap-grid.scss:/Users/leepowers/work/snippets/wp/base/theme/wp-content/themes/scaffold/ui/css/grid.css


# Cleanup

* Delete this file