<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\User;
use Session;

class EmployeeController extends Controller
{
	public function logout(){
		Session::flush();
      return redirect('/');
	}
    public function table(){
    	$obj = Employee::all();
    	return view('table',['data'=>$obj]);
    }

    public function tableStore(Request $req){
    	$name    = $req->name;
    	$email   = $req->email;
    	$address = $req->address;
    	$phone   = $req->phone;


    	$obj = new Employee();
        $obj->name    = $name;
        $obj->email   = $email;
        $obj->address = $address;
        $obj->phone   = $phone;

        if($obj->save()){
           echo 'Successfully Inserted';
           return redirect('/');
       }
    }

    public function modal($id) {
      $obj = Employee::find($id);
      //$idd = $obj->id;
      return view('editmodal', ['updata'=>$obj]);
      //return view('table', compact('obj'));
      //return view('table')->with('name', $obj);
   }

    public function updateStore(Request $req, $id){
      	$obj = Employee::find($id);
      	$obj->name    = $req->name;
        $obj->email   = $req->email;
        $obj->address = $req->address;
        $obj->phone   = $req->phone;

      if($obj->save()){
         return redirect('/');
      }
   }

   public function loginStore(Request $request){
   	if(!Session::has('userid')){
        $email    = $request->email;
	      $password = $request->password;
	      $user = User::where('email','=',$email)
	                     ->where('password','=',$password)
	                     ->first();
	      if($user){
	         Session::put('userid',$user->id);
	         return redirect('table');
	         }else{
              return redirect('table');
           }
        }
        else{
        	return redirect('table');
        }
      
   }

   public function signupStore(Request $req)
   {
   	  if(!Session::has('userid')){
          $password        = $req->password;
	      $confirmpassword = $req->confirmpassword;
	      if($password == $confirmpassword){
	        $name = $req->name;
	        $email = $req->email;
	        $phone = $req->phone;
	        $address = $req->address;
	        $obj = new User();
	        $obj->name      = $name;
	        $obj->email     = $email;
	        $obj->password  = $password;
	        $obj->phone     = $phone;
	        $obj->address   = $address;

	        if($obj->save()){
	           echo 'Successfully Inserted';
	           return redirect('/');
	       }
	    }
      }else{
        	return redirect('table');
      }  
      
    }

    public function signup(){
    	if(!Session::has('userid')){
            return view('signup');
        }else{
        	return redirect('table');
        }
    }
    public function login(){
    	if(!Session::has('userid')){
            return view('login');
        }else{
        	return redirect('table');
        }
    }
}
