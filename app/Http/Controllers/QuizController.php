<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\QuizLog;
use Exception;

class QuizController extends Controller
{
    public function quizhome(Request $request)
    {
        try{
            $email = $request->email;
            $password = $request->password;

            $candidate = Candidate::where(['email'=>$email, 'password'=>$password])->first();
            
            $candidate_id = $candidate->id;
            $candidate_name = $candidate->name;
            $turnedinquiz = $candidate->turnedinquiz;
            if($turnedinquiz == 0){
                $quizlog = QuizLog::create([
                    'candidate_id' => $candidate_id,
                    'candidate_name' => $candidate_name,
                    'quiz_url' => $request->fullUrl(),
                ]);
                return response($quizlog, 200);
            }
            else{
                return response('You Have Already Submitted Your Response');
            }
            
        }
        catch(Exception $e){
            $error = array(
                'message' => 'There was an error: {'.
                    $e->getMessage().'}'
            );
            return response($error);
        }
    }

}
