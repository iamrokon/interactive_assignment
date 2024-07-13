<?php 

declare(strict_types = 1);

class User implements Model
{
    // protected $id;
    // protected $name;
    // protected $email;
    // protected $password;
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
        // $fillable = [''];
        $largest_user_id = 0;
        if($this->users){
            $user_ids = array_column($this->users, 'id');
            $largest_user_id = max($user_ids);
        }
        $hashed_password = password_hash($user->password, PASSWORD_DEFAULT);
        $userData['id'] = $largest_user_id + 1;
        $userData['name'] = $user->name;
        $userData['email'] = $user->email;
        $userData['password'] = $hashed_password;
        $this->users[] = $userData;
        // return $userData;
        // var_dump($user);
        $this->storage->save(self::getModelName(), $this->users);
        header('Location: login.php');
    }
    // public function save()
    // {
    //     $this->storage->save(self::getModelName(), $this->users);
    // }
    public function getUser($userInfo)
    {
        // var_dump($userInfo);
        foreach($this->users as $user)
        {
            if($user['email'] == $userInfo->email && password_verify($userInfo->password, $user['password'])){
                // return $user;
                // var_dump($user);
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                // var_dump($_SESSION['id']);
                header('Location: dashboard.php');
            }
        }
        return "Email or password incorrect";
    }
}