<?php
/**
 * Assembles and outputs the registration page.
 *
 * Since 1.8, registration can be disabled via administration.  If this is
 * the case, calls to this page will forward to the network front page.
 *
 * If the user is logged in, this page will forward to the network
 * front page.
 *
 * @package Elgg.Core
 * @subpackage Registration
 */

// check new registration allowed
if (elgg_get_config('allow_registration') == false) {
	register_error(elgg_echo('registerdisabled'));
	forward();
}

$friend_guid = (int) get_input('friend_guid', 0);
$invitecode = get_input('invitecode');

// only logged out people need to register
if (elgg_is_logged_in()) {
	forward();
}
$title = elgg_echo("elgg-invite-only:register", array(elgg_get_config('site')->name));

$content = elgg_view_title($title);

$content .= elgg_view('inviteonly/register');

$body = elgg_view_layout("one_column", array('content' => $content));

echo elgg_view_page($title, $body);
