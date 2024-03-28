<?php

namespace App\Services;

use App\Repositories\TestQuestions\TestQuestionsRepository;

class TestQuestionService
{
    protected $TestQuestionsRepo;

    public function __construct(TestQuestionsRepository $testQuestionsRepository)
    {
        $this->TestQuestionsRepo= $testQuestionsRepository;
    }

    function custom_sort($index_start,$index_end,$question_id,$test_id)
    {
        return $this->TestQuestionsRepo->custom_sort($index_start,$index_end,$question_id,$test_id);
    }

}
