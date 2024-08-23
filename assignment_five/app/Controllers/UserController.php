<?php 
namespace App\Controllers;
use App\Classes\User;
use App\Classes\Storage;
use App\Classes\StorageType;
use App\Classes\UserType;
use App\Classes\FinanceManagerDB;
use Config;

class UserController
{
    private User $user;
    private $users;
    private Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->users = $this->storage->load(User::getModelName());
    }
    public function create(User $user, $request)
    {
        $largest_user_id = 0;
        if($this->users){
            $last_user = end($this->users);
            $largest_user_id = $last_user->id;
        }
        $this->user = $user;
        $firstLetters = $this->getFirstLetters($request->name);
        $hashed_password = password_hash(sanitize($request->password), PASSWORD_DEFAULT);
        $this->user->id = $largest_user_id + 1;
        $this->user->name = sanitize($request->name);
        $this->user->email = sanitize($request->email);
        $this->user->password = $hashed_password;
        $this->user->slug = $firstLetters;
        // $this->user->type = UserType::ADMIN;
        $this->user->type = UserType::CUSTOMER;
        $this->users[] = $this->user;
        if(Config::CURRENT_STORAGE == StorageType::DATABASE){
            $fillable = ['name', 'email', 'password', 'slug', 'type'];
            $this->storage->save(User::getModelName(), $this->user, $fillable);
        }else{
            $this->storage->save(User::getModelName(), $this->users);
        }
        if(isset($_SESSION['id'])){
            flash("success", "Customer added successfully.");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        flash("success", "You have successfully registered. Please login to continue.");
        header('Location: login.php');
        exit();
    }
    public function getUser($userInfo)
    {
        $user = "";
        if(Config::CURRENT_STORAGE == StorageType::DATABASE){
            $findBy = "email";
            $user = $this->storage->find(User::getModelName(), $findBy, $userInfo->email);
            
        }else{
            foreach($this->users as $userData)
            {
                if($userData->email == $userInfo->email){
                    $user = $userData;
                    break;
                }
            }
        }
        if($user && password_verify($userInfo->password, $user->password)){
            $_SESSION['id'] = $user->id;
            $_SESSION['name'] = $user->name;
            $_SESSION['email'] = $user->email;
            $_SESSION['type'] = $user->type;
            $_SESSION['slug'] = $user->slug;
            if($user->type === UserType::ADMIN){
                header('Location: '.'admin/customers.php');
            }else {
                header('Location: '.'customer/dashboard.php');
            }
            exit();
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
?>