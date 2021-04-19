<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('id', 'desc')->get();
        // dd($questions);
        return view('admin.questions.index')->with('title_page', 'Câu hỏi thường gặp')
                                            ->with('create_page', 'question.create')
                                            ->with('list_page', 'question.index')
                                            ->with('questions', $questions);
    }

    public function create()
    {
        return view('admin.questions.create')->with('title_page', 'Thêm câu hỏi')
                                            ->with('create_page', 'question.create')
                                            ->with('list_page', 'question.index');;
    }

    public function store(Request $request)
    {
        // dd(request()->all());
        $question = Question::create([
            'question' => $request->question,
            'anwser' => $request->anwser,
            'publish' => $request->publish
        ]);
    
        $data_pivot = [];
        if ($request->language) {

            for ($i = 0; $i < count($request->language); $i++) {

                $data_pivot[$request->language[$i]] = [
                    'question' => $request->question_lang[$i],
                    'anwser' => $request->anwser_lang[$i]
                ];
            }

            $question->language()->attach($data_pivot);
        }

        Session::flash('success', 'Thêm câu hỏi thành công.');

        if ($request->close) {
            return redirect()->route('question.index');
        } else {
            return redirect()->back();
        }
    
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        // dd($question);
        return view('admin.questions.edit')->with('title_page', 'Cập nhật câu hỏi')
                                            ->with('create_page', 'question.create')
                                            ->with('list_page', 'question.index')
                                            ->with('question', $question);
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        // dd($request->all());
     
        $question->question = $request->question;
        $question->anwser = $request->anwser;
        $question->publish = $request->publish;
        $question->save();
        
        $data_pivot = [];
        if ($request->language) {

            for ($i = 0; $i < count($request->language); $i++) {

                $data_pivot[$request->language[$i]] = [
                    'question' => $request->question_lang[$i],
                    'anwser' => $request->anwser_lang[$i]
                ];
            }

            $question->language()->sync($data_pivot);
        }

        Session::flash('success', 'Cập nhật câu hỏi thành công.');

        if ($request->close) {
            return redirect()->route('question.index');
        } else {
            return redirect()->back();
        }
    }

    public function updateStatus()
    {
        $data = request()->all();
        $question = Question::find($data['id']);
        if ($data['name'] == 'publish') {
            $question->publish = $data['value'];
        } elseif ($data['name'] == 'highlight') {
            $question->highlight = $data['value'];
        } elseif ($data['name'] == 'sort_order') {
            $question->sort_order = $data['value'];
        } elseif ($data['name'] == 'lastest') {
            $question->lastest = $data['value'];
        }
        $question->updated_at = Carbon::now();
        $question->save();

        return response($question);
    }

    public function remove()
    {
        $question = Question::find(request()->id);
        $question->delete();
        $question->language()->dettach();
    }

    public function removeAll()
    {
        $ids = explode(',', request()->ids);


        foreach ($ids as $id) {
            if ($id != '') {
                $question = Question::find($id);
                $question->delete();
                if($question->pivot){
                    $question->language()->dettach();
                }
            }
        }
    }

    
}
