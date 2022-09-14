<?php
/* in this file we're going to hook into contactform 7
to add a newsletter subscriber through the contact form */


add_action('wpcf7_before_send_mail', 'ams_add_newsletter_subscriber', 10, 3);

/**
 * Hook into the contactform 7 "wpcf7_before_send_mail hook to check
 * if there is a subscribe to newsletter checkbox present so we can add the form's submitter to the newsletter mailing list.
 * We are only using the $submission parameter to get the post_data.
 *
 * @param $contact_form
 * @param $abort
 * @param $submission
 * @return void
 */
function ams_add_newsletter_subscriber($contact_form, &$abort, $submission)
{
    // get the post_data from the $submission parameter
    $posted_data = $submission->get_posted_data();

    // (only for debugging) write the post data to the debug.log
    if (defined('WP_DEBUG')) {
        error_log('======== START DEBUGGING AMS_ADD_NEWSLETTER_SUBSCRIBER FUNCTION ========');
        error_log(print_r($posted_data, true));
    }

    //check if there is a subscribe-to-newsletter key in the posted_data array
    if (array_key_exists('subscribe-to-newsletter', $posted_data)) {
        /* if the subscribe-to-newsletter key exists.
        Then we will assign it to a variable while also casting it to a boolean for checking it */
        $subscribe_value = (bool) $posted_data['subscribe-to-newsletter'];

        if (defined('WP_DEBUG')) {
            error_log('a subscribe to newsletter value is present');
        }

        /* check if the $subscribe_value is indeed casted to a boolean (from $posted_data it should have been returned as 0 or 1)
        and also check if that boolean is set to true (1)
        */
        if (gettype($subscribe_value) === 'boolean' && $subscribe_value === true) {
            // if the boolean was set to true (if the subscribe-to-newsletter checkbox was checked by the form submitter)
            // create an array with the form submitter's email, first name & last name to prepare for adding him/her as a subscriber
            $newSubscriber = [
                'email' => $posted_data['email'],
                'first_name' => $posted_data['first-name'],
                'last_name' => $posted_data['last-name'],
            ];

            // (only for debugging) Write the new $newSubscriber array to the debug.log
            if (defined('WP_DEBUG')) {
                error_log("subscribe to newsletter was checked");
                error_log('====== GO AND ADD THE SUBMITTER TO THE NEWSLETTER LIST IN MAILPOET ======');
                error_log("Get submitter's name and email");
                error_log(print_r($newSubscriber, true));
            }

            // check if the \MailPoet\API\API::class exists because sending newsletters and
            // adding subscribers to the newsletter relies on the Mailpoet plugin
            if (class_exists(\MailPoet\API\API::class)) {
                //create a new Mailpoet API instance to add subscriber to the subscribers in the plugin
                $mailpoet_api = \MailPoet\API\API::MP('v1');
                // get the subscription lists
                $subscription_lists = $mailpoet_api->getLists();

                // take the id of the Newsletter mailing list from the subscriptions list
                $newsletterMailingList = $subscription_lists[0]['id'];

                // start adding a new subscriber to the Newsletter mailing list
                $createdSubscriber = $mailpoet_api->addSubscriber($newSubscriber, [$newsletterMailingList]);

                // (For debugging only) Write all the information related to the creation of a new subscriber to the debug.log
                if (defined('WP_DEBUG')) {
                    error_log("Get the subscription lists");
                    error_log(print_r($subscription_lists, true));
                    error_log('Get the Newsletter mailing list');
                    error_log("Newsletter mailing list is = " . $newsletterMailingList);
                    error_log('===== ADDED A NEW SUBSCRIBER =====');
                    error_log("Subscriber's name: " . $createdSubscriber['first_name']);
                    error_log("Subscriber's last name: " . $createdSubscriber['last_name']);
                    error_log("Subscriber's status: " . $createdSubscriber['status']);
                }
            }
        }
    }
}
