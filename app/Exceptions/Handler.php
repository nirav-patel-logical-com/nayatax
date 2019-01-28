<?php

namespace App\Exceptions;

use App\Http\Controllers\BSPController;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\Controllers\MailController;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
//    public function render($request, Exception $exception)
//    {
//
//        //return parent::render($request, $exception);
//        $BSPController = new BSPController();
//        $this->param = array();
//        if ($this->isHttpException($exception))
//        {
//            $code = $exception->getStatusCode();
//            if($code != 404 && $code != 403 && $code != 400 && $code != 405){
//                return $this->renderHttpException($exception);
//            }
//             $BSPController->document_errors($exception->getStatusCode());
//
//        }else{
//           if(getenv('APP_ENV')!='local'){
//               return $BSPController->document_errors(404);
//
//            }else{
//                return parent::render($request, $exception);
//            }
//
//        }
//
//    }
    /*--------------------------------create by vidhi handler method for exception ----------------------------------------------*/
    public function render($request, Exception $e)
    {

        $BSPController = new BSPController();
        $this->param = array();

        if ($this->isHttpException($e))
        {
          $code = $e->getStatusCode();
            return response()
                ->view('errors.404',['goods_data'=>$code]);
        }
        else
        {

            if(getenv('APP_ENV')=='local'){

                if($request->is('api/*')){
                    $bug_location = "API ";
                }
                else{
                    $bug_location = "Admin Panel";
                }

                $server_array = array();
                $server_array['REDIRECT_SCRIPT_URL'] = (isset( $_SERVER['REDIRECT_SCRIPT_URL']) && !empty($_SERVER['REDIRECT_SCRIPT_URL'])) ? $_SERVER['REDIRECT_SCRIPT_URL']:'';
                $server_array['REDIRECT_SCRIPT_URI'] = (isset($_SERVER['REDIRECT_SCRIPT_URI']) && !empty($_SERVER['REDIRECT_SCRIPT_URI'])) ? $_SERVER['REDIRECT_SCRIPT_URI']:'';
                $server_array['REDIRECT_URL'] = (isset($_SERVER['REDIRECT_URL']) && !empty($_SERVER['REDIRECT_URL'])) ? $_SERVER['REDIRECT_URL']:'';
                $server_array['REQUEST_URI'] = (isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI']:'';
                $server_array['HTTP_REFERER'] = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER']:'';
                ob_start();
                $rendered_exception=parent::render($request, $e);

                echo "<pre>";
                print_r($_POST);
                echo "</pre>";
                echo "<pre>";
                print_r($server_array);
                echo "</pre>";
                echo "$rendered_exception";
                $mail_body  = ob_get_contents();
                ob_end_clean();

                $mail_controller = new MailController();
//                $emailId='techsupport@bsptechno.com';
//                $emailSubject="{$_SERVER['HTTP_HOST']} - {$bug_location} - ". date("d-m-Y h:i:s a");
//
//                $mail_controller->send_email_for_exception($emailSubject,$emailId,$mail_body);

                if($bug_location  == "Admin Panel")
                {
//                    Session::put('SUCCESS','FALSE');
//                    Session::put('MESSAGE', 'Some thing happened wrong, ask to admin.');
                    //return Redirect::route('home');
                }
                else
                {

                    //return Redirect::route('home');
                }

            }else{

                return parent::render($request, $e);
            }

            return parent::render($request, $e);
        }
    }
}
