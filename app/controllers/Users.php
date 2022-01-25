<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'role' => 'Operator',
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            // Validate username on letters/numbers 
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username'; // works
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers'; // works
            }

            // Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email'; // works
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) { // works
                $data['emailError'] = 'Please enter the correct format';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken';
                }
            }

            // Validate password on length and numeric values
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password';
            } elseif (strlen($data['password']) < 8) {
                $data['passwordError'] = 'Password must be at least 8 characters';
            } else {
                // The preg_match() function returns whether a match was found in a string.
                if (preg_match($passwordValidation, $data['password'])) {
                    $data['passwordError'] = 'Password must have at least one numeric value';
                }
            }

            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Password do not match, please try again';
                }
            }

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user from model function
                if ($this->userModel->register($data)) {
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong');
                }
            }
        }

        $this->view('users/register', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login page',
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => '',
            ];

            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email or username';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format';
            }

            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password';
            }

            // Check if all errors are empty
            if (empty($data['emailError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
            
                // If login success 
                if ($loggedInUser) {
                    // location in function createUserSession
                    $_SESSION['start'] = time();
                    sessionExpired();
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['emailError'] = 'Email or Password is incorrect';
                    $data['passwordError'] = 'Email or Password is incorrect';

                    $this->view('users/login', $data);
                }
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'emailError' => '',
                'passwordError' => '',
            ];
        }

        $this->view('users/login', $data);
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        $_SESSION['role'] = $user->role;
        $_SESSION['success'] = "SELAMAT BEKERJA " . $_SESSION['username'];
        header('location: ' . URLROOT . '/home');
        exit;
    }

    public function index()
    {
        // get all user
        $users = $this->userModel->getAllUser();

        // Assign data to array object data
        $data = [
            'users' => $users
        ];

        $this->view('users/index', $data);
    }

    public function create()
    {
        $data = [
            'username' => '',
            'email' => '',
            'role' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'roleError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                // 'role' => implode(',', $_POST['role']),
                'role' => trim($_POST['role']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'roleError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'message' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            // Validate username on letters/numbers 
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username'; // works
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers'; // works
            }

            // Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email'; // works
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) { // works
                $data['emailError'] = 'Please enter the correct format';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken';
                }
            }

            if (empty($data['role'])) {
                $data['roleError'] = 'Please choose one';
            }

            // Validate password on length and numeric values
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password';
            } elseif (strlen($data['password']) < 8) {
                $data['passwordError'] = 'Password must be at least 8 characters';
            } else {
                // The preg_match() function returns whether a match was found in a string.
                if (preg_match($passwordValidation, $data['password'])) {
                    $data['passwordError'] = 'Password must have at least one numeric value';
                }
            }

            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Password do not match, please try again';
                }
            }

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) 
                && empty($data['roleError']) && empty($data['passwordError']) 
                && empty($data['confirmPasswordError'])) {
                    
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Create user from model function
                if ($this->userModel->createUser($data)) {
                    $_SESSION['success'] = "Data User Berhasil Ditambahkan";
                    header('location: ' . URLROOT . '/users/create');
                } else {
                    die('Something went wrong');
                }
            }
        }

        $this->view('users/create', $data);
    }

    public function show($id)
    {
        $user = $this->userModel->findUserById($id);

        $data = [
            'user' => $user
        ];

        $this->view('/users/show', $data);
    }

    public function edit($id)
    {
        $user = $this->userModel->edit($id);

        $data = [
            'user' => $user
        ];

        $this->view('/users/edit', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->findUserById($id);

        $data = [
            'user' => $user,
            'username' => '',
            'email' => '',
            'role' => '',
            'usernameError' => '',
            'emailError' => '',
            'roleError' => '',

        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'user' => $user,
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                // 'role' => implode(",", $_POST['role']), // convert array to string
                'role' => $_POST['role'],
                'usernameError' => '',
                'emailError' => '',
                'roleError' => ''
            ];
            
            if (empty($data['username'])) {
                $data['usernameError'] = 'Username cannot be empty';
            }

            if (empty($data['email'])) {
                $data['emailError'] = 'Email cannot be empty';
            }

            if (empty($data['role'])) {
                $data['roleError'] = 'Role cannot be empty';
            }

            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['roleError'])) {
                if ($this->userModel->updateUser($data)) {
                    $_SESSION['success'] = 'Data User Berhasil diupdate';
                    header('location: ' . URLROOT . '/users');
                } else {
                    die("Something went wrong, please try again");
                }
            } else {
                $this->view('users/edit', $data);
            }
        }

        $this->view('/users/edit', $data);
    }

    public function delete($id)
    {
        $user = $this->userModel->findUserById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($this->userModel->deleteUser($id)) {
                header('location: ' . URLROOT . '/users');
            } else {
                die('Something went wrong!');
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('location: ' . URLROOT . '/users/login');
    }
}
