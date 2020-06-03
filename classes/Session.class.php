<?php

class Session {
    /**
     * Returns true or false if a session exists
     * @param $name
     * @return bool
     */
    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;
    }

    /**
     * Sets a session
     * @param $name
     * @param $value
     * @return mixed
     */
    public static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

    /**
     * Gets data from the session
     * @param $name
     * @return mixed
     */
    public static function get($name) {
        return $_SESSION[$name];
    }

    /**
     * Deletes a session
     * @param $name
     */
    public static function delete($name) {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Destroys the session
     * @param $name
     */
    public static function destroy($name) {
        if(self::exists($name)) {
            session_destroy();
        }
    }
}