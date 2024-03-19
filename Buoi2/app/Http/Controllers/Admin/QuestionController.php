<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class QuestionController extends Controller
{
    //
    protected $questionService;
    protected $back_url = "admin/questions/";
    /**
     * Class constructor.
     */
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }
    function index(Request $request)
    {
        $questions = "";
        if ($request->filterTest) {
            // $questions = $this->questionService->filter($request->filterTest);
        } else {
            $questions = $this->questionService->getQuestion();
        }
        return view('Admin.Question.questions_management', compact(['questions']));
    }
    function edit($id)
    {

        $question = $this->questionService->FindQuestionById($id);
        if ($question) {
            return view("Admin.Question.question_form_edit", compact(['question']));
        }
        return redirect(request()->headers->get('referer'));
    }
    function update(QuestionRequest $request, $id)
    {
//        dd(request()->headers->get('referer'));
        $this->questionService->update($request->all(),$id);
        return redirect($request->pagination_state);
    }

    function delete($id)
    {
        $this->questionService->delete($id);
        return redirect()->back();
    }

    function store(QuestionRequest $request)
    {
        // dd($request->all());
        $this->questionService->create($request->all());
        return redirect($this->back_url);
    }

    function create()
    {
        return view("Admin.Question.question_form_create");
    }

    function filterQuestion(Request $request)
    {
        $re = $request->filterTest;
        echo ($re);
    }

    function search(Request $request) {
        $value = $request->search;
        $questions =  $this->questionService->search($value);
        return view('Admin.Question.questions_management', compact(['questions']));

    }
}
