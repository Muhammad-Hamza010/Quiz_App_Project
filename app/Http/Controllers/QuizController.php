<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\QuizLog;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Contracts\Session\Session;

class QuizController extends Controller
{
    // public function quizhome1(Request $request)
    // {   
    //     return redirect()->route('quizstart',['email'=>$request->email,'password'=>$request->password]);
    //     // try{
    //     //     $email = $request->email;
    //     //     $password = $request->password;

    //     //     $candidate = Candidate::where(['email'=>$email, 'password'=>$password])->first();
            
    //     //     $candidate_id = $candidate->id;
    //     //     $candidate_name = $candidate->name;
    //     //     $turnedinquiz = $candidate->turnedinquiz;
    //     //     if($turnedinquiz == 0){
    //     //         $quizlog = QuizLog::create([
    //     //             'candidate_id' => $candidate_id,
    //     //             'candidate_name' => $candidate_name,
    //     //             'quiz_url' => $request->fullUrl(),
    //     //         ]);
    //     //         return response($quizlog, 200);
    //     //     }
    //     //     else{
    //     //         return response('You Have Already Submitted Your Response');
    //     //     }
            
    //     // }
    //     // catch(Exception $e){
    //     //     $error = array(
    //     //         'message' => 'There was an error: {'.
    //     //             $e->getMessage().'}'
    //     //     );
    //     //     return response($error);
    //     // }
    // }
    public function quizhome(Request $request){
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
                    'start_time' => now(),
                ]);
                
                session(['LogID'=> $quizlog->id]);
                return response("Quiz Started", 200);
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
            return response($error, 404);
        }
    }

    public function onSubmit(Request $req){
        try{
            
            $req->validate([
            'file' => 'required'
            ]);

            $fileModel = QuizLog::find(session('LogID'));
            
            $user= Candidate::find($fileModel->candidate_id);
        
            if($req->file()) {
                $fileName = $req->file->getClientOriginalName();
                $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
                $fileModel->recording_path = '/storage/' . $filePath;
                $fileModel->end_time= now();
                $user->turnedinquiz=1;
                $user->save();
                $fileModel->save();
                return response('Quiz Submitted', 200);
                // return back()
                // ->with('success','File has been uploaded.')
                // ->with('file', $fileName);
            }
    
        }
        catch(Exception $e)
        {
            return response($e->getMessage());
        }
    }

}
