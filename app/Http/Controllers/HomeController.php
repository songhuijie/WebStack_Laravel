<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['children' => function ($query) {
            $query->orderBy('order');
        }, 'sites'])
            ->where('is_show',1)
            ->withCount('children')
            ->orderBy('order')
            ->get();


        return view('index')->with('categories', $categories);
    }

    public function about()
    {
        return view('about');
    }


    public function cap(){

        return view('captcha');
    }

    public function caps(Request $request){

        $param = request(['captcha']);
        dump($param);
        try{
            $this->validate($request, [
                'captcha' => ['required', 'captcha']
            ],[
                'captcha.required' => '验证码不能为空',
                'captcha.captcha' => '请输入正确的验证码',
            ]);
            dd(2);

        }catch (\Exception $exception){

            dd($exception->getMessage());
        }

        dd(1);
    }
}
