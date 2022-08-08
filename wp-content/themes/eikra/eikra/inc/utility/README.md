# Envato License
This is the theme licensing code for Envato. We use this code so that no one can use our theme from the null site. By this code, we protected Pre Packaged plugin and also demo import installation. 
 
## Implementation 
- **Step 1:** Copy paste lc-helper.php and lc-utility.php files anywhere in themes (If possible paste complex folder in theme, so that no one can easily remove)
- **Step 2:** Include those file in your themes  
- **Step 3:** Change the 'theme_name_text' with find and replace, in lc-helper and lc-utility files
- **Step 4:** Add span in class-tgm-pluign-activatio.php line number 2292. Like:
```
$string = '<span></span>'.esc_html__( 'Pre-Packaged', 'text_domain' ); 
```

## Implementation Checking
- Now you will see a menu  **Theme License** under **Appreance** Menu
- Without activated license, you can't install and active pre-package plugin
- You can't install demo import

## Implementation demo of Roofix theme
- In inc/helper-traits folder There are two files
- lc-helper
- lc-utility
- Included the files in inc/includes.php 
- require_once ROOFIX_THEME_INC_DIR . 'helper-traits/lc-helper.php';
- require_once ROOFIX_THEME_INC_DIR . 'helper-traits/lc-utility.php';
