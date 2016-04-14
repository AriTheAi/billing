<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class ClientController extends Controller
{
    public function loginPage(Request $request)
    {
        if($request->session()->get('client_username'))
        {
            return redirect('/client/home');
        }
        return view('client/login');
    }
    public function registerPage(Request $request)
    {
        if($request->session()->get('client_username'))
        {
            return redirect('/client/home');
        }
        return view('client/register');
    }
    public function landingPage(Request $request)
    {
        if($request->session()->get('client_username'))
        {
            return redirect('/client/home');
        }
        return view('client/landing');
    }
    public function loginAttempt(Request $request)
    {
        if($request->session()->get('client_username'))
        {
            return redirect('/client/home');
        }
        $email_address  = $request->input('email');
        $password       = $request->input('password');
        $password_hash  = md5($password);
        $sql = DB::table('clients')->where('email','=',$email_address)->where('password','=',$password_hash)->get();
        if(count($sql) == 0)
        {
            return redirect('/client/login?error');
        }
        else
        {
            $account_id     = $sql[0]->id;
            $username       = $sql[0]->username;
            $email          = $sql[0]->email;
            $firstname      = $sql[0]->firstname;
            $lastname       = $sql[0]->lastname;
            $rank           = $sql[0]->account_rank;
            $banned         = $sql[0]->banned;
            if($banned == 1)
            {
                return redirect('/client/login?banned');
            }
            else {
                $request->session()->set('client_username',$username);
                $request->session()->set('client_email',$email);
                $request->session()->set('client_name',$firstname.' '.$lastname);
                $request->session()->set('client_acl',$rank);
                return redirect('/client/home');
            }
        }
    }
    public function registerAttempt(Request $request)
    {
        if($request->session()->get('client_username'))
        {
            return redirect('/client/home');
        }
        $firstname      = $request->input('firstname');
        $lastname       = $request->input('lastname');
        $address        = $request->input('address');
        $city           = $request->input('city');
        $state          = $request->input('state');
        $zip            = $request->input('zip');
        $country        = $request->input('country');
        $phone          = $request->input('phonenumber');
        $email          = $request->input('email');
        $password       = $request->input('password');
        $passwordHash   = md5($password);
        if(empty($firstname) or empty($lastname) or empty($address) or empty($city) or empty($state) or empty($zip) or empty($country) or empty($phone) or empty($email) or empty($password))
        {
            return view('client/register?error=Invalid Input');
        }
        DB::table('clients')->insert([
                                        ['id'=>NULL,'username'=>$email,'password'=>$passwordHash,'email'=>$email,'firstname'=>$firstname,'lastname'=>$lastname,'address'=>$address,'city'=>$city,'state'=>$state,'zip'=>$zip,'country'=>$country,'phone'=>$phone,'product_count'=>0,'reg_ip'=>$_SERVER['REMOTE_ADDR'],'last_login_ip'=>$_SERVER['REMOTE_ADDR'],'account_rank'=>'1','banned'=>0,'ban_reason'=>'','ban_lifted_time'=>'0']
                                    ]);
        return redirect('client/login');
    }
    public function getProductCount($id)
    {
        $sql = DB::table('products')->where('customer_id','=',$id);
        return count($sql)-1;
    }
    // Client Homepage
    public function clientHomepage(Request $request) 
    {
        if(!$request->session()->get('client_username'))
        {
            return redirect('/client/login');
        }
        $data = [
                    'name'          => $request->session()->get('client_name'),
                    'client_email'  => $request->session()->get('client_email'),
                    'client_acl'    => $request->session()->get('client_acl'),
                    'avatar'        => $this->getGravatar($request->session()->get('client_email')),
                    'product_count' => $this->getProductCount($request->session()->get('product_count'))
                ];
        return view('client/dashboard', $data);
    }
    public function getGravatar($email) 
    {
        $hash = md5(strtolower(trim($email)));
        return "http://www.gravatar.com/avatar/$hash";
    }
    public function getProductCategories()
    {
        $sql = DB::table('product_categories')->where('visible','=','1')->get();
        return $sql;
    }
    // Product Listing (for ordering)
    public function productListPage(Request $request)
    {
        if(!$request->session()->get('client_username'))
        {
            return redirect('/client/login');
        }
        $data = [
                    'name'          => $request->session()->get('client_name'),
                    'client_email'  => $request->session()->get('client_email'),
                    'client_acl'    => $request->session()->get('client_acl'),
                    'avatar'        => $this->getGravatar($request->session()->get('client_email')),
                    'product_count' => $this->getProductCount($request->session()->get('product_count')),
                    'categories'      => $this->getProductCategories()
                ];
        return view('client/categoryList', $data);
    }
    public function getProductsFor($id)
    {
        $sql = DB::table('products')->where('category_id','=',$id)->paginate(15);
        return $sql;
    }
    public function viewProductsInCategory(Request $request,$id)
    {
        if(!$request->session()->get('client_username'))
        {
            return redirect('/client/login');
        }
        $data = [
                    'name'          => $request->session()->get('client_name'),
                    'client_email'  => $request->session()->get('client_email'),
                    'client_acl'    => $request->session()->get('client_acl'),
                    'avatar'        => $this->getGravatar($request->session()->get('client_email')),
                    'product_count' => $this->getProductCount($request->session()->get('product_count')),
                    'products'      => $this->getProductsFor($id)
                ];
        return view('client/categoryViewProducts', $data);
    }
    public function getProductByID($id)
    {
        $sql = DB::table('products')->where('id','=',$id)->get();
        return $sql;
    }
    public function viewProductByID(Request $request, $id)
    {
        if(!$request->session()->get('client_username'))
        {
            return redirect('/client/login');
        }
        $data = [
                    'name'          => $request->session()->get('client_name'),
                    'client_email'  => $request->session()->get('client_email'),
                    'client_acl'    => $request->session()->get('client_acl'),
                    'avatar'        => $this->getGravatar($request->session()->get('client_email')),
                    'product_count' => $this->getProductCount($request->session()->get('product_count')),
                    'product'       => $this->getProductById($id)
                ];
        return view('client/viewProductID', $data);
    }
    public function forgetPasswordPage(Request $request)
    {
        return view('client/forgotPassword');
    }
    public function sendResetEmail(Request $request)
    {
        $email = $request->input('email');
        $sql = DB::table('clients')->where('email','=',$email)->get();
        if(count($sql) == 0)
        {
            return redirect('/client/login');
        }
        else {
            $token = md5(sha1($sql[0]->password).time().sha1($email));
            DB::table('reset_tokens')->insert([
                [
                    'id'=>NULL,
                    'user_id'=>$sql[0]->id,
                    'token'=>$token,
                    'used'=>'0'
                ]    
            ]);
            $data = '<center><h3>Did you forget your password?</h3><p>Don\'t worry! It happens sometimes! We\'re human, aren\'t we?<br>You can change your password by <a href="'.asset('/client/reset/').'/'.$token.'">clicking here.</a><br><br>Requester IP Address: '.$_SERVER['REMOTE_ADDR'].'</p></center>';
            Mail::raw($data, function ($message) use ($request, $sql) {
                $message->from('reset@'.$request->server->get('SERVER_NAME'),'Billing System');
                $message->sender('reset@'.$request->server->get('SERVER_NAME'),'Billing System');
                $message->subject('Reset Your Password');
                $message->to($request->input('email'), $sql[0]->firstname . ' ' . $sql[0]->lastname);
            });
            return redirect('/client/login');
        }
    }
    public function resetPasswordDialog(Request $request, $token)
    {
        $sql = DB::table('reset_tokens')->where('token','=',$token)->where('used','=','0')->get();
        if(count($sql) == 0)
        {
            return redirect('/client/login');
        }
        return view('client/resetPassword');
    }
    public function resetPassword(Request $request, $token)
    {
        $sql = DB::table('reset_tokens')->where('token','=',$token)->where('used','=','0')->get();
        if(count($sql) == 0)
        {
            return redirect('/client/login');
        }
        $password = $request->input('password');
        $tokenDB = DB::table('reset_tokens')->where('token','=',$token)->get();
        $user_id = $tokenDB[0]->user_id;
        // change password
        DB::table('clients')->where('id','=',$user_id)->update(['password'=>md5($password)]);
        DB::table('reset_tokens')->where('token','=',$token)->update(['used'=>'1']);
        return redirect('/client/login');
    }
}