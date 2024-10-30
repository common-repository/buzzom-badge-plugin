<?php
/*
Plugin Name: Buzzom Badge
Plugin URI: http://buzzom.com/Badges.aspx
Description: This plugin let's you display a small badge which shows your Buzzom profile.
Author: Arun Pattnaik (for InRev Systems)
Version: 2
Author URI: http://arunpattnaik.com/
*/
function widget_mywidget_init() {

    // Check to see required Widget API functions are defined...
    if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
        return; // ...and if not, exit gracefully from the script.

    // This function prints the sidebar widget--the cool stuff!
    function widget_mywidget($args) {

        // $args is an array of strings which help your widget
        // conform to the active theme: before_widget, before_title,
        // after_widget, and after_title are the array keys.
        extract($args);
        
	
		// Collect our widget's options, or define their defaults.
        $options = ('widget_mywidget');
		

        $title = empty($options['title']) ? 'Mget_optiony Buzzom' : $options['title'];
		$pretext = empty($options['pretext']) ? '<script type="text/javascript" src="http://test1.in-rev.com/badges/BadgeJS.aspx?u=' : $options['pretext'];
        $text = empty($options['text']) ? 'arunpattnaik' : $options['text'];
		$posttext = empty($options['posttext']) ? '"></script>' : $options['posttext'];

         // It's important to use the $before_widget, $before_title,
         // $after_title and $after_widget variables in your output.
        echo $before_widget;
        echo $before_title . $title . $after_title;
		echo $pretext . $text . $posttext . "</script>";	
        echo $after_widget;
    }

    // This is the function that outputs the form to let users edit
    // the widget's title and so on. It's an optional feature, but
    // we'll use it because we can!
    function widget_mywidget_control() {

	
        // Collect our widget's options.
        $options = get_option('My Buzzom');
        
        // This is for handing the control form submission.
        if ( $_POST['mywidget-submit'] ) {
            // Clean up control form submission options
            $newoptions['title'] = strip_tags(stripslashes($_POST['mywidget-title']));
            $newoptions['text'] = strip_tags(stripslashes($_POST['mywidget-text']));
			$newoptions['posttext'] = strip_tags(stripslashes($_POST['mywidget-posttext']));

        }

        // If original widget options do not match control form
        // submission options, update them.
        if ( $options != $newoptions ) {
            $options = $newoptions;
            update_option('widget_mywidget', $options);
        }

        // Format options as valid HTML. Hey, why not.
        $title = htmlspecialchars($options['title'], ENT_QUOTES);
        $text = htmlspecialchars($options['text'], ENT_QUOTES);
        //$posttext = htmlspecialchars($options['posttext'], ENT_QUOTES);
// The HTML below is the control form for editing options.
?>
        <div>
        <label for="mywidget-text" style="line-height:35px;display:block;">Twitter Username: <input type="text" id="mywidget-text" name="mywidget-text" value="<?php echo $text ?>" /></label>
        <label for="mywidget-posttext">Normal<input name='mywidget-posttext' type='radio' value='">'/></label>&nbsp;<label for="mywidget-posttext">Mini<input name='mywidget-posttext' type='radio' value='&m=true">' /></label>
        <input type="hidden" name="mywidget-submit" id="mywidget-submit" value="1" />
        </div>
    <?php
    // end of widget_mywidget_control()
    }

    // This registers the widget. About time.
    register_sidebar_widget('My Buzzom', 'widget_mywidget');

    // This registers the (optional!) widget control form.
    register_widget_control('My Buzzom', 'widget_mywidget_control');
}

// Delays plugin execution until Dynamic Sidebar has loaded first.
add_action('plugins_loaded', 'widget_mywidget_init');
?>