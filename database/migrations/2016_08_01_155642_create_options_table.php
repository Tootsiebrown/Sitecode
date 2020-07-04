<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('option_key', 50)->nullable();
            $table->text('option_value')->nullable();
            //$table->timestamps();
        });

        $this->seed();
    }

    protected function seed()
    {
        \Illuminate\Support\Facades\DB::table('options')
            ->insert([
                ['option_key' => 'date_format', 'option_value' => 'F j, Y'],
                ['option_key' => 'time_format', 'option_value' => 'g:i A'],
                ['option_key' => 'logo_settings', 'option_value' => 'show_site_name'],
                ['option_key' => 'verification_email_after_registration', 'option_value' => '1'],
                ['option_key' => 'site_name', 'option_value' => 'LaraBid'],
                ['option_key' => 'site_title', 'option_value' => 'The Best Auction Website'],
                ['option_key' => 'email_address', 'option_value' => 'admin@demo.com'],
                ['option_key' => 'default_timezone', 'option_value' => 'America/New_York'],
                ['option_key' => 'date_format_custom', 'option_value' => 'F j, Y'],
                ['option_key' => 'time_format_custom', 'option_value' => 'g:i A'],
                ['option_key' => 'currency_sign', 'option_value' => 'USD'],
                ['option_key' => 'ads_moderation', 'option_value' => 'need_moderation'],
                ['option_key' => 'ads_price_plan', 'option_value' => 'regular_ads_free_premium_paid'],
                ['option_key' => 'enable_related_ads', 'option_value' => '1'],
                ['option_key' => 'regular_ads_price', 'option_value' => NULL],
                ['option_key' => 'premium_ads_price', 'option_value' => '5'],
                ['option_key' => 'urgent_ads_price', 'option_value' => '8'],
                ['option_key' => 'number_of_urgent_ads_in_home', 'option_value' => '5'],
                ['option_key' => 'number_of_premium_ads_in_home', 'option_value' => '5'],
                ['option_key' => 'number_of_free_ads_in_home', 'option_value' => '12'],
                ['option_key' => 'ads_per_page', 'option_value' => '20'],
                ['option_key' => 'number_of_premium_ads_in_listing', 'option_value' => NULL],
                ['option_key' => 'premium_ads_max_impressions', 'option_value' => NULL],
                ['option_key' => 'number_of_last_days_premium_ads', 'option_value' => NULL],
                ['option_key' => 'enable_paypal', 'option_value' => '1'],
                ['option_key' => 'enable_stripe', 'option_value' => '1'],
                ['option_key' => 'enable_paypal_sandbox', 'option_value' => '1'],
                ['option_key' => 'paypal_receiver_email', 'option_value' => 'mhstestpaypal-faciliator@gmail.com'],
                ['option_key' => 'stripe_test_secret_key', 'option_value' => 'sk_test_tJeAdA1KbhiYV8I8bfPmJcOL'],
                ['option_key' => 'stripe_test_publishable_key', 'option_value' => 'pk_test_P3TFmKrvT7l29Zpyy1f4pwk8'],
                ['option_key' => 'stripe_live_secret_key', 'option_value' => NULL],
                ['option_key' => 'stripe_live_publishable_key', 'option_value' => NULL],
                ['option_key' => 'default_storage', 'option_value' => 'public'],
                ['option_key' => 'amazon_key', 'option_value' => NULL],
                ['option_key' => 'amazon_secret', 'option_value' => NULL],
                ['option_key' => 'amazon_region', 'option_value' => NULL],
                ['option_key' => 'bucket', 'option_value' => NULL],
                ['option_key' => 'stripe_test_mode', 'option_value' => '1'],
                ['option_key' => 'currency_position', 'option_value' => 'left'],
                ['option_key' => 'google_map_api_key', 'option_value' => 'AIzaSyCQuDQmtiHkS7CcriyEiYXWja3ODrG4vFI'],
                ['option_key' => 'enable_google_maps', 'option_value' => '1'],
                ['option_key' => 'enable_comments', 'option_value' => '1'],
                ['option_key' => 'enable_fb_comments', 'option_value' => '1'],
                ['option_key' => 'facebook_url', 'option_value' => '#'],
                ['option_key' => 'twitter_url', 'option_value' => '#'],
                ['option_key' => 'linked_in_url', 'option_value' => '#'],
                ['option_key' => 'dribble_url', 'option_value' => '#'],
                ['option_key' => 'google_plus_url', 'option_value' => '#'],
                ['option_key' => 'youtube_url', 'option_value' => '#'],
                ['option_key' => 'countries_usage', 'option_value' => 'all_countries'],
                ['option_key' => 'additional_css', 'option_value' => NULL],
                ['option_key' => 'additional_js', 'option_value' => NULL],
                ['option_key' => 'footer_company_name', 'option_value' => 'oClassified'],
                ['option_key' => 'footer_copyright_text', 'option_value' => '[copyright_sign] Copyright [year], [site_name] All rights reserved'],
                ['option_key' => 'enable_social_login', 'option_value' => '1'],
                ['option_key' => 'enable_facebook_login', 'option_value' => '1'],
                ['option_key' => 'fb_app_id', 'option_value' => '807346162754117'],
                ['option_key' => 'fb_app_secret', 'option_value' => '6b93030d5c4f2715aa9d02be93256fbd'],
                ['option_key' => 'google_client_id', 'option_value' => '62019812075-0sp3u7h854tp7aknl1m8q7ens0pm4im0.apps.googleusercontent.com'],
                ['option_key' => 'google_client_secret', 'option_value' => 'xK8SHn-ds4GJtVSL95ExTzw3'],
                ['option_key' => 'enable_google_login', 'option_value' => '1'],
                ['option_key' => 'enable_twitter_login', 'option_value' => '1'],
                ['option_key' => 'twitter_consumer_key', 'option_value' => 'cOiq6W7Ot8HQH1GAfGd2pGZy8'],
                ['option_key' => 'twitter_client_secret', 'option_value' => 'XItViEyIRVMrhexIqg9S9DSZQdsOHGDvQush3BAgqdm5M1ivHx'],
                ['option_key' => 'twitter_consumer_secret', 'option_value' => 'XItViEyIRVMrhexIqg9S9DSZQdsOHGDvQush3BAgqdm5M1ivHx'],
                ['option_key' => 'logo', 'option_value' => '1515332341evaib-logo.png'],
                ['option_key' => 'logo_storage', 'option_value' => 'public'],
                ['option_key' => 'enable_language_switcher', 'option_value' => '1'],
                ['option_key' => 'recaptcha_site_key', 'option_value' => '6LfSyyMUAAAAAPA6f8iIP7WB51Bw3xKipBHlvdz_'],
                ['option_key' => 'recaptcha_secret_key', 'option_value' => '6LfSyyMUAAAAAHeMy-PyshlTJcbE3sbsddOGw6gk'],
                ['option_key' => 'enable_recaptcha_login', 'option_value' => '0'],
                ['option_key' => 'enable_recaptcha_registration', 'option_value' => '0'],
                ['option_key' => 'enable_recaptcha_post_ad', 'option_value' => '0'],
                ['option_key' => 'enable_monetize', 'option_value' => '0'],
                ['option_key' => 'monetize_code_above_categories', 'option_value' => '<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n<!-- TestCSP -->\r\n<ins class=\"adsbygoogle\"\r\n     style=\"display:block\"\r\n     data-ad-client=\"ca-pub-8618780985613063\"\r\n     data-ad-slot=\"5484345690\"\r\n     data-ad-format=\"auto\"></ins>\r\n<script>\r\n    (adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>'],
                ['option_key' => 'monetize_code_below_categories', 'option_value' => '<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n<!-- TestCSP -->\r\n<ins class=\"adsbygoogle\"\r\n     style=\"display:block\"\r\n     data-ad-client=\"ca-pub-8618780985613063\"\r\n     data-ad-slot=\"5484345690\"\r\n     data-ad-format=\"auto\"></ins>\r\n<script>\r\n    (adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>'],
                ['option_key' => 'monetize_code_below_premium_ads', 'option_value' => '<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n<!-- TestCSP -->\r\n<ins class=\"adsbygoogle\"\r\n     style=\"display:block\"\r\n     data-ad-client=\"ca-pub-8618780985613063\"\r\n     data-ad-slot=\"5484345690\"\r\n     data-ad-format=\"auto\"></ins>\r\n<script>\r\n    (adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>'],
                ['option_key' => 'monetize_code_below_regular_ads', 'option_value' => '<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n<!-- TestCSP -->\r\n<ins class=\"adsbygoogle\"\r\n     style=\"display:block\"\r\n     data-ad-client=\"ca-pub-8618780985613063\"\r\n     data-ad-slot=\"5484345690\"\r\n     data-ad-format=\"auto\"></ins>\r\n<script>\r\n    (adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>'],
                ['option_key' => 'monetize_code_listing_sidebar_top', 'option_value' => 'monetize_code_listing_sidebar_top'],
                ['option_key' => 'monetize_code_listing_sidebar_bottom', 'option_value' => 'monetize_code_listing_sidebar_bottom'],
                ['option_key' => 'monetize_code_listing_above_premium_ads', 'option_value' => 'monetize_code_listing_above_premium_ads'],
                ['option_key' => 'monetize_code_listing_above_regular_ads', 'option_value' => 'monetize_code_listing_above_regular_ads'],
                ['option_key' => 'monetize_code_listing_below_regular_ads', 'option_value' => 'monetize_code_listing_below_regular_ads'],
                ['option_key' => 'monetize_code_below_ad_title', 'option_value' => 'monetize_code_below_ad_title'],
                ['option_key' => 'monetize_code_below_ad_image', 'option_value' => 'monetize_code_below_ad_image'],
                ['option_key' => 'monetize_code_below_ad_description', 'option_value' => 'monetize_code_below_ad_description'],
                ['option_key' => 'monetize_code_above_general_info', 'option_value' => 'monetize_code_above_general_info'],
                ['option_key' => 'monetize_code_below_general_info', 'option_value' => 'monetize_code_below_general_info'],
                ['option_key' => 'monetize_code_above_seller_info', 'option_value' => 'monetize_code_above_seller_info'],
                ['option_key' => 'monetize_code_below_seller_info', 'option_value' => 'monetize_code_below_seller_info'],
                ['option_key' => 'google_map_embedded_code', 'option_value' => '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2867.3732463742!2d-73.98604123059546!3d40.75928510320901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855b8fb3083%3A0xa0f9aef176042a5c!2sTheater+District%2C+New+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbd!4v1515333304629\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>'],
                ['option_key' => 'footer_address', 'option_value' => 'Times Square, Manhattan, New York, NY, USA'],
                ['option_key' => 'site_phone_number', 'option_value' => '+10099234534'],
                     ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('options');
    }
}
