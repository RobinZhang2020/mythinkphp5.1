<?php
namespace app\welcome\controller;
use think\Controller;

class Index extends Controller
{
    public function home(){
        return 'home';
    }
    public function help(){
        return 'help';
    }
    public function about(){
        return 'about';
    }
}
