<?php
namespace App\Services;

use App\Repositories\Question\QuestionRepository;
use App\Repositories\Test\TestRepository;
use GuzzleHttp\Psr7\Request;
use Faker\Factory as Facker;
class TestService{
    protected $testRepo;
    protected $questionRepo;

    // protected $questionRepo;
     /**
      * Class constructor.
      */
     public function __construct(TestRepository $testRepository, QuestionRepository $questionRepository)
     {
        $this->testRepo =  $testRepository;
        $this->questionRepo= $questionRepository;
     }

     function getAllQuestionInTest($id) {

            return $this->testRepo->show($id);
     }

     function getAllTest() {
        return $this->testRepo->getAll();
     }

     function deleteQuestion($question_id) {
        $question = $this->questionRepo->findById($question_id);
        $question->tests()->detach();
     }

     function delete($id) {
        $this->testRepo->delete($id);
     }

     function getQuestionNotInTest($test_id){
        return $this->questionRepo->getQuestionNotInTest($test_id);
     }
     function getQuestionNotInTestNoPaginate($test_id) {
        return $this->questionRepo->getQuestionNotInTestNoPaginate($test_id);
     }
     function addQuestion($test_id,$questions_id) {
        $test = $this->testRepo->findById($test_id);
        $test->questions()->attach($questions_id,['created_at' => now(), 'updated_at' => now()]);
     }

     function create($data = []) {
        $r = $this->testRepo->create($data);
        return $r;
     }

     function update($data = [],$id) {
        $this->testRepo->update($data,$id);
     }

     function quick_add_questions($test_id) {
        $test = $this->testRepo->findById($test_id);
        $questions = $this->getQuestionNotInTestNoPaginate($test_id);
        $questions_id = [];
        foreach ($questions as  $value) {
            array_push($questions_id,$value->id);
        }
        if(count($questions_id)<=40){
            $test->questions()->attach($questions_id,['created_at' => now(), 'updated_at' => now()]);
        }
        else{

            $a =($this->getRandomUniqueElements($questions_id,40));
            $test->questions()->attach($a,['created_at' => now(), 'updated_at' => now()]);
        }

     }
     function getRandomUniqueElements($array, $count) {
        $keys = array_keys($array); // Lấy danh sách các chỉ mục của mảng gốc
        $total = count($keys); // Số lượng phần tử trong mảng gốc
        $result = [];

        // Đảm bảo không lấy quá số lượng phần tử trong mảng gốc
        $count = min($count, $total);

        // Lặp qua số lần cần chọn phần tử
        for ($i = 0; $i < $count; $i++) {
            // Chọn ngẫu nhiên một chỉ mục từ mảng các chỉ mục
            $randomKey = array_rand($keys);

            // Thêm phần tử tương ứng vào mảng kết quả
            $result[] = $array[$keys[$randomKey]];

            // Xóa phần tử đã chọn khỏi mảng các chỉ mục để không chọn lại
            unset($keys[$randomKey]);
        }

        return $result;
    }
    function search($value) {
        return $this->testRepo->search('name',$value);
    }

    function find($id)
    {
        $result = $this->testRepo->findById($id);
        return $result;
    }

    function custom_sort($test_id,$data =[])
    {

        $a = $this->testRepo->custom_sort($test_id,$data);
        return $a;
    }

}
