<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\QuestionService;
use App\Services\TestService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $testService;
    protected $questionService;
    /**
     * Class constructor.
     */
    public function __construct(TestService $testService, QuestionService $questionService)
    {
        $this->testService = $testService;
        $this->questionService = $questionService;
    }
    function index()
    {

        $tests = $this->testService->getAllTest();
        return view('Admin.Test.test_management', compact('tests'));
    }
    function show($id)
    {
        $test = $this->testService->find($id);
        $questions = $this->testService->getAllQuestionInTest($id);
        $questionsAll = $this->testService->getQuestionNotInTest($id);
        return view('Admin.Test.show_details', compact(['questions','test','questionsAll']));
    }
    function deleteQuestion($id)
    {
        $this->testService->deleteQuestion($id);
        return redirect()->back();
    }

    function delete($id)
    {
        $this->testService->delete($id);
        return redirect()->back();
    }

    function add_question(Request $request)
    {
        $test_id = $request->id;
        $questions = $this->testService->getQuestionNotInTest($test_id);
        return response()->json(['test_id' => $test_id, 'questions' => $questions]);
    }

    function handleAdd(Request $request)
    {
        $questions_id = $request->questions_id;
        $test_id = $request->test_id;
        $this->testService->addQuestion($test_id,$questions_id);
        $this->show($test_id);
        return redirect()->back();
    }
    function create(Request $request) {
        $id = $this->testService->create($request->all())->id;
        $url = 'tests/show/'.$id;
       return $url;
    }

    function update(Request $request,$id){
        $this->testService->update($request->all(),$id);
        return redirect()->back();
    }

    function quick_add_questions($test_id) {
        $this->testService->quick_add_questions($test_id);
        return redirect()->back();
    }

    function search(Request $request) {
        $value = $request->search;
        $tests =  $this->testService->search($value);
        return view('Admin.Test.test_management', compact('tests'));
    }

    function custom_sort(Request $request)
    {
        $test_id = $request->test_id; // Corrected variable name
        $data = json_decode($request->data);
        $a =$this->testService->custom_sort($test_id,$data);
        return $a;
    }


}
