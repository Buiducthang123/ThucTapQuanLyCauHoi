<?php

namespace App\Services;

use App\Repositories\Question\QuestionRepository;
use App\Repositories\Test\TestRepository;

class QuestionService
{

    protected $questionRepo;
    protected $testRepo;
    /**
     * Class constructor.
     */
    public function __construct(QuestionRepository $questionRepository,TestRepository $testRepository)
    {
        $this->questionRepo = $questionRepository;
        $this->testRepo = $testRepository;
    }
    function getQuestion()
    {
        $questions = $this->questionRepo->getQuestion();
        return $questions;
    }

    function FindQuestionById($id) {
        return $this->questionRepo->findById($id);
    }

    function update($data=[],$id) {
        $this->questionRepo->update($data,$id);
    }

    function delete($id) {
        $this->questionRepo->delete($id);
    }

    function create($data=[]) {
        $this->questionRepo->create($data);
    }

    function getAllTest() {
        return $this->testRepo->getAll();
    }
    // function filter($id) {
    //     $result =  $this->questionRepo->filter($id);
    //     return $result;
    // }

    function search($value) {
        return $this->questionRepo->search('Content',$value);
    }
}
