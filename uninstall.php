<?php
// If uninstall is not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

//remove tables from database
global $wpdb;
$wps_user_visits_tbl_prefix = $wpdb->prefix . 'wps_user_visits';
$wps_visits_tbl_prefix = $wpdb->prefix . 'wps_visits';
$wpdb->query("DROP TABLE IF EXISTS {$wps_user_visits_tbl_prefix}");
$wpdb->query("DROP TABLE IF EXISTS {$wps_visits_tbl_prefix}");

//remove options from database
delete_option('wps_db_version');
delete_option('wps_admin_mobile');
delete_option('wps_admin_email');
delete_option('wps_daily_report_email');
delete_option('wps_daily_report_sms');
delete_option('wps_enable');
// delete_user_meta('wps_enable','views');
