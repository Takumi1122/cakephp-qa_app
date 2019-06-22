<?php
namespace App\Controller;
use Cake\Event\Event;

class AnswersController extends AppController
{
    const ANSWER_UPPER_LIMIT = 100;
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->request->allowMethod(['post']);
    }

    public function add()
    {
        $answer = $this->Answers->newEntity($this->request->getData());
        $count = $this->Answers
            ->find()
            ->where(['question_id' => $answer->question_id])
            ->count();
        if ($count >= self::ANSWER_UPPER_LIMIT) {
            $this->Flash->error('回答の上限数に達しました');
            return $this->redirect(['controller' => 'Questions', 'action' => 'view', $answer->question_id]);
        }
        $answer->user_id = $this->Auth->user('id');
        if ($this->Answers->save($answer)) {
            $this->Flash->success('回答を投稿しました');
        } else {
            $this->Flash->error('回答の投稿に失敗しました');
        }
        return $this->redirect(['controller' => 'Questions', 'action' => 'view', $answer->question_id]);
    }
  
    public function delete(int $id)
    {
        $answer = $this->Answers->get($id);
        $questionId = $answer->question_id;
        if ($answer->user_id !== $this->Auth->user('id')) {
            $this->Flash->error('他のユーザーの回答を削除することはできません');
            return $this->redirect(['controller' => 'Questions', 'action' => 'view', $questionId]);
        }
        if ($this->Answers->delete($answer)) {
            $this->Flash->success('回答を削除しました');
        } else {
            $this->Flash->error('回答の削除に失敗しました');
        }
        return $this->redirect(['controller' => 'Questions', 'action' => 'view', $questionId]);
    }
}