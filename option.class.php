<?php
class CDN_Rewrites_Option
{
	var $config;
	
	function CDN_Rewrites_Option()
	{
		$this->__construct();
	}

	function __construct()
	{
		global $cdn_rewrites_config;
		$this->config = $cdn_rewrites_config;
	}
	
	function get()
	{
        static $options;
        
        if (!isset($options))
        {
		    $options = get_option($this->config['plugin_name']);
		    if (empty($options))
		    {
			    $options = $this->config['default_options'];
		    }
        }
		
		return $options;
	}
    
    function panel()
    {
        $options = $this->get();
        
        return sprintf('<div id="otherDiv">
            <form action="index.php" method="post" class="cdnr_ajax" autocomplete="off" ftype="options">
                <ul>
                    <li><input type="checkbox" %s name="debug" id="debug" /><label for="debug">Debug mode (only list down to-be-rewritten URL\'s, not applying them)</label></li>
                </ul>
                <h3>Support this plugin (Thanks!)</h3>
                <ul>
                    <li><input type="checkbox" %s name="powered" id="powered"><label for="powered">Show &quot;Powered by <a href="http://www.phoenixheart.net/wp-plugins/cdn-rewrites/">CDN Rewrites</a>&quot; message on page footer</label> 
                </ul>
                <h3>Other support options</h3>
                <ul id="otherSupport">
                    <li>Blog or <a href="http://twitter.com/home/?status=I+am+using+this+awesome+WordPress+CDN+Rewrites+plugin+by+%%40Phoenixheart+http%%3A%%2F%%2Fbit.ly%%2101Vzv" target="_blank">Tweet about it</a>.
                    You can also <a href="http://twitter.com/Phoenixheart" target="_blank">follow me on Twitter</a></li>
					<li><a href="http://buysellads.com/buy/detail/2211">Buy an ad slot</a> from <a href="http://www.phoenixheart.net">my site</a></li>
                    <li>Give this plugin a good rating on <a href="http://wordpress.org/extend/plugins/free-cdn/" target="_blank">WordPress Codex</a></li>
                    <li>Check out <a href="http://www.phoenixheart.net/wp-plugins/" target="_blank">my other plugins</a></li>
                    <li><a href="http://feeds.feedburner.com/phoenixheart" target="_blank">Subscribe</a> to my RSS</li>
                    <li>Send me at phoenixheart (Gmail) an email telling that you like my plugin ;)</li>
                </ul>
                 <input type="hidden" name="_nonce" value="%s" />
                 <input type="hidden" name="cdnr_action" value="save_options" />
                 <p class="submit">
                    <input class="button-primary" type="submit" value="Save Options" name="submit"/>
                 </p>
            </form>
        </div>', 
        $options['debug'] ? 'checked="checked"' : '',
        $options['powered'] ? 'checked="checked"' : '',
        wp_create_nonce($this->config['plugin_name']));
    }
	
	function reset()
	{
	}
	
	function save()
	{
        $options = array(
            'debug' => isset($_POST['debug']),
            'powered' => isset($_POST['powered']),
        );
        
        get_option($this->config['plugin_name']) === false ? 
            add_option($this->config['plugin_name'], $options) : 
            update_option($this->config['plugin_name'], $options);
        
        echo '<p>Options saved</p>';
	}
}