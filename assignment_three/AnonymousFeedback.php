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
        $feedbackData['key'] = $feedback->key;
        $feedbackData['message'] = $feedback->message;
        $this->feedbacks[] = $feedbackData;
        $this->storage->save(self::getModelName(), $this->feedbacks);
        header('Location: feedback-success.php');
        exit();
    }
    public function getFeedbacks($userId)
    {
        $feedBacksById=[];
        foreach($this->feedbacks as $feedback)
        {
            if($feedback['key'] == $userId){
                $feedBacksById[] = $feedback;
            }
        }
        return $feedBacksById;
    }
}