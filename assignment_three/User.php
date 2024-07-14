<?php 

declare(strict_types = 1);
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
        $hashed_password = password_hash(sanitize($user->password), PASSWORD_DEFAULT);
        $userData['id'] = $largest_user_id + 1;
        $userData['name'] = sanitize($user->name);
        $userData['email'] = sanitize($user->email);
        $userData['password'] = $hashed_password;
        $this->users[] = $userData;
        $this->storage->save(self::getModelName(), $this->users);
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
                header('Location: dashboard.php');
                exit();
            }
        }
        return "Email or password incorrect";
    }
}