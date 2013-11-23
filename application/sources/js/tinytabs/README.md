TinyTabs
========

Super small jQuery tabs plugin
========

TinyTabs is a small and easy to use jQuery plugin for creating vertical tabs (although you could easily change the CSS to turn the tabs into horizontal ones). It allows you to create inline tabs or ajax tabs and includes a nice fadeIn transition option.



Basic Usage:
========

Default:

$('#tinytabs').tinytabs();

Ajax:

$('#tinytabs').tinytabs({type: 'ajax', ajaxdiv: 'window', transition: 'fade'});  

Options:
========

type: 'inline', // options: inline, ajax

ajaxdiv: 'window', // only define in case of ajax

transition: 'none', // options: none, fade

tabclass: 'tinytabs', // change to your liking

contentclass: 'tinycontent' // change to your liking

Created By:
========

Gerben Schmidt, http://www.zomp.nl
