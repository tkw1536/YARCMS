# YARCMS

Yet another really (simple) CMS. 

## Dependencies

* PHP 5.3 or newer
* Apache with mod_rewrite and mod_auth

## How it works

This is a really small CMS. It has no editing interface (yet). 
Pages can currently be written in Markdown or (pure) HTML. 

Whenever a page is requested from the server, the cms will check if: 

* The exact file exists in the data/content directory and it has a congtent type specefied in lib/static. 
* The file plus extension has a renderer in the data/render directory. 

In the first case the file is directly served with the given content type, otherwise it is passed on to the renderer. In case the file is passed onto the renderer, then the goes through the template as well. 

For directory indexes, use the filename index. It will always take precedence. For not found files, use the filename 404. 

### Renderers

#### Standard Ones
	* Markdown (md)
	* HTML (htm) - May only include the <body> content

#### Special ones
	* 301 Redirects (r301): Redirect pages via a 301. The url to redirect to should be put directly inside the file. 
	* 302 Redirects (r302): The same as above, just via a 302. 

### Static File Types
* png
* jpg
* jpg
* html - HTML without headers

### YARCMS Config files

In each content directory, the .yarcms file can be used to customize the menu and further variables. Example: 

```json
{
	"menu": [
		["Menu one", "/"], 
		["Another link", "/de/index"], 
		["An external link", "http://example.com"]
	], 
	"properties": {
		"lang": "en"
	}, 
	"template": "basic", 
	"index": "index.html"
}
```

The properties object will be parsed to the template as the variable $YARCMS_contentProperties. 
The menu will be built automatically. 

The template property determines the template to be used. 

In case a directory does not have this file, the template will check in the parent directory. 

The index property, if set, determines which index file to use. This must be relative to the current .yarcms file. 

## License
(c) Tom Wiesing 2014
Licensed under [Attribution-NonCommercial-ShareAlike 4.0 International](http://creativecommons.org/licenses/by-nc-sa/4.0/)

## Used Libraries

* [PHP Markdown Lib](http://michelf.ca/projects/php-markdown/) Copyright © 2004-2013 Michel Fortin http://michelf.ca/ All rights reserved. - for more license information, see lib/markdown/License.md

* [PHP Simple HTML DOM Parser](http://sourceforge.net/projects/simplehtmldom/) - Licensed under The MIT License, for more license information, see lib/simple_html_dom.php