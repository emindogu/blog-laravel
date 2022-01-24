<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;

use Validator;
use Mail;

class Homepage extends Controller
{
  public function __construct(){

    if(Config::find(1)->active==0){
      return redirect()->to('aktif-degil')->send();
    }

    view()->share('pages',Page::where('status',1)->orderBy('order','ASC')->get());
    view()->share('categories',Category::where('status',1)->orderBy('name','ASC')->get());
    view()->share('config',Config::find(1));
  }

  public function index(){
    //print_r(Category::all());die;
    $data['articles']=Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
      $query->where('status',1);
    })->orderBy('created_at','DESC')->paginate(10);
    return view('front.homepage',$data);
  }

  public function single($category,$slug){
    $category=Category::whereSlug($category)->first() ?? abort(403,'Böyle bir sayfa bulunamadı');
    $article=Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böyle bir sayfa bulunamadı');
    $article->increment('hit');
    $data['article']=$article;
    return view('front.single',$data);
  }

  public function category($slug){
    $category=Category::whereSlug($slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı');
    $data['category']=$category;
    $data['articles']=Article::where('category_id',$category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(2);
    return view('front.category',$data);
  }

  public function page($slug){
    $page=Page::whereSlug($slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı');
    $data['page']=$page;
    return view('front.page',$data);
  }

  public function contact(){
    return view('front.contact');
  }

  public function contactpost(Request $request){
    $rules=[
      'name'=>'required|min:3',
      'email'=>'required|email',
      'message'=>'required|min:10',
    ];

    $validate=Validator::make($request->all(),$rules);

    if($validate->fails()){
      return redirect()->back()->withErrors($validate)->withInput();
    }

    Mail::send([], [], function($message) use($request){
      $message->from('emindogu@hotmail.com','Emin Doğu Blog Sitesi');
      $message->to('emindogu@emindogu.net');
      $message->subject($request->name.' tarafından Mail Gönderimi');
      $message->setBody('Mesaj Konusu: '.$request->topic.'<br>
      Mesajı Gönderen: '.$request->email.'<br>
      Mesaj içeriği: '.$request->message.'<br>
      Gönderilme Tarihi: '.now(), 'text/html');
    });


    // $contact=new Contact;
    // $contact->name=$request->name;
    // $contact->email=$request->email;
    // $contact->topic=$request->topic;
    // $contact->message=$request->message;
    // $contact->save();
    return redirect()->route('contact')->with('success','Mesajınız Tarafımıza İletilmiştir!');
  }

}
