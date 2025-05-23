<?php
// Heading
$_['heading_title']                = 'Playful Sparkle - Google Product Review Feed';
$_['heading_integrations']         = 'Integrations';
$_['heading_authentication']       = 'Authentication';
$_['heading_getting_started']      = 'Getting Started';
$_['heading_setup']                = 'Setting Up Google Product Review Feed';
$_['heading_troubleshot']          = 'Common Troubleshooting';
$_['heading_faq']                  = 'FAQ';
$_['heading_contact']              = 'Contact Support';

// Text
$_['text_extension']               = 'Extensions';
$_['text_success']                 = 'Success: You have modified Google Product Review Feed feed!';
$_['text_edit']                    = 'Edit Google Product Review Feed';
$_['text_getting_started']         = '<p><strong>Overview:</strong> The Google Product Review Feed extension for OpenCart 3.x enables store owners to export and submit product reviews directly to their Google Merchant Center. This integration allows Google to display your customer-generated reviews alongside your products in Google Shopping and other Google services. The extension also offers optional Opt-in and Badge integrations, which let you collect post-purchase feedback through Google surveys and display your seller rating badge on your storefront.</p><p><strong>Requirements:</strong> OpenCart 3.x+, PHP 7.3 or higher, and access to your <a href="https://merchants.google.com?hl=en" target="_blank" rel="external noopener noreferrer">Google Merchant Center</a> with Product Ratings program enabled.</p>';
$_['text_setup']                   = '<p><strong>Installation and Setup:</strong></p><ul><li><strong>Step 1:</strong> Upload the extension using the OpenCart Extension Installer.</li><li><strong>Step 2:</strong> After installation, go to <strong>Extensions</strong> -&gt; <strong>Modifications</strong> and click the <strong>Refresh</strong> button to update the modification cache.</li><li><strong>Step 3:</strong> Navigate to <strong>Extensions</strong> -&gt; <strong>Feeds</strong>.</li><li><strong>Step 4:</strong> Locate <strong>Playful Sparkle - Google Product Review Feed</strong> in the list and click <strong>Edit</strong>.</li><li><strong>Step 5:</strong> Enter your <strong>Google Merchant Center ID</strong>.</li><li><strong>Step 6:</strong> Enable <strong>Opt-in Integration</strong> to allow Google to display a survey after checkout.</li><li><strong>Step 7:</strong> Enable <strong>Badge Integration</strong> to show the Google Customer Reviews badge on your site.</li><li><strong>Step 8:</strong> Optionally, set a <strong>username</strong> and <strong>password</strong> to protect access to the review feed URL.</li><li><strong>Step 9:</strong> Save your settings.</li></ul>';
$_['text_troubleshot']             = '<ul><li><strong>Feed not displaying:</strong> Ensure the extension is enabled, properly configured, and the feed URL is accessible.</li><li><strong>No reviews appear in the feed:</strong> Confirm that your store has approved product reviews in OpenCart.</li><li><strong>Opt-in or Badge not visible:</strong> Verify that the relevant integration is enabled, your Merchant ID is valid, and the OpenCart modification cache has been refreshed after installation.</li><li><strong>Opt-in or Badge shows 404 error:</strong> Ensure that the extension is installed on a publicly accessible domain with a valid HTTPS certificate. Google services cannot access local, intranet, or non-secure domains.</li><li><strong>Feed access blocked:</strong> If feed protection is enabled, ensure the correct username and password are provided when accessing the feed URL.</li></ul>';
$_['text_faq']                     = '<details><summary>Why is my feed empty?</summary>Make sure your products have approved customer reviews in OpenCart. Only reviews marked as "enabled" are included in the feed.</details><details><summary>Where can I find my Merchant ID?</summary>You can find your Merchant Center ID in the top right corner of your Google Merchant Center account dashboard.</details><details><summary>How do I test the feed URL?</summary>Visit the feed URL in your browser. If feed protection is enabled, use the configured username and password when prompted. You should see an XML file with your product reviews.</details><details><summary>Do I need both Opt-in and Badge Integration?</summary>No, you can enable either or both based on your needs. The Opt-in feature enables post-purchase surveys, while the Badge displays your seller rating on the site.</details>';
$_['text_contact']                 = '<p>For further assistance, please reach out to our support team:</p><ul><li><strong>Contact:</strong> <a href="mailto:%s">%s</a></li><li><strong>Documentation:</strong> <a href="%s" target="_blank" rel="noopener noreferrer">User Documentation</a></li></ul>';

// Tab
$_['tab_general']                  = 'General';
$_['tab_help_and_support']         = 'Help &amp; Support';

// Entry
$_['entry_status']                 = 'Status';
$_['entry_review_feed_url']        = 'Review Feed Url';
$_['entry_login']                  = 'Username';
$_['entry_password']               = 'Password';
$_['entry_active_store']           = 'Active Store';
$_['opt_in_integration']           = 'Opt-in Integration';
$_['badge_integration']            = 'Badge Integration';
$_['entry_merchant_id']            = 'Merchant ID';

// Help
$_['help_copy']                    = 'Copy URL';
$_['help_open']                    = 'Open URL';
$_['help_merchant_id']             = 'Enter your 9-digit Merchant Center ID. You can find this ID in the top right corner of your Google Merchant Center account dashboard.';
$_['help_opt_in_integration']      = 'Enable to let Google present a survey after checkout, allowing customers to rate their experience with your store.';
$_['help_badge_integration']       = 'Enable to show the Google Customer Reviews badge on your site, displaying your average seller rating and confirming your participation in the program.';

// Error
$_['error_permission']             = 'Warning: You do not have permission to modify Google Product Review Feed feed!';
$_['error_store_id']               = 'Warning: Form does not contain store_id!';
$_['error_merchant_id']            = 'Merchant Center ID is required.';
$_['error_merchant_id_invalid']    = 'Invalid Merchant Center ID. It must be a 7 to 10-digit number.';
