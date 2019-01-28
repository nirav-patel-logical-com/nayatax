<?php
/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Sessions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
session_start();

class AgentController extends Controller
{
    public function __construct()
    {

        //$this->middleware('auth');
        parent::login_user_details();
    }

    /*to open agent add page.*/
    public function agent()
    {
        $data['page_title'] = 'Agent Add';
        return response()
            ->view('agent.agent-add', ['agent_data' => $data]);
    }

    /*to open agent list page.*/
    public function agent_list()
    {
        $Users = new User();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $Users->set_role_id('4');
        $Users->set_role_name('Agent');
        $agent_list = $Users->get_user_list($role_id, $user_id);
//        /echo "<pre>";print_r($agent_list);die;
        return response()
            ->view('agent.agent-list', ['agent_list' => $agent_list]);
    }

    /*to send data to agent list page.*/
    public function agent_list_post(Request $request)
    {
        $role_permission_arr = parent::login_user_details();
        $user = new User();
        $user->set_role_id('4');
        $user->set_role_name('Agent');
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'id',
            1 => 'biz_name',
            2 => 'f_name',
            3 => 'email',
            4 => 'mobile',
            5 => 'city',
            6 => 'status',
            7 => 'id',
        );

        $total = $user->agent_count();
        $totalData = $total[0]->agent_count;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        if (empty($search)) {
            $posts = $user->get_user_post($role_id, $user_id, $start, $limit, $order, $dir);
        } else {

            $posts = $user->get_user_post($role_id, $user_id, $start, $limit, $order, $dir, $search);
            $total_rec = $user->get_user_post_count($role_id, $user_id, $search);
            $totalFiltered = $total_rec[0]->total;
        }
        $data = array();
        if (!empty($posts)) {
            /*to set data in td block*/
            foreach ($posts as $post) {
                $edit_title = trans('label_word.edit');
                $show = route('agent_view', $post->id);
                $edit = route('agent_edit', $post->id);

                if (isset($role_permission_arr['agent']) && $role_permission_arr['agent'] != 'None' && $role_permission_arr['agent'] != 'Read') {
                    $status = "<a class='font-green-sharp' onclick='status_change({$post->id},&#39{$post->status}&#39);' title='Status' ><span>" . $post->status . "</span></a>";
                    $edit_view = "&emsp;<a href='{$edit}' title='{$edit_title}' ><span class='font-green-sharp glyphicon glyphicon-edit'></span></a>";
                } else {
                    $status = $post->status;
                    $edit_view = "&emsp;";
                }


                $nestedData['id'] = $post->id;
                $nestedData['company'] = $post->biz_name;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show}'>" . $post->f_name . ' ' . $post->m_name . ' ' . $post->l_name . "</a>";
                $nestedData['email'] = $post->email;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['city'] = $post->city;
                $nestedData['status'] = "{$status}";
                $nestedData['action'] = "<a href='{$show}' title='SHOW' ><span class='font-green-sharp glyphicon glyphicon-list'></span></a>
                                          {$edit_view}";
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    /*display agent view page*/
    public function agent_view($id)
    {
        $Users = new User();
        $Users->set_id($id);

        $agent_data = $Users->get_user_details();
        $data['page_title'] = 'Agent Detail';
        $data['add_by'] = $Users->get_user_name_by_id($agent_data[0]->add_by);
        $data['modify_by'] = $Users->get_user_name_by_id($agent_data[0]->modify_by);
        if(isset($agent_data) && !empty($agent_data[0]->biz_logo)){
            $agent_data[0]->image= Config::get('constant.SITE_URL').'business_logo/' . $agent_data[0]->biz_logo;
        }
        $role_name = $_SESSION['login_user']->role_name;
        $agent_data[0]->login_role = $role_name;
        $data['agent_data'] = $agent_data[0];
        return response()
            ->view('agent.agent-view', ['agent_data' => $data]);

    }

    /*display edit page*/
    public function agent_edit($id)
    {
        $Users = new User();
        $Users->set_id($id);
        $agent_data = $Users->get_user_details();
        $data['page_title'] = 'Agent Edit';
        $agent_data[0]->image= Config::get('constant.SITE_URL').'business_logo/' . $agent_data[0]->biz_logo;
        $role_name = $_SESSION['login_user']->role_name;
        $agent_data[0]->login_role = $role_name;
        $data['agent_data'] = $agent_data[0];
        return response()
            ->view('agent.agent-add', ['agent_data' => $data]);
    }
}