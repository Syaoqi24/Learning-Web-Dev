<?php
/**
 * Auth
 *
 * Encapsulates admin session handling. Previously this logic
 * (session_start + isset($_SESSION['admin_logged_in']) check) was
 * copy-pasted at the top of every admin file. Centralizing it here
 * means the login rule only has to be correct in one place.
 */
class Auth
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['admin_logged_in']);
    }

    /**
     * Redirects to the login page and halts execution if no admin
     * session is present. Call this at the top of any protected page.
     */
    public function requireLogin(string $loginUrl = '../login.php'): void
    {
        if (!$this->isLoggedIn()) {
            header('Location: ' . $loginUrl);
            exit;
        }
    }

    public function attempt(string $username, string $password): bool
    {
        // Demo-level credential check. In a production system this
        // would look up a hashed password in the database instead.
        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username']  = $username;
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
    }
}
