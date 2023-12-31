<?php

namespace Duplicator\MuPlugin;

use Exception;

/**
 * Mu Plugin bootstrap
 *
 * Beware, this class is used in the mu-plugin, this means that at this stage wordpress is not fully initialized and Duplicator has not been loaded yet.
 * Therefore not all functions and classes are available at this stage.
 * Adding new logic and therefore classes must be done very carefully.
 */
class MuBootstrap
{
    const EXCEPTION_CODE_SECURITY_ISSUE = -2;
    /**
     * Init Mu plugin
     *
     * @return void
     */
    public static function init()
    {
        if (!isset($_REQUEST['dup_mu_action'])) {
            return;
        }
        self::setDefines();
        self::execInstaller();
    }

    /**
     * Check if a installer must be executed
     *
     * @return void
     */
    protected static function execInstaller()
    {
        if (self::sanitizeRequestVal('dup_mu_action') !== 'installer') {
            return;
        }
        try {
            if (self::sanitizeRequestVal('brchk') !== self::getBridgeHash()) {
                throw new Exception('Security issue', self::EXCEPTION_CODE_SECURITY_ISSUE);
            }

            $instPath     = self::sanitizeRequestVal('inst_path');
            $instMainPath = self::sanitizeRequestVal('inst_main_path');

            if (strlen($instMainPath) > 0 && file_exists($instMainPath)) {
                if (strpos($instMainPath, DUPLICATOR_MU_PATH_IMPORTS) !== 0) {
                    throw new Exception('Security issue', self::EXCEPTION_CODE_SECURITY_ISSUE);
                }
                $fileName = basename(dirname($instMainPath));
                if (preg_match(DUPLICATOR_MU_DUP_INSTALLER_FOLDER_REGEX_PATTERN, $fileName) !== 1) {
                    throw new Exception('Security issue', self::EXCEPTION_CODE_SECURITY_ISSUE);
                }
                include $instMainPath;
            } elseif (strlen($instPath) > 0 && file_exists($instPath)) {
                if (strpos($instPath, DUPLICATOR_MU_PATH_IMPORTS) !== 0) {
                    throw new Exception('Security issue', self::EXCEPTION_CODE_SECURITY_ISSUE);
                }
                $fileName = basename($instPath);
                if (preg_match(DUPLICATOR_MU_INSTALLER_REGEX_PATTERN, $fileName) !== 1) {
                    throw new Exception('Security issue', self::EXCEPTION_CODE_SECURITY_ISSUE);
                }
                include $instPath;
            } else {
                throw new Exception('Security issue', self::EXCEPTION_CODE_SECURITY_ISSUE);
            }
        } catch (Exception $e) {
            error_log('Duplicator mu plugin secority error line ' . $e->getLine());
            echo '<p>Security issue, restart the installer.</p>';
        } finally {
            die;
        }
    }

    /**
     * Get HASH to check
     *
     * @return string
     */
    public static function getBridgeHash()
    {
        $key  = 'qLtOw7WpuK';
        $key .= (defined('DB_NAME') ? DB_NAME : '');
        $key .= (defined('DB_USER') ? DB_USER : '');
        $key .= (defined('DB_PASSWORD') ? DB_PASSWORD : '');
        $key .= (defined('DB_HOST') ? DB_HOST : '');
        $key .= '89aEO7NVO0';
        return md5($key);
    }

    /**
     * Set duplicator must use plugin defines
     *
     * @return void
     */
    protected static function setDefines()
    {
        // The defines set must match the defines in the plugin's define.php file
        $contentPath = untrailingslashit(wp_normalize_path(realpath(WP_CONTENT_DIR)));

        define("DUPLICATOR_MU_SSDIR_NAME", 'backups-dup-pro');
        define("DUPLICATOR_MU_SSDIR_PATH", $contentPath . '/' . DUPLICATOR_MU_SSDIR_NAME);
        define("DUPLICATOR_MU_IMPORTS_DIR_NAME", 'imports');
        define("DUPLICATOR_MU_PATH_IMPORTS", DUPLICATOR_MU_SSDIR_PATH . '/' . DUPLICATOR_MU_IMPORTS_DIR_NAME);

        // MATCH installer.php installer-backup.php and full installer with hash
        define('DUPLICATOR_MU_INSTALLER_REGEX_PATTERN', '/^(?:.+_[a-z0-9]{7,}_[0-9]{14}_)?installer(?:-backup)?\.php$/');
        // MATCH dup-installer and dup-installer-[HASH]
        define('DUPLICATOR_MU_DUP_INSTALLER_FOLDER_REGEX_PATTERN', '/^dup-installer(?:-[a-z0-9]{7,}-[0-9]{8})?$/');
    }

    /**
     * Return sanitized value
     *
     * @param string $key     ky value
     * @param string $default Default value if key don't exists
     *
     * @return string
     */
    protected static function sanitizeRequestVal($key, $default = '')
    {
        if (!isset($_REQUEST[$key])) {
            return $default;
        }

        return filter_var(
            $_REQUEST[$key],
            FILTER_SANITIZE_SPECIAL_CHARS,
            [
                'flags' => FILTER_FLAG_STRIP_LOW
            ]
        );
    }
}
