<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Answer extends Entity
{
    protected $_accessible = [
        'question_id' => true,
        'user_id' => true,
        'body' => true,
        'created' => true,
        'modified' => true,
        'question' => true,
        'user' => true
    ];
}
