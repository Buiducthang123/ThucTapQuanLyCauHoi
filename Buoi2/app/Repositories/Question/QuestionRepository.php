<?php

namespace App\Repositories\Question;

use App\Models\Question;
use App\Repositories\BaseRepository;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    /**
     * Class constructor.
     */
    function getModel()
    {
        return Question::class;
    }

    function getQuestion()
    {
        return $this->model->select("id", "Content", "OptionA", "OptionB", "OptionC", "OptionD", "CorrectOption")->latest()->paginate(5);
    }

    // function filter($id) {
    //     return $this->model->select("id","Content","OptionA","OptionB","OptionC","OptionD","CorrectOption")->where('Test_id',$id)->latest()->paginate(5);
    // }

    function getQuestionNotInTest($test_id)
    {
        $questions_not_in_test = $this->model->whereDoesntHave('tests', function ($query) use ($test_id) {
            $query->where('test_id', $test_id);
        })->get();
        return $questions_not_in_test;
    }

    function getQuestionNotInTestNoPaginate($test_id)
    {
        $questions_not_in_test = $this->model->whereDoesntHave('tests', function ($query) use ($test_id) {
            $query->where('test_id', $test_id);
        })->get();

        return $questions_not_in_test;
    }

//    function search($value) {
//        $result = $this->model->where('Content','like','%'.$value.'%')->paginate(8);
//        return $result;
//    }


}
