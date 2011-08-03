<?php

namespace Qnet\Controller;

    class SessionController {

        function __construct() {
            session_start();
            if (!isset($_SESSION['uid'])) {
                $this->clearUID();
            }
        }

        function isLoggedIn() {
            return $_SESSION['uid'] != -1;
        }


        public function clearUID() {
            $this->setUID(-1);
        }

        public function setUID($uid) {
            $_SESSION['uid'] = $uid;
        }

        function getUID() {
            return getUID();
        }

        function setUsername($username) {
            $_SESSION['username'] = $username;
        }
    }

    function getUID() {
        return $_SESSION['uid'];
    }

    function getUsername() {
        return $_SESSION['username'];
    }

    function setSessionVar($key, $value) {
        $_SESSION[$key] = $value;
    }

    function getSessionVar($key) {
        return $_SESSION[$key];
    }