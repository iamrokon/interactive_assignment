<?php 

declare(strict_types = 1);

class AnonymousFeedback implements Model
{
    protected array $feedbackData;
    private Storage $storage;
    private $feedbacks;
    public static function getModelName(): string
    {
        return 'feedbacks';
    }
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->feedbacks = $this->storage->load(self::getModelName());
    }
    public function create($feedback)
    {
        // $newUrl = "feedback.php?key=".$feedback->key;
        $feedbackData['key'] = $feedback->key;
        $feedbackData['message'] = $feedback->message;
        $this->feedbacks[] = $feedbackData;
        $this->storage->save(self::getModelName(), $this->feedbacks);
        // $_SESSION['flash_data'] = "Your feedback send successfully!";
        
        // header('Location: '.$newUrl);
        header('Location: feedback-success.php');
        exit();
    }
    public function getFeedbacks($userId)
    {
        // var_dump($this->feedbacks);
        $feedBacksById=[];
        foreach($this->feedbacks as $feedback)
        {
            if($feedback['key'] == $userId){
                // return $user;
                // var_dump($user);
                $feedBacksById[] = $feedback;
                
            }
        }
        // var_dump($feedBacksById);
        return $feedBacksById;
    }
}