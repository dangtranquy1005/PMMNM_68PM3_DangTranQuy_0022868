<?php
    class auth {
        protected $user = array(
            'admin' => '123456',
            'quy' => '123456'
        );
        public function login() {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                if (isset($this->user[$username]) && $this->user[$username] === $password) {
                   $_SESSION ['username'] = $username;
                    header('Location: ' . BASE_URL . '/home/index');
                    exit();
                } else {
                    header('Location: ' . BASE_URL . '/home/login');
                    exit();
                }
            }
        }
    }