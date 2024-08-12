<?php 
declare(strict_types = 1);
namespace App\Classes;

use App\Classes\UserType;

class User implements Model
{
    protected array $userData;
    private Storage $storage;
    private $users;
    public static function getModelName(): string
    {
        return 'users';
    }
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->users = $this->storage->load(self::getModelName());
    }
    public function create($user)
    {
        $largest_user_id = 0;
        if($this->users){
            $user_ids = array_column($this->users, 'id');
            $largest_user_id = max($user_ids);
        }
        $firstLetters = $this->getFirstLetters($user->name);
        $hashed_password = password_hash(sanitize($user->password), PASSWORD_DEFAULT);
        $userData['id'] = $largest_user_id + 1;
        $userData['name'] = sanitize($user->name);
        $userData['email'] = sanitize($user->email);
        $userData['password'] = $hashed_password;
        $userData['slug'] = $firstLetters;
        // $userData['type'] = UserType::ADMIN;
        $userData['type'] = UserType::CUSTOMER;
        $this->users[] = $userData;
        $this->storage->save(self::getModelName(), $this->users);
        if(isset($_SESSION['id'])){
            flash("success", "Customer added successfully.");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        flash("success", "You have successfully registered. Please login to continue.");
        header('Location: login.php');
        exit();
    }
    public function getUser($userInfo)
    {
        foreach($this->users as $user)
        {
            if($user['email'] == $userInfo->email && password_verify($userInfo->password, $user['password'])){
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['type'] = $user['type'];
                $_SESSION['slug'] = $user['slug'];
                if($user['type'] === UserType::ADMIN){
                    header('Location: '.'admin/customers.php');
                }else {
                    header('Location: '.'customer/dashboard.php');
                }
                exit();
            }
        }
        return "Email or password incorrect";
    }
    public static function getUsers(){
        return self::$users;
    }
    function getFirstLetters($string) {
        $words = preg_split('/\s+/', $string);
        $firstLetters = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $firstLetters .= $word[0];
            }
        }
        return $firstLetters;
    }
}