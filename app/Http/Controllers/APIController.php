<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
       // $articles = Article::paginate(4);
        foreach ($articles as $article) {
            $article['username'] = $article->user->name;
        }
        //dd($articles);
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
    
        $validator = Validator::make($request->all(),['title'=>'required','photo'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"]);
        if ($validator->fails()) {
            //greska
            $response = array('response'=>$validator->messages(), 'success'=>false);
            return $response;
        }else{
            
                //ekstenzija
                $ext = $request->file('photo')->getClientOriginalExtension(); //jpg
                    
                //originalno ime sa extenzijom
                $imageOriginalName = $request->file('photo')->getClientOriginalName();

                  //samo ime fajla bez ekstenzije
                 $filename = pathinfo($imageOriginalName, PATHINFO_FILENAME);

                //puno ime slike sa ekstenzijom i dodato vreme u sredini radi lakse organizacije imena
                $imageName = $filename .'_'.time().'.'. $ext;

                //stavljanje slike u promenljivu da bi mogli da je ubacimo put() metodom u Storage 
                $imageEncoded = File::get($request->photo);

                //put image in storage folder
                Storage::disk('local')->put('public/article_images/'.$imageName,$imageEncoded);

                if(isset($request->file()->photo2)){
                  //ekstenzija
                  $ext = $request->file('photo2')->getClientOriginalExtension(); //jpg
                    
                  //originalno ime sa extenzijom
                  $imageOriginalName = $request->file('photo2')->getClientOriginalName();
  
                    //samo ime fajla bez ekstenzije
                   $filename = pathinfo($imageOriginalName, PATHINFO_FILENAME);
  
                  //puno ime slike sa ekstenzijom i dodato vreme u sredini radi lakse organizacije imena
                  $imageName = $filename .'_'.time().'.'. $ext;
  
                  //stavljanje slike u promenljivu da bi mogli da je ubacimo put() metodom u Storage 
                  $imageEncoded = File::get($request->photo);
  
                  //put image in storage folder
                  Storage::disk('local')->put('public/article_images/'.$imageName,$imageEncoded);
  
                }
                
            $user = Auth::user();
            $userName = $user->name;
            //kreiranje clanka
            $article = new Article;
            $article->title = $request->input('title');
            $article->content = $request->input('content');
            $article->photo = $imageName;
            $article->photo2 = $imageName;
            $article->user_id = $user->id;
            $article->save();
            //return $article;
           return response()->json(['article' => $article, 'username' => $userName]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('singleArticle',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        $response = array('response'=>'Article deleted','success'=>true, 'id' => $id);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function showArticlesByUser($id, Request $request)
    // {
    //     //return response()->json($request->userId);
    //     $articles = Article::where('user_id', $id)->get();
    //   //  return $articles;
    //    return response()->json($articles);
    // }


       public function showArticlesByUser($id)
    {
        //return response()->json($request->userId);
         $userArticles = User::find($id)->article;
        
       // $userArticles->article;
     // foreach($userArticles as $article){
       return response()->json($userArticles);
     // }
    }

}

