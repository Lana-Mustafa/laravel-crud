<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegisterUser;
//Encrypt
use Illuminate\Support\Facades\Hash;
class RegisterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= RegisterUser::all();
        // return $users
    return view('RegisterForm',compact('users')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*  public function create()
    {
        
        return view('registerForm');
    }
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( $request )
    {   $this->validForm($request);
        //1st way to insert data
       /* RegisterUser::create($request->all()); */

       //2nd way to insert data
      /*  RegisterUser::create([
                      'fullname' => $request->input('fullname'),
                      'email'    => $request->input('email'),
                      'mobile'   => $request->input('mobile'),
                      'password' => bcrypt($request->input('password')),
                      ]); */
        
        //3rd way to insert data
        
        $user=new RegisterUser;
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return $this->index();
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=RegisterUser::where("userid",$id)->get()->first();
         
        return view('editForm',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
         
        $this->validForm($request);
        RegisterUser::where("userid",$id)->update([
            'fullname' => $request->input('fullname'),
            'email'    => $request->input('email'),
            'mobile'   => $request->input('mobile'),
            'password' => Hash::make($request->input('password'))

            ]) ;
            return redirect('/register');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RegisterUser::destroy($id);
       /*  $users= RegisterUser::all();
        return view('registerForm',compact('users')); */
        return redirect('/register');

    }
    //2nd way to delete
    public function delete($id)
    {
        $deleteuser = RegisterUser::where('userid', $id)->delete();
        return redirect('/register');

        // return view('/alluser');
    }

   /*  public function showRegister(){
        return view('registerForm');
    } */

    public function validForm(Request $request){
        
       
        
        $request->validate([
                'fullname' =>'required|min:4|max:25',
                'email'    =>'required|email',
                'mobile'   =>'required|numeric|digits:14',
                'password' =>'required|confirmed|min:8|max:14',
                'password_confirmation'=>'required',

        ]);

        /* $input= $request->input(); */

        




    }
    

}
