<?php
	/**
	 * Make elgg invite only.
         * 
         * @see Readme.md for details
	 *
	 * @licence GNU Public License version 2
         * @link https://github.com/mapkyca/elgg-invite-only
	 * @link http://www.marcus-povey.co.uk
	 * @author Marcus Povey <marcus@marcus-povey.co.uk>
	 */
	
	
        elgg_register_event_handler('init','system', function() {
            
            elgg_register_page_handler('register', function($pages) {
                
                // Get invite code details
                $friend_guid = (int) get_input('friend_guid', 0);
                $friend = get_entity($friend_guid);
                $invitecode = get_input('invitecode');
                
                // Validate
                if (($friend) && ($invitecode) && ($invitecode == generate_invite_code($friend->username)))
                {
                    require_once(dirname(dirname(dirname(__FILE__))) . '/pages/account/register.php');
                }
                else {
                    elgg_unregister_action('register');
                    require_once(dirname(__FILE__) . '/pages/denied.php');
                }
                
                return true;
            });
            
        });
