<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class VJFNL_CF7_Date_Placeholder_Updater {
    private $plugin_slug;
    private $github_url;
    private $plugin_data;
    private $plugin_file;
    private $github_response;

    public function __construct($plugin_file, $github_url) {
        $this->plugin_file = $plugin_file;
        $this->github_url = $github_url;
        $this->plugin_slug = plugin_basename($plugin_file);
        add_filter('pre_set_site_transient_update_plugins', [$this, 'check_for_update']);
        add_filter('plugins_api', [$this, 'plugin_info'], 10, 3);
    }

    public function get_repository_info() {
        if (!empty($this->github_response)) {
            return $this->github_response;
        }

        $response = wp_remote_get($this->github_url);
        if (is_wp_error($response)) {
            return false;
        }

        $this->github_response = json_decode(wp_remote_retrieve_body($response), true);
        return $this->github_response;
    }

    public function check_for_update($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }

        $repo_info = $this->get_repository_info();
        if (!$repo_info || !isset($repo_info['tag_name'])) {
            return $transient;
        }

        $latest_version = $repo_info['tag_name'];
        $current_version = $this->get_plugin_version();

        if (version_compare($current_version, $latest_version, '<')) {
            $transient->response[$this->plugin_slug] = (object) [
                'slug'        => $this->plugin_slug,
                'new_version' => $latest_version,
                'package'     => $repo_info['assets'][0]['browser_download_url'],
            ];
        }

        return $transient;
    }

    public function plugin_info($false, $action, $args) {
        if ($action !== 'plugin_information' || $args->slug !== $this->plugin_slug) {
            return false;
        }

        $repo_info = $this->get_repository_info();
        if (!$repo_info) {
            return false;
        }

        return (object) [
            'name'           => 'CF7 Date Placeholder Add-on',
            'slug'           => $this->plugin_slug,
            'version'        => $repo_info['tag_name'],
            'author'         => 'vascofmdc',
            'author_profile' => 'https://www.vascofialho.nl',
            'homepage'       => 'https://github.com/vascofialho-nl/vjfnl_cf7-date-placeholder.git',
            'download_link'  => $repo_info['assets'][0]['browser_download_url'],
            'sections'       => [
            'description'    => 'Adds proper placeholder support for date fields in Contact Form 7.',
            ],
        ];
    }

    private function get_plugin_version() {
        if (!$this->plugin_data) {
            $this->plugin_data = get_plugin_data($this->plugin_file);
        }
        return $this->plugin_data['Version'];
    }
}
