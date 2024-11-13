<?php
$current_db_version = get_option('wps_db_version');
if (intval(WPS_DB_VERSION) > intval($current_db_version)) {
    wps_db_upgrade();
}

function wps_db_upgrade()
{
    global $wpdb;

    //create wps_user_visits tbl
    $wps_user_visits_tbl_prefix = $wpdb->prefix . 'wps_user_visits';
    $wps_user_visits_tbl = "CREATE TABLE IF NOT EXISTS `".$wps_user_visits_tbl_prefix."` (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
   ip BIGINT UNIQUE NOT NULL,
  date DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


    //create wps_visits
    $wps_visits_tbl_prefix = $wpdb->prefix . 'wps_visits';
    $wps_visits_tbl = "CREATE TABLE IF NOT EXISTS `".$wps_visits_tbl_prefix."` (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
   total_visits BIGINT NOT NULL,
   unique_visits BIGINT NOT NULL,
  date DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($wps_user_visits_tbl);
    dbDelta($wps_visits_tbl);

    update_option('wps_db_version', WPS_DB_VERSION);
}
